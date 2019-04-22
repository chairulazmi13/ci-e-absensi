<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawaiLogin extends CI_Controller {
  function __construct(){
  	parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
  	$this->load->model('mPegawai');

  }

  function index()
  {
    if($this->session->userdata('pegawai_login') == 1){
      redirect(base_url('pegawai-dashboard'));
    } else {
      $this->load->view('login_pegawai');
    }
  }

  function logout(){
      $this->session->sess_destroy();
      redirect(base_url('pegawai-login'));
  }

  function login()
  {
    if( $this->session->userdata('pegawai_login') == 1){
      redirect(base_url('pegawai-dashboard'));
    } else {
      $nip = $this->input->post('nip');
      $password = $this->input->post('pswd');
      $where = array(
        'nip' => $nip,
        'password_pegawai' => md5($password)
        );
      $cek = $this->mPegawai->getByWhere($where);
      // Cek username apakah ada
      if($cek->num_rows() > 0){
        $data = $cek->row_array();
        if ($data['aktif_pegawai'] == 1) {
          $this->session->set_userdata('pegawai_login',1);
          $this->session->set_userdata('p_id_pegawai',$data['id']);
          $this->session->set_userdata('p_nip',$data['nip']);
          $this->session->set_userdata('p_nama',$data['nama']);
          $this->session->set_userdata('p_kota',$data['kota']);
          $this->session->set_userdata('p_alamat',$data['alamt']);
          $this->session->set_userdata('p_ip_address',$data['ip_address']);
          $this->session->set_userdata('p_last_activity',$data['last_activity']);
          $this->session->set_userdata('p_nama_divisi',$data['nama_divisi']);
          $this->session->set_userdata('p_nama_jabatan',$data['nama_jabatan']);
          redirect('pegawai-dashboard');
        } else {
          $this->session->set_userdata('pegawai_login','');
          $this->session->set_flashdata('login_gagal',
          '<div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
          Akun anda non aktif
          </div>');
          redirect('pegawai-login');
        }
      } else {
          $this->session->set_userdata('pegawai_login','');
          $this->session->set_flashdata('login_gagal',
          '<div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
          NIP atau Passsword Salah
          </div>');
          redirect('pegawai-login');
        }
    }
  }
}
