<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Beranda extends CI_Controller {
     function __construct(){
         parent::__construct();
         
     }
     public function index()
     {
         redirect('login');
     }
 
     //Load Halaman dashboard
     public function admin() {
        $this->simple_login->cek_login('Admin');
     	$data = array('content' => 'welcome_admin',
     				'pageTitle' => 'Beranda Admin' );
        $this->load->view('tpl/content', $data);
     }
      public function guru() {
        $this->simple_login->cek_login('Guru');
        $data = array('content' => 'welcome_guru',
                    'pageTitle' => 'Beranda Guru' );
        $this->load->view('tpl/content', $data);
     }
      public function Siswa() {
        $this->simple_login->cek_login('Siswa');
        $data = array('content' => 'welcome_Siswa',
                    'pageTitle' => 'Beranda Siswa' );
        $this->load->view('tpl/content', $data);
     }
 }