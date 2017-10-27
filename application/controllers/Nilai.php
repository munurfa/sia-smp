<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Guru');
		$this->load->model('m_nilai');
		
	}

	// List all your items
	public function index()
	{
		$this->form_validation->set_rules('tahun_ajar', 'TAHUN AJAR', 'required');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        if ($this->form_validation->run() == FALSE) {
         $data = array(
            'content' => 'nilai/_form',
            'pageTitle' => 'Pilih Data Nilai',
            'kelas' => $this->m_nilai->kelas(),
            'guru' => $this->m_nilai->satuGuru($this->session->id)
        );
        $this->load->view('tpl/content', $data);
         } else {
            $tahun_ajar = $this->input->post('tahun_ajar');
            $kelas = $this->input->post('kelas');
            redirect('nilai/daftarsiswa/'.$kelas.'/'.str_replace('/','-',$tahun_ajar) );
        }
        return false;

	}
	public function report($kelas, $tahun_ajar)
    {
    	$this->load->library('PHPExcel');
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
        //name the worksheet
		$excel->getActiveSheet()->setTitle('Student');
        //set cell A1 content with some text
		$excel->getActiveSheet()->setCellValue('A1', 'Nilai Kelas '.$kelas);
		$excel->getActiveSheet()->setCellValue('A2', 'Tahun Ajar '.str_replace('-','/',$tahun_ajar));
		$excel->getActiveSheet()->setCellValue('A3', 'No');
		$excel->getActiveSheet()->setCellValue('B3', 'NIS');
		$excel->getActiveSheet()->setCellValue('C3', 'Nama');
		$excel->getActiveSheet()->setCellValue('D3', 'Jenis Kelamin');
		$excel->getActiveSheet()->setCellValue('E3', 'Harian (20%)');
		$excel->getActiveSheet()->setCellValue('F3', 'UTS (30%)');
		$excel->getActiveSheet()->setCellValue('G3', 'UAS (50%)');
		$excel->getActiveSheet()->setCellValue('H3', 'Nilai Akhir');
        //merge cell A1 until C1
		$excel->getActiveSheet()->mergeCells('A1:H1');
		$excel->getActiveSheet()->mergeCells('A2:H2');

		$excel->getActiveSheet()->mergeCells('A1:B1');
        //set aligment to center for that merged cell (A1 to C1)
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		$excel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('I'); $col++){
                //set column dimension
			$excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
			$excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data       
		$rs = $this->m_nilai->siswaPerKelas($kelas,str_replace('-','/',$tahun_ajar),$this->session->id);
//        $rs = $this->db->get('countries');
		$no=1;
		$cell=4;
		foreach ($rs->result() as $row){
			$excel->getActiveSheet()->setCellValue('A'.$cell, $no);
			$excel->getActiveSheet()->setCellValue('B'.$cell, $row->username);
			$excel->getActiveSheet()->setCellValue('C'.$cell, $row->nama);
			$excel->getActiveSheet()->setCellValue('D'.$cell, $row->jenis_kel);
			$excel->getActiveSheet()->setCellValue('E'.$cell, $row->harian);
			$excel->getActiveSheet()->setCellValue('F'.$cell, $row->uts);
			$excel->getActiveSheet()->setCellValue('G'.$cell, $row->uas);
			$akhir = ($row->harian*0.2)+($row->uts*0.3)+($row->uas*0.5);
			$excel->getActiveSheet()->setCellValue('H'.$cell, $akhir);
			$cell++;
			$no++;

		}
                //Fill data 
		// $excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
		// $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $filename='Nilai-'.$kelas."/".$tahun_ajar.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
        
    }
    public function daftarSiswa($kelas, $tahun_ajar)
    {

        $data = array(
                    'content' => 'nilai/_nilai',
                    'pageTitle' => 'Daftar Nilai',
                    'siswa' => $this->m_nilai->siswaPerKelas($kelas,str_replace('-','/',$tahun_ajar),$this->session->id),
                    'tahun_ajar' => $tahun_ajar,
                    'kelas' => $kelas,
                    'guru' => $this->m_nilai->satuGuru($this->session->id)->row()
                );

            $this->session->set_flashdata('sukses', 'Silahkan Simpan Nilai Pada Tahun Ajar '
                .str_replace('-','/',$tahun_ajar).' Kelas '.$kelas.' !');

            $this->load->view('tpl/content',$data);
    }


	public function tambah($id_siswa,$tahun_ajar)
	{
		$this->form_validation->set_rules('harian', 'NILAI HARIAN', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		$this->form_validation->set_rules('uts', 'NILAI UTS', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		$this->form_validation->set_rules('uas', 'NILAI UAS', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		if ($this->form_validation->run() == FALSE) {
		$data = array(
					'content' => 'nilai/_form_nilai',
					'pageTitle' => 'Tambah Nilai',
					'tahun_ajar' => str_replace('-','/',$tahun_ajar),
					'id_guru'	=> $this->session->id,
					'siswa' => $this->m_nilai->satu($id_siswa)->row()
				);
		$this->session->set_flashdata('sukses', 'Silahkan Simpan Nilai Pada Tahun Ajar '
						.str_replace('-','/',$tahun_ajar).' !');
		$this->load->view('tpl/content',$data);
		}
			 else {
						$data['harian'] = $this->input->post('harian');
						$data['uts'] = $this->input->post('uts');
						$data['uas'] = $this->input->post('uas');
						$data['id_guru'] = $this->input->post('id_guru');
						$data['id_siswa'] = $this->input->post('id_siswa');
						$data['tahun_ajar'] = $this->input->post('tahun_ajar');

						$this->m_nilai->tambah($data);

						$this->session->set_flashdata('sukses', 'Nilai Berhasil Disimpan');

						redirect(site_url('nilai/daftarsiswa/'.$this->m_nilai->satu($id_siswa)->row()->nama_kelas.'/'.$tahun_ajar));
				}
				return false;
	}

	//Update one item
	public function update($id_siswa,$tahun_ajar)
	{
		$this->form_validation->set_rules('harian', 'NILAI HARIAN', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		$this->form_validation->set_rules('uts', 'NILAI UTS', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		$this->form_validation->set_rules('uas', 'NILAI UAS', 'numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
		if ($this->form_validation->run() == FALSE) {
		$data = array(
					'content' => 'nilai/_form_nilai_update',
					'pageTitle' => 'Edit Nilai',
					'tahun_ajar' => str_replace('-','/',$tahun_ajar),
					'id_guru'	=> $this->session->id,
					'siswa' => $this->m_nilai->siswaDiNilai(str_replace('-','/',$tahun_ajar),$id_siswa,$this->session->id)->row()
				);
		$this->session->set_flashdata('sukses', 'Silahkan Edit Nilai Pada Tahun Ajar '
						.str_replace('-','/',$tahun_ajar).' !');
		$this->load->view('tpl/content',$data);
		}
			 else {
						$data['harian'] = $this->input->post('harian');
						$data['uts'] = $this->input->post('uts');
						$data['uas'] = $this->input->post('uas');
						$data['id_guru'] = $this->input->post('id_guru');
						$data['id_siswa'] = $this->input->post('id_siswa');
						$data['tahun_ajar'] = $this->input->post('tahun_ajar');

						$this->m_nilai->update($data);

						$this->session->set_flashdata('sukses', 'Nilai Berhasil Diedit');

						redirect(site_url('nilai/daftarsiswa/'.$this->m_nilai->satu($id_siswa)->row()->nama_kelas.'/'.$tahun_ajar));
				}
				return false;
	}



}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
