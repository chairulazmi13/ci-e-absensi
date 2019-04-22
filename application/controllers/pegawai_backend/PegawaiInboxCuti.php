<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiInboxCuti extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('pegawai_login') == 0){
  		redirect(base_url('pegawai-login'));
  	}

  	$this->load->model('mPegawai');
    $this->load->model('mInboxCuti');
    $this->load->library('datatables');

  }

  function index()
  {
  	$this->load->view('template/header_pegawai');
    $this->load->view('pegawai/inboxcuti');
    $this->load->view('template/footer_pegawai');
  }

  function appsview()
  {
    $this->load->view('template/header_pegawai_x');
    $this->load->view('pegawai/kehadiran');
    $this->load->view('template/footer_pegawai');
  }

  public function table_cuti()
  {
    $id_pegawai = $this->session->userdata('p_id_pegawai');
    $list = $this->mInboxCuti->get_datatables($id_pegawai);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $cuti) {

            if ($cuti->approve == 0) {
              $status = "pending";
            } elseif ($cuti->approve == 2) {
              $status = "Ditolak";
            }

            $row = array();
            $row[] = $cuti->id_cuti;
            $row[] = $cuti->tanggal_pengajuan;
            $row[] = $cuti->keterangan;
            $row[] = $cuti->tanggal_mulai.' - '.$cuti->tanggal_selesai;
            $row[] = $cuti->jumlah_hari;
            $row[] = $cuti->jenis_cuti;
            $row[] = $status;
            $row[] = '<a href="'.site_url("download-file/$cuti->file").'">Download</a>';

            $data[] = $row;
      }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->mInboxCuti->count_all($id_pegawai),
      "recordsFiltered" => $this->mInboxCuti->count_filtered($id_pegawai),
      "data" => $data,
    );

    //output to json format
    echo json_encode($output);
  }

  function download($data){
    force_download('assets/files/'.$data,NULL);
  }

}
