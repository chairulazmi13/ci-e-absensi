<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawaikehadiran extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('pegawai_login') == 0){
  		redirect(base_url('pegawai-login'));
  	}

  	$this->load->model('Mpegawai');
    $this->load->model('Mabsensi');
    $this->load->model('Mcuti');
    $this->load->model('Mdinas');

  }

  function index()
  {
  	$this->load->view('template/header_pegawai');
    $this->load->view('pegawai/kehadiran');
    $this->load->view('template/footer_pegawai');
  }

  function appsview()
  {
    $this->load->view('template/header_pegawai_x');
    $this->load->view('pegawai/kehadiran');
    $this->load->view('template/footer_pegawai');
  }

  function getAbsensiFullcalendar()
  {
    $start = date($this->input->get('start'));
    $end   = date($this->input->get('end'));

    $id = $this->session->userdata('p_id_pegawai');
    $response = $this->Mabsensi->getEvent($id,$start,$end);
    echo json_encode($response);
  }

  function getCutiFullcalendar()
  {
    // FullCalendar V2 sends ISO8601 date strings
    $start = date($this->input->get('start'));
    $end   = date($this->input->get('end'));

    $id = $this->session->userdata('p_id_pegawai');
    $response = $this->Mcuti->getEvent($id,$start,$end);
    echo json_encode($response);
  }

  function getDinasFullcalendar()
  {
    // FullCalendar V2 sends ISO8601 date strings
    $start = date($this->input->get('start'));
    $end   = date($this->input->get('end'));

    $id = $this->session->userdata('p_id_pegawai');
    $response = $this->Mdinas->getEvent($id,$start,$end);
    echo json_encode($response);
  }

}
