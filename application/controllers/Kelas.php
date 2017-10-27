<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Admin');
		$this->load->model('m_kelas');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$limit = 7;
        $config['base_url'] = base_url('kelas/index');
        $config['total_rows'] = $this->m_kelas->count();
        $config['per_page'] = $limit;
               
        $this->pagination->initialize($config);
        
        $data = array(
            'content' => 'kelas/_kelas',
            'pageTitle' => 'Data Kelas',
            'kelas' => $this->m_kelas->semua($limit,$offset),
            
        );
        
        $this->load->view('tpl/content', $data);

	}

	public function ubah($id)
	{
		$data = array(
            'content' => 'kelas/_form-update',
            'pageTitle' => 'Ubah Kelas',
            'kelas' => $this->m_kelas->satu($id)->row(),
            'guru' => $this->m_kelas->guru()
        );
        $this->load->view('tpl/content', $data);
	}

	// Add a new item
	public function tambah()
	{
        $this->form_validation->set_rules('nama_kelas', 'NAMA MAPEL', 'required|is_unique[tbl_kelas.nama_kelas]');
        $this->form_validation->set_rules('wali_kelas', 'WALI KELAS', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'kelas/_form',
                'pageTitle' => 'Tambah Kelas',
                'guru' => $this->m_kelas->guru()
            );
            $this->load->view('tpl/content',$data);
        } else {
            $data['nama_kelas']      = $this->input->post('nama_kelas');
            $data['wali_kelas']  = $this->input->post('wali_kelas');
            
            $this->m_kelas->tambah($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Dibuat');
            
            redirect(site_url('kelas'));
        }
        return false;
	}

	//Update one item
	public function update( $id = NULL )
	{
        
        $original_value = $this->m_kelas->satu($id)->row()->nama_kelas ;
        if($this->input->post('nama_kelas') != $original_value) {
           $is_unique =  '|is_unique[tbl_kelas.nama_kelas]';
        } else {
           $is_unique =  '';
        }
        $this->form_validation->set_rules('nama_kelas', 'NAMA MAPEL', 'required'.$is_unique);
        $this->form_validation->set_rules('wali_kelas', 'WALI KELAS', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'kelas/_form-update',
                'pageTitle' => 'Ubah Kelas',
                'kelas' =>  $this->m_kelas->satu($id)->row(),
                'guru' => $this->m_kelas->guru()
            );
            $this->load->view('tpl/content',$data);
        } else {
            $data['nama_kelas']      = $this->input->post('nama_kelas');
            $data['wali_kelas']  = $this->input->post('wali_kelas');
            $data['id'] = $id;
            
            $this->m_kelas->update($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            
            redirect(site_url('kelas'));
        }
        return false;
	}

	//Delete one item
	public function hapus($id = NULL)
    {
        $data['id'] = $id;
        $this->m_kelas->hapus($data);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect(site_url('kelas'));
    }

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
