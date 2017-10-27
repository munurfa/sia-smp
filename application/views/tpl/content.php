<?php 
$data['title']="SIA";
$this->load->view('tpl/header', $data);
$this->load->view('tpl/menu');
$this->load->view($content);
$this->load->view('tpl/footer');
 ?>