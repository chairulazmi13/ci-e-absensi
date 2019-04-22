<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpengaturan extends CI_Controller {

	function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}

	  	$this->load->model('mPegawai');
	    $this->load->model('mAbsensi');
	    $this->load->model('mCuti');
	    $this->load->model('mDinas');
      $this->load->model('mPengaturan');
  	}

  // Halaman data pegawai
  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/pengaturan');
    $this->load->view('template/footer');
  }

  function loadPengaturan()
  {
    $data = $this->mPengaturan->getPengaturanWhere('1');
    foreach ($data->result_array() as $key) {
      $response = array(
        'id' => $key['id'],
        'nama_perusahaan' => $key['nama_perusahaan'],
        'alamat' => $key['alamat'],
        'mulai_absensi' => $key['mulai_absensi'],
        'mulai_masuk' => $key['mulai_masuk'],
        'mulai_pulang' => $key['mulai_pulang'],
        'timeoutQR' => $key['timeout_qr_code'], 
      );
    }
    echo json_encode($response);
  }

  function updatePengaturan()
  {
    $id = $this->input->post('id');
    $nama_perusahaan = $this->input->post('namaperusahaan');
    $alamat_perusahaan = $this->input->post('alamat');
    $mulai_absensi = $this->input->post('mulaiAbsensi');
    $mulai_masuk = $this->input->post('mulaiMasuk');
    $mulai_pulang = $this->input->post('mulaiPulang');
    $timeoutQR = $this->input->post('ExpiredQR');

    $data = array(
      'id' => $id,
      'nama_perusahaan' => $nama_perusahaan,
      'alamat' => $alamat_perusahaan,
      'mulai_absensi' => $mulai_absensi,
      'mulai_masuk' => $mulai_masuk,
      'mulai_pulang' => $mulai_pulang,
      'timeout_qr_code' => $timeoutQR ,
    );

    $response['data'] = $this->mPengaturan->updatePengaturan($id,$data);
    $response['msg'] = 'Pengaturan Diupdate';

    echo json_encode($response);
  }
  
}