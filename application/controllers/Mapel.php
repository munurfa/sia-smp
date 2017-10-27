<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->simple_login->cek_login('Admin');
		$this->load->model('m_mapel');
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$limit = 7;
        $config['base_url'] = base_url('mapel/index');
        $config['total_rows'] = $this->m_mapel->count();
        $config['per_page'] = $limit;
               
        $this->pagination->initialize($config);
        
        $data = array(
            'content' => 'mapel/_mapel',
            'pageTitle' => 'Data Mapel',
            'guru' => $this->m_mapel->semua($limit,$offset)
        );
        
        $this->load->view('tpl/content', $data);

	}
    public function report( $offset = 0 )
    {
        $limit = 100;
        $config['base_url'] = base_url('mapel/index');
        $config['total_rows'] = $this->m_mapel->count();
        $config['per_page'] = $limit;
               
        $this->pagination->initialize($config);
        
        $data = array(
            'guru' => $this->m_mapel->semua($limit,$offset)
        );
        
        $this->load->view('mapel/_mapel_report', $data);

    }
	public function ubah($id)
	{
		$data = array(
            'content' => 'mapel/_form-update',
            'pageTitle' => 'Ubah Mapel',
            'mapel' => $this->m_mapel->satu($id)->row()
        );
        $this->load->view('tpl/content', $data);
	}

	// Add a new item
	public function tambah()
	{
		$this->form_validation->set_rules('nama_mapel', 'NAMA MAPEL', 'required');
        $this->form_validation->set_rules('kd_mapel', 'KODE MAPEL', 'trim|required|alpha_numeric|is_unique[tbl_mapel.kd_mapel]');
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        $this->form_validation->set_rules('kkm', 'KKM', 'required|decimal|greater_than[0]');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'mapel/_form',
                'pageTitle' => 'Tambah Mapel'
            );
            $this->load->view('tpl/content',$data);
        } else {
            $data['nama_mapel']      = $this->input->post('nama_mapel');
            $data['kd_mapel']  = $this->input->post('kd_mapel');
            $data['kelas'] = $this->input->post('kelas');
            $data['kkm'] = $this->input->post('kkm');
            
            $this->m_mapel->tambah($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Dibuat');
            
            redirect(site_url('mapel'));
        }
        return false;
	}

	//Update one item
	public function update( $id = NULL )
	{
        
        $original_value = $this->m_mapel->satu($id)->row()->kd_mapel ;
        if($this->input->post('kd_mapel') != $original_value) {
           $is_unique =  '|is_unique[tbl_mapel.kd_mapel]';
        } else {
           $is_unique =  '';
        }
        $this->form_validation->set_rules('nama_mapel', 'NAMA MAPEL', 'required');
        $this->form_validation->set_rules('kd_mapel', 'KODE MAPEL', 'trim|required|alpha_numeric'.$is_unique);
        $this->form_validation->set_rules('kelas', 'KELAS', 'required');
        $this->form_validation->set_rules('kkm', 'KKM', 'required|decimal|greater_than[0]');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'mapel/_form-update',
                'pageTitle' => 'Ubah Mapel',
                'mapel' =>  $this->m_mapel->satu($id)->row()
            );
            $this->load->view('tpl/content',$data);
        } else {
             $data['nama_mapel']      = $this->input->post('nama_mapel');
            $data['kd_mapel']  = $this->input->post('kd_mapel');
            $data['kelas'] = $this->input->post('kelas');
            $data['kkm'] = $this->input->post('kkm');
            $data['id'] = $id;
            
            $this->m_mapel->update($data);
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            
            redirect(site_url('mapel'));
        }
        return false;
	}

	//Delete one item
	public function hapus($id = NULL)
    {
        $data['id'] = $id;
        $this->m_mapel->hapus($data);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect(site_url('mapel'));
    }

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
