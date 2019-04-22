<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HariLibur extends CI_Controller {

	function __construct()
  {
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
	    $this->load->model('mLibur');
      $this->load->model('mPengaturan');
  }

  // Halaman data pegawai
  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/harilibur');
    $this->load->view('template/footer');
  }

  function getFullcalendar()
  {
    $response = $this->mLibur->getEvent();
    echo json_encode($response);
  }

  function getAllhariLibur()
  {
    $response['data'] = $this->mLibur->getAll()->result_array();
    echo json_encode($response);
  }

  function insertHariLibur()
  {
    $tanggal_libur = $this->input->post('tanggal');
    $keterangan = $this->input->post('keterangan');

    $data = array(
      'tanggal_libur' => date($tanggal_libur),
      'keterangan' => $keterangan 
    );

    $response['data'] = $this->mLibur->insert($data);
    $response['msg'] = 'hari libur dibuat';

    echo json_encode($response);
  }

  function deleteHariLibur()
  {
    $id = $this->input->post('id');
    $data = $this->mLibur->delete($id);

    if ($data == TRUE) {
      $response['msg']  = 'delete succees';
    } else {
      $response['msg'] = 'delete failed';
    }
    
    echo json_encode($response);    
  }

  function getHariLibur()
  {
    $id = $this->input->get('id');
    $response = $this->mLibur->getByID($id);
    echo json_encode($response);   
  }

  function updateHariLibur()
  {
    $id = $this->input->post('id');
    $tanggal_libur = $this->input->post('tanggal');
    $keterangan = $this->input->post('keterangan');

    $data = array(
      'tanggal_libur' => date($tanggal_libur),
      'keterangan' => $keterangan 
    );

    $response['data'] = $this->mLibur->update($data,$id);
    $response['msg'] = 'update success';

    echo json_encode($response);   
  }

}
