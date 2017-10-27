<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 /*
  * Simple_login Class
  * Class ini digunakan untuk fitur login, proteksi halaman dan logout
  * @author  Gun Gun Priatna
  * @url    https://recodeku.blogspot.com
  */
 
 class Simple_login {
 
     // SET SUPER GLOBAL
     var $CI = NULL;
 
     /**
      * Class constructor
      *
      * @return   void
      */
     public function __construct() {
         $this->CI =& get_instance();
     }
 
     /*
     * cek username dan password pada table users, jika ada set session berdasar data user dari
     * table users.
     * @param string username dari input form
     * @param string password dari input form
     */
     public function login($username, $password) {
         
         //cek username dan password
         $query = $this->CI->db->get_where('tbl_users',array('username'=>$username,'password' => md5($password)));
 
         if($query->num_rows() == 1) {
             //ambil data user berdasar username
             $row  = $this->CI->db->query('SELECT * FROM tbl_users where username = "'.$username.'"');
             $admin     = $row->row();
             $id   = $admin->id_user;
             $email   = $admin->email;
             $nama   = $admin->nama;
             $hak = $admin->hak_akses;
 
             //set session user
             $this->CI->session->set_userdata('username', $username);
             $this->CI->session->set_userdata('id_login', uniqid(rand()));
             $this->CI->session->set_userdata('id', $id);
             $this->CI->session->set_userdata('hak', $hak);
             $this->CI->session->set_userdata('email', $email);
             $this->CI->session->set_userdata('nama', $nama);
 
             //redirect ke halaman dashboard
             redirect(site_url('beranda/'.$hak));
         }else{
 
             //jika tidak ada, set notifikasi dalam flashdata.
             $this->CI->session->set_flashdata('sukses','Username atau password anda salah, silakan coba lagi.. ');
 
             //redirect ke halaman login
             redirect(site_url('login'));
         }
          return false;
      }
     
     /**
      * Cek session login, jika tidak ada, set notifikasi dalam flashdata, lalu dialihkan ke halaman
      * login
      */
     public function cek_login($hak) {
 
         //cek session username
         if($this->CI->session->userdata('username') == '') {
 
             //set notifikasi
             $this->CI->session->set_flashdata('sukses','Anda belum login');
 
             //alihkan ke halaman login
             redirect(site_url('login'));
         }
         if ($this->CI->session->userdata('hak') <> $hak) {
            //set notifikasi
             $this->CI->session->set_flashdata('sukses','Anda Tidak Memiliki Hak Akses Untuk Halaman Yang Anda Minta');
 
             //alihkan ke halaman login
             redirect(site_url('beranda/'.$this->CI->session->userdata('hak')));
         }
     }
 
     /**
      * Hapus session, lalu set notifikasi kemudian di alihkan
      * ke halaman login
      */
     public function logout() {
         $this->CI->session->unset_userdata('username');
         $this->CI->session->unset_userdata('id_login');
         $this->CI->session->unset_userdata('id');
         $this->CI->session->set_flashdata('sukses','Anda berhasil logout');
         redirect(site_url('login'));
     }
 }