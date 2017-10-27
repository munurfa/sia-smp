<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataSiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Siswa');
		$this->load->model('m_datasiswa');

	}

	public function absen()
	{
		$this->form_validation->set_rules('tgl_awal', 'TANGGAL AWAL ABSEN', 'required');
		$this->form_validation->set_rules('tgl_akhir', 'TANGGAL AKHIR ABSEN', 'required');
        $this->form_validation->set_rules('guru', 'GURU', 'required');
        $kelas = $this->m_datasiswa->kelas($this->session->id)->row();
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
            'content' => 'data_siswa/_form',
            'pageTitle' => 'Lihat Absen',
            'guru' => $this->m_datasiswa->guru(substr($kelas->nama_kelas,0,-1)),
          
        );
        $this->load->view('tpl/content', $data);
         } else {
            $tgl_awal = str_replace('/','-',$this->input->post('tgl_awal'));
			$tgl_akhir = str_replace('/','-',$this->input->post('tgl_akhir'));
			$guru = $this->input->post('guru');
			redirect('datasiswa/dataabsen/'.$guru.'/'.$tgl_awal.'/'.$tgl_akhir);
        }
        return false;
	}
	public function dataAbsen($guru, $tgl_awal, $tgl_akhir)
	{
		$data = array(
	                'content' => 'data_siswa/_absen',
	                'pageTitle' => 'Jumlah Absen',
	                'tgl_awal' => $tgl_awal,
	                'tgl_akhir' => $tgl_akhir,
	                'H' => $this->jmlAbsen($tgl_awal,$tgl_akhir,$guru,'H'),
	                'A' => $this->jmlAbsen($tgl_awal,$tgl_akhir,$guru,'A'),
	                'I' => $this->jmlAbsen($tgl_awal,$tgl_akhir,$guru,'I'),
	                'S' => $this->jmlAbsen($tgl_awal,$tgl_akhir,$guru,'S'),
	                'guru' => $this->m_datasiswa->gurusatu($guru)->row()
	                
	           );

	        $this->session->set_flashdata('sukses', 'Jumlah Absen Pada Tanggal '
            	.nice_date($tgl_awal,'d-m-Y').' s/d '.nice_date($tgl_akhir,'d-m-Y'));

            $this->load->view('tpl/content',$data);
	}
	public function jmlAbsen($tgl_awal,$tgl_akhir,$id_guru,$absen)
	{
		$abs=$this->m_datasiswa->absen(
                        str_replace('-','/',$tgl_awal),
                        str_replace('-','/',$tgl_akhir),
                        $id_guru,
                        $this->session->id,
                        $absen)->row() ;
		return $abs;
	}

	public function nilai()
	{
		$this->form_validation->set_rules('tahun_ajar', 'Tahun Ajar', 'required');
        $this->form_validation->set_rules('guru', 'GURU', 'required');
        $kelas = $this->m_datasiswa->kelas($this->session->id)->row();
        if ($this->form_validation->run() == FALSE) {
        	$data = array(
            'content' => 'data_siswa/_form_nilai',
            'pageTitle' => 'Lihat Nilai',
            'guru' => $this->m_datasiswa->guru(substr($kelas->nama_kelas,0,-1)),
          
        );
        $this->load->view('tpl/content', $data);
         } else {
            $tahun_ajar=$this->input->post('tahun_ajar');
			$guru = $this->input->post('guru');
			redirect('datasiswa/datanilai/'.$guru.'/'.str_replace('/','-',$tahun_ajar));
        }
        return false;
	}
	public function datanilai($guru,$tahun_ajar)
	{
		$tahun_ajar = str_replace('-','/',$tahun_ajar);
		$data = array(
	                'content' => 'data_siswa/_nilai',
	                'pageTitle' => 'Jumlah Nilai',
	                'tahun_ajar' => $tahun_ajar,
	                'nilai'=>	$this->m_datasiswa->nilai($tahun_ajar,$this->session->id,$guru)->row(),
	                'guru' => $this->m_datasiswa->gurusatu($guru)->row()
	                
	           );

	        $this->session->set_flashdata('sukses', 'Jumlah Nilai Pada Tahun Ajar '
            	.str_replace('-','/',$tahun_ajar));

            $this->load->view('tpl/content',$data);
	}
}

/* End of file dataSiswa.php */
/* Location: ./application/controllers/dataSiswa.php */