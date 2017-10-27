<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Admin');
		$this->load->model('m_siswa');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$limit = 7;
        $config['base_url'] = base_url('siswa/index');
        $config['total_rows'] = $this->m_siswa->count();
        $config['per_page'] = $limit;
               
        $this->pagination->initialize($config);
        
        $data = array(
            'content' => 'siswa/_siswa',
            'pageTitle' => 'Data Siswa',
            'siswa' => $this->m_siswa->semua($limit,$offset)
        );
        
        $this->load->view('tpl/content', $data);

	}

	public function ubah($id_user)
	{
		$data = array(
            'content' => 'siswa/_form-update',
            'pageTitle' => 'Ubah Siswa',
            'siswa' => $this->m_siswa->satu($id_user)->row(),
            'kelas' => $this->m_siswa->kelas()
        );
        $this->load->view('tpl/content', $data);
	}

	// Add a new item
	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'NAMA', 'required');
        $this->form_validation->set_rules('username', 'USERNAME', 'required|is_unique[tbl_users.username]');
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');
        $this->form_validation->set_rules('jenis_kel', 'JENIS KELAMIN', 'required');
        $this->form_validation->set_rules('tmp_lahir', 'TEMPAT LAHIR', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'TANGGAL LAHIR', 'required');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        $this->form_validation->set_rules('tahun_masuk', 'TAHUN MASUK', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'siswa/_form',
                'pageTitle' => 'Tambah Siswa',
                'kelas' => $this->m_siswa->kelas()
            );
            $this->load->view('tpl/content',$data);
        } else {
            $data['nama']      = $this->input->post('nama');
            $data['username']  = $this->input->post('username');
            $data['password']  = md5($this->input->post('password'));
            $data['jenis_kel'] = $this->input->post('jenis_kel');
            $data['tmp_lahir'] = $this->input->post('tmp_lahir');
            $data['tgl_lahir'] = $this->input->post('tgl_lahir');
            $data['kelas'] = $this->input->post('kelas');
            $data['tahun_masuk'] = $this->input->post('tahun_masuk');
            
            $this->m_siswa->tambah($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Dibuat');
            
            redirect(site_url('siswa'));
        }
        return false;
	}

	//Update one item
	public function update( $id_user = NULL )
	{
        $original_value = $this->m_siswa->satu($id_user)->row()->username ;
        if($this->input->post('username') != $original_value) {
           $is_unique =  '|is_unique[tbl_users.username]';
        } else {
           $is_unique =  '';
        }
		$this->form_validation->set_rules('nama', 'NAMA', 'required');
        $this->form_validation->set_rules('username', 'USERNAME', 'required'.$is_unique);
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');
        $this->form_validation->set_rules('jenis_kel', 'JENIS KELAMIN', 'required');
        $this->form_validation->set_rules('tmp_lahir', 'TEMPAT LAHIR', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'TANGGAL LAHIR', 'required');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        $this->form_validation->set_rules('tahun_masuk', 'TAHUN MASUK', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'siswa/_form-update',
                'pageTitle' => 'Ubah Siswa',
                'siswa' =>  $this->m_siswa->satu($id_user)->row(),
                'kelas' => $this->m_siswa->kelas()
            );
            $this->load->view('tpl/content',$data);
        } else {
            $data['nama']      = $this->input->post('nama');
            $data['username']  = $this->input->post('username');
            $data['password']  = md5($this->input->post('password'));
            $data['jenis_kel'] = $this->input->post('jenis_kel');
            $data['tmp_lahir'] = $this->input->post('tmp_lahir');
            $data['tgl_lahir'] = $this->input->post('tgl_lahir');
            $data['kelas'] = $this->input->post('kelas');
            $data['tahun_masuk'] = $this->input->post('tahun_masuk');
            $data['id_user'] = $id_user;
            
            $this->m_siswa->update($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            
            redirect(site_url('siswa'));
        }
        return false;
	}

	//Delete one item
	public function hapus($id = NULL)
    {
        $data['id_user'] = $id;
        $this->m_siswa->hapus($data);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect(site_url('siswa'));
    }
}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
