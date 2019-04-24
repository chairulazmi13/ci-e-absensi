<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harilibur extends CI_Controller {

	function __construct()
  {
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('Login'));
  	}
	    $this->load->model('Mlibur');
      $this->load->model('Mpengaturan');
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
    $response = $this->Mlibur->getEvent();
    echo json_encode($response);
  }

  function getAllhariLibur()
  {
    $response['data'] = $this->Mlibur->getAll()->result_array();
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

    $response['data'] = $this->Mlibur->insert($data);
    $response['msg'] = 'hari libur dibuat';

    echo json_encode($response);
  }

  function deleteHariLibur()
  {
    $id = $this->input->post('id');
    $data = $this->Mlibur->delete($id);

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
    $response = $this->Mlibur->getByID($id);
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

    $response['data'] = $this->Mlibur->update($data,$id);
    $response['msg'] = 'update success';

    echo json_encode($response);   
  }

}
