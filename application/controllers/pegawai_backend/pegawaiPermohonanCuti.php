<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawaiPermohonanCuti extends CI_Controller {
  function __construct(){
  	parent::__construct();
  	if($this->session->userdata('pegawai_login') == 0){
  		redirect(base_url('pegawai-login'));
  	}
  	$this->load->model('mPegawai');
    $this->load->model('mAbsensi');
    $this->load->model('mCuti');
    $this->load->model('mUser');
    $this->load->library('hitunghari');
    $this->load->library('validasidetail');

  }

  // ---------------------- FORM CUTI -------------------------- //
  function buat() // Halaman permohonanan cuti
  {
  	$this->load->view('template/header_pegawai');
    $this->load->view('pegawai/buatcuti');
    $this->load->view('template/footer_pegawai');
  }

  function appsview() // Halaman permohonanan cuti untuk aplikasi android
  {
    $this->load->view('template/header_pegawai_x');
    $this->load->view('pegawai/buatcuti');
    $this->load->view('template/footer_pegawai');
  }

  function listAdmin()
  {
    $data = $this->mUser->getAll()->result();
    echo json_encode($data);
  }

  function insert() // insert atau mengirim permohonan cuti
  {
    $id_pegawai    = $this->session->userdata("p_id_pegawai");
    $tgl_pengajuan = date('Y-m-d');
    $tgl_mulai     = $this->input->post('tanggalMulai');
    $tgl_selesai   = $this->input->post('tanggalAkhir');

    // merubah format tanggal
    $start = $this->hitunghari->tglindo($tgl_mulai);
    $end   = $this->hitunghari->tglindo($tgl_selesai);
    // menghitung hari cuti (sabtu,minggu dan hari libur tidak dihitung)
    $jumlah_hari   = $this->hitunghari->hitungHariKerja($start, $end,"-");

    $jenis_cuti    = $this->input->post('jenisCuti');
    $keterangan    = $this->input->post('keterangan');
    $approve       = 0; //approval secara default pending
    $approve_by    = $this->input->post('admin');

    // Ceking tanggal mulai apakah ditanggal tersebut sudah pernah cuti atau belum
    $cekTglMulai   = $this->validasidetail->cekTanggalMulai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);
    // Ceking tanggal selesai apakah ditanggal tersebut sudah pernah cuti atau belum
    $cekTglSelesai = $this->validasidetail->cekTanggalSelesai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);

    // jika sudah pernah cuti akan muncul peringatan
    if ($cekTglMulai == 1) {
        $response['status'] = 'error';
        $response['msg'] = 'sudah cuti di awal tanggal ini';
    } elseif($cekTglSelesai == 1){
        $response['status'] = 'error';
        $response['msg'] = 'sudah cuti di tanggal selesai ini';
    }
    // jika tidak ditemukan cuti di tanggal tersebut akan di insert
    else {
        $data = array(
            'id_pegawai' => $id_pegawai,
            'tanggal_pengajuan' => $tgl_pengajuan,
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'jumlah_hari' => $jumlah_hari,
            'jenis_cuti' => $jenis_cuti,
            'keterangan' => $keterangan,
            'approve' => $approve,
            'approve_by' => $approve_by,
          );

         $response['status'] = 'success';
         $response['data']   = $this->mCuti->insert($data); // melakuakn insert ke database
         $response['msg']    = 'Permohonan Cuti terkirim';
    }
    echo json_encode($response);
  }
  // --------------------- END FORM CUTI ----------------------- //

  // --------------------- INBOX ------------------------- //
  function inbox()
  {
    $this->load->view('template/header_pegawai');
    $this->load->view('pegawai/inboxcuti');
    $this->load->view('template/footer_pegawai');
  }
   // ------------------ END INBOX ---------------------- //
}
