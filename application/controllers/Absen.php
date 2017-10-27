<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Guru');
		$this->load->model('m_absen');

	}

	// List all your items
	public function index()
	{

		$this->form_validation->set_rules('tgl_absen', 'TANGGAL ABSEN', 'required');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        $this->form_validation->set_rules('jam_ke', 'JAM KE', 'required');
        if ($this->form_validation->run() == FALSE) {
		 $data = array(
            'content' => 'absen/_form',
            'pageTitle' => 'Data Absen',
            'kelas' => $this->m_absen->kelas()
        );
        $this->load->view('tpl/content', $data);
         } else {
            $tgl_absen = $this->input->post('tgl_absen');
			$kelas = $this->input->post('kelas');
			$jam_ke = $this->input->post('jam_ke');
			redirect('absen/daftarsiswa/'.$kelas.'/'.$tgl_absen.'/'.$jam_ke);
        }
        return false;
	}

	public function daftarSiswa($kelas, $tgl_absen, $jam_ke)
	{
		$data = array(
	                'content' => 'absen/_absen',
	                'pageTitle' => 'Daftar Absen',
	                'siswa' => $this->m_absen->siswaPerKelas($kelas,$tgl_absen,$jam_ke,$this->session->id),
	                'tgl_absen' => $tgl_absen,
	                'kelas' => $kelas,
	                'jam_ke' => $jam_ke,
	                'jml_abs' => $this->m_absen->jml_abs($kelas,$tgl_absen,$jam_ke,$this->session->id),
	           );

	        $this->session->set_flashdata('sukses', 'Silahkan Melakukan Absen Pada Tanggal '
            	.nice_date($tgl_absen,'d-m-Y').' !');

            $this->load->view('tpl/content',$data);
	}

	// Add a new item
	public function tambah($tgl_absen,$jam_ke,$kelas)
	{
		 // $data['id_siswa'],
     //        $data['id_guru'],
     //        $data['tgl_absen'],
     //        $data['absen'],
     //        $data['ket'],
     //        $data['jam_ke'],
        $siswa     = $this->m_absen->siswaPerKelas($kelas,$tgl_absen,$jam_ke,$this->session->id);
        foreach ($siswa->result() as $n) { 
            $data[] = array(
                    'id_siswa'=>$n->id_user,
                    'id_guru' => $this->session->id,
                    'tgl_absen' => $tgl_absen,
                    'absen'=>$this->input->post('absen'.$n->id_siswa),
                    'jam_ke'=>$jam_ke,

            );
        }
        // echo "<pre>";
        // print_r ($data);
        // echo "</pre>";
        // die();

            $this->m_absen->tambah($data);

            $this->session->set_flashdata('sukses', 'Absen Berhasil Disimpan');

            redirect(site_url('absen/daftarsiswa/'.$kelas.'/'.$tgl_absen.'/'.$jam_ke));
        
      
	}

	//Update one item
	public function update( $tgl_absen,$jam_ke,$kelas )
	{
		
         $siswa     = $this->m_absen->siswaPerKelas($kelas,$tgl_absen,$jam_ke,$this->session->id);
        foreach ($siswa->result() as $n) { 
            
                    $data['tgl_absen'] = $tgl_absen;
		            $data['jam_ke'] = $jam_ke;
		            $data['absen'] = $this->input->post('absen'.$n->id_siswa);
		            $data['id_guru'] = $this->session->id;
		            $data['id_siswa'] = $n->id_user;
                    $this->m_absen->update($data);
         
        }
            

            $this->session->set_flashdata('sukses', 'Absen Berhasil Diedit');

            redirect(site_url('absen/daftarsiswa/'.$kelas.'/'.$tgl_absen.'/'.$jam_ke));
        
	}

	public function report()
	{

		$this->form_validation->set_rules('tgl_awal', 'TANGGAL AWAL ABSEN', 'required');
		$this->form_validation->set_rules('tgl_akhir', 'TANGGAL AKHIR ABSEN', 'required');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        if ($this->form_validation->run() == FALSE) {
		 $data = array(
            'content' => 'absen/_form_report',
            'pageTitle' => 'Cetak Report Absen',
            'kelas' => $this->m_absen->kelas()
        );
        $this->load->view('tpl/content', $data);
         } else {
            $tgl_awal = str_replace('/','-',$this->input->post('tgl_awal'));
			$tgl_akhir = str_replace('/','-',$this->input->post('tgl_akhir'));
			$kelas = $this->input->post('kelas');
			redirect('absen/cetakreport/'.$kelas.'/'.$tgl_awal.'/'.$tgl_akhir);
        }
        return false;
	}

	public function cetakReport($kelas,$tgl_awal,$tgl_akhir)
	{
		$this->load->library('PHPExcel');
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex(0);
        //name the worksheet
		$excel->getActiveSheet()->setTitle('Student');
        //set cell A1 content with some text
		$excel->getActiveSheet()->setCellValue('A1', 'Absen Kelas '.$kelas);
		$excel->getActiveSheet()->setCellValue('A2', 'Tanggal '.nice_date($tgl_awal,'d-m-Y').' s/d '.nice_date($tgl_akhir,'d-m-Y'));
		$excel->getActiveSheet()->setCellValue('A3', 'No');
		$excel->getActiveSheet()->setCellValue('B3', 'NIS');
		$excel->getActiveSheet()->setCellValue('C3', 'Nama');
		$excel->getActiveSheet()->setCellValue('D3', 'Jenis Kelamin');
		$excel->getActiveSheet()->setCellValue('E3', 'A');
		$excel->getActiveSheet()->setCellValue('F3', 'I');
		$excel->getActiveSheet()->setCellValue('G3', 'S');
		$excel->getActiveSheet()->setCellValue('H3', 'H');
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
		$rs = $this->m_absen->report($kelas);
//        $rs = $this->db->get('countries');
		$no=1;
		$cell=4;
		foreach ($rs->result() as $row){
			$excel->getActiveSheet()->setCellValue('A'.$cell, $no);
			$excel->getActiveSheet()->setCellValue('B'.$cell, $row->username);
			$excel->getActiveSheet()->setCellValue('C'.$cell, $row->nama);
			$excel->getActiveSheet()->setCellValue('D'.$cell, $row->jenis_kel);
			// $abs = $this->m_absen->reportAbsen(
   //                                  $kelas,
   //                                  $tgl_awal,
   //                                  $tgl_akhir,
   //                                  $this->session->id,
   //                                  $row->id_users,
   //                                  'H')->result_array() ;
			// // $A=print_r($abs[0]->jml_abs);
			// // $A=2;
   //          $excel->getActiveSheet()->fromArray($abs, null, 'E'.$cell);  
			$excel->getActiveSheet()->fromArray(
				$this->jmlAbsen($kelas,$tgl_awal,$tgl_akhir,$row->id_users,'A'),null,'E'.$cell);
			$excel->getActiveSheet()->fromArray(
				$this->jmlAbsen($kelas,$tgl_awal,$tgl_akhir,$row->id_users,'I'),null,'F'.$cell);
			$excel->getActiveSheet()->fromArray(
				$this->jmlAbsen($kelas,$tgl_awal,$tgl_akhir,$row->id_users,'S'),null,'G'.$cell);
			$excel->getActiveSheet()->fromArray(
				$this->jmlAbsen($kelas,$tgl_awal,$tgl_akhir,$row->id_users,'H'),null,'H'.$cell);
			$cell++;
			$no++;

		}
         
                $filename='Absen-'.$kelas.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
        
		die();
		$data = array(
	                
	                'siswa' => $this->m_absen->report($kelas),
	                'kelas' => $kelas,
	                'tgl_awal' => str_replace('-','/',$tgl_awal),
	                'tgl_akhir' => str_replace('-','/',$tgl_akhir),
	                'id_guru'	=> $this->session->id
	            );


            $this->load->view('absen/_absen_report',$data);
	}
	public function jmlAbsen($kelas,$tgl_awal,$tgl_akhir,$id_users,$absen)
	{
		$abs=$this->m_absen->reportAbsen(
                        $kelas,
                        str_replace('-','/',$tgl_awal),
                        str_replace('-','/',$tgl_akhir),
                        $this->session->id,
                        $id_users,
                        $absen)->result_array() ;
		return $abs;
	}

	public function siswa($value='')
	{
		$data = array(
					'content' => 'absen/_form_absen_update',
	                'pageTitle' => 'Edit Absen',
					'tgl_absen' => $tgl_absen,
					'jam_ke'	=> $jam_ke,
					'siswa' => $this->m_absen->siswaDiAbsen($tgl_absen,$jam_ke,$id_siswa,$this->session->id)->row()
				);
		$this->session->set_flashdata('sukses', 'Silahkan Edit Absen Pada Tanggal '
            	.nice_date($tgl_absen,'d-m-Y').' Jam Ke- '.$jam_ke.' !');
		$this->load->view('tpl/content',$data);
	}

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
