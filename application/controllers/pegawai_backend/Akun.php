<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('pegawai_login') == 0){
  		redirect(base_url('pegawai-login'));
  	}

  	$this->load->model('Mpegawai');

  }

  function index()
  {
  	$this->load->view('template/header_pegawai');
    $this->load->view('pegawai/akun');
    $this->load->view('template/footer_pegawai');
  }

}
