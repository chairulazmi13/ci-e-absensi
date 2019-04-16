<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	function index(){
		if( $this->session->userdata('login') == 1){
			redirect(base_url('Dashboard'));
		} else {
		$this->load->view('login');
		}
	}

	// Route : /Masuk
	function masuk(){
		if( $this->session->userdata('login') == 1){
			redirect(base_url('Dashboard'));
		} else {
			$username = $this->input->post('a');
			$password = $this->input->post('b');
			$where = array(
				'username' => $username,
				'password' => md5($password)
				);
			$this->load->model('mUser');
			$cek = $this->mUser->getByWhere($where);
			// Cek username apakah ada
			if($cek->num_rows() > 0){
				$data = $cek->row_array();
				if ($data['id_level'] > 0 and $data['aktif'] == 1) {
					$this->session->set_userdata('login',1);
					$this->session->set_userdata('id_user',$data['id_user']);
					$this->session->set_userdata('username',$data['username']);
					$this->session->set_userdata('id_level',$data['id_level']);
					$this->session->set_userdata('aktif',$data['aktif']);
					$this->session->set_userdata('id_pegawai',$data['id_pegawai']);
					$this->session->set_userdata('nip',$data['nip']);
					$this->session->set_userdata('nama',$data['nama']);
					$this->session->set_userdata('alamat',$data['alamat']);

					redirect('Dashboard');

				} elseif ($data['id_level'] > 0 and $data['aktif'] == 0) {
					$this->session->set_userdata('login','');
					$this->session->set_flashdata('login_gagal',
					'<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
					Akun anda non aktif
					</div>');
					redirect('login');
				} elseif ($data['id_level'] > 0 and $data['aktif'] == 2) {
					$this->session->set_userdata('login','');
					$this->session->set_flashdata('login_gagal',
					'<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
					Akun anda ditangguhkan
					</div>');
					redirect('login');
				} else {
					$this->session->set_userdata('login','');
					$this->session->set_flashdata('login_gagal',
					'<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
					Pastikan anda sebagai Admin
					</div>');
					redirect('login');
				}
			}
			else {
					$this->session->set_userdata('login',0);
					$this->session->set_flashdata('login_gagal',
					'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Gagal Login!</h4>
					Username atau Password Salah
					</div>');
					redirect('login');
			}
	}
	}

	function keluar(){
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
}
