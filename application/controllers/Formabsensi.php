<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formabsensi extends CI_Controller {

  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}

  	$this->load->model('mPegawai');
    $this->load->model('mAbsensi');
    $this->load->model('mLog');
    $this->load->model('mPengaturan');

  }

  // Halaman data pegawai
  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/form_absensi');
    $this->load->view('template/footer');
  }

  function pengaturan()
  {
    $data = $this->mPengaturan->getPengaturan();

    foreach ($data->result_array() as $setelan) {
      $id_setelan = $setelan['id'];
      $namaPerusahaan = $setelan['nama_perusahaan'];
      $alamat = $setelan['alamat'];
      $mulai_absensi = $setelan['mulai_absensi'];
      $mulai_masuk = $setelan['mulai_masuk'];
      $mulai_pulang = $setelan['mulai_pulang'];
    }
  }

  // Menampilkan tabel absesnsi sesuai hari ini
  function absensiToday()
  {
    $tanggal = date('Y-m-d');
    $where = array('tanggal' => $tanggal);

    $response['data'] = $this->mAbsensi->getByWhere($where);
    echo json_encode($response);
  }

  function cekTelatAbsensi($masuk)
  { 
    $data = $this->mPengaturan->getPengaturan();
    foreach ($data->result_array() as $setelan) {
      $id_setelan = $setelan['id'];
      $mulai_masuk = $setelan['mulai_masuk'];
    }

    $awal  = date_create($masuk);
    $akhir = date_create($mulai_masuk); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );

    $response = $diff->format('%H:%I:%S');
    return $response;
    // Output:  00:00:00
  }

  // Proses absensi
  function absensi()
  {
    date_default_timezone_set('Asia/Jakarta');
    // option (masuk atau pulang)
    $status = $this->input->post('status');

    $nip = $this->input->post('nip');
    $tanggal = $this->input->post('tanggal');
    $jam_masuk = $tanggal.' '.date('H:i:s');
    $whereNip = array('nip' => $nip, );
    $cekNIP = $this->mPegawai->getByID($whereNip);

    if ($cekNIP->num_rows()>0) { // cek NIP di tabel pegawai apakah ada ?
      foreach ($cekNIP->result_array() as $hasil) {
        $id_pegawai = $hasil['id'];

        $where = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal);
        $cekAbsensi = $this->mAbsensi->getByID($where); //cek NIp apakah tanggal tersebut sudah absen ?

        if ($status == 1) { //Jika radio yang dipilih masuk
          $data = $this->mPengaturan->getPengaturan();
          foreach ($data->result_array() as $setelan) {
            $id_setelan = $setelan['id'];
            $mulai_masuk = $setelan['mulai_masuk'];
          }

          $start_masuk = date($mulai_masuk);

          if ($jam_masuk > $start_masuk) {
            $keterangan = 'Masuk Telat '. $this->cekTelatAbsensi($jam_masuk);
            $jam_telat = date($this->cekTelatAbsensi($jam_masuk));
            $telat = 1;
          } else {
            $keterangan = 'Masuk';
            $jam_telat = date('00:00:00');
            $telat = 0;
          }

          $in = array( // Data pegawai masuk
            'id_pegawai' => $id_pegawai,
            'tanggal' => $tanggal,
            'mulai_masuk' => $mulai_masuk,
            'jam_masuk' => $jam_masuk,
            'jam_telat' => $jam_telat,
            'telat' => $telat,
            'masuk' => 1,
            'keterangan' => $keterangan
          );

          $log_in = array( // Data Log pegawai masuk
            'nip' => $hasil['nip'],
            'nama' => $hasil['nama'],
            'tanggal' => $tanggal,
            'time' => $jam_masuk,
            'keterangan' => $keterangan
          );

          if ($cekAbsensi->num_rows()>0) { // jika sudah melakukan absensi
            $response['status'] = 'in';
            $response['notif']  = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Masuk</h4>
                Anda sudah melakukan absensi masuk di tanggal ini.
              </div>';

          } else { // jika belum melakukan absensi makan akan di input
            $response['status'] = "in";
            $response['notif']  = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-success"></i> Selamat datang</h4>
                Anda absen masuk.
              </div>';
            $response['data']  = $this->mAbsensi->insert($in);
            $response['log'] = $this->mLog->insert($log_in);
          }

        } elseif ($status == 2) { //jika radio yang dipilih keluar atau absen pulang

          $out = array( // Data waktu pulang
            'jam_pulang' => $jam_masuk
          );

          $log_out = array( // Data Log pegawai masuk
            'nip' => $hasil['nip'],
            'nama' => $hasil['nama'],
            'tanggal' => $tanggal,
            'time' => $jam_masuk,
            'keterangan' => 'pulang'
          );

          $where = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal); // where id && tanggal

          if ($cekAbsensi->num_rows()<1) { // jika belum absensi sesuai tanggal
            $response['status'] = 'in';
            $response['notif']  = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Masuk</h4>
                Anda Belum melakukan absensi masuk di tanggal ini.
              </div>';

          } else { // jika sudah absensi maka bisa absen pulang

            $response['status'] = "out";
            $response['notif']  = '<div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> Hati hati dijalan</h4>
                  Anda absen pulang.
                </div>';
            $response['data'] = $this->mAbsensi->update($where,$out);
            $response['log'] = $this->mLog->insert($log_out);
          }
        }

      }
    } else { // jika NIP pegawai tidak ditemukan

      $response['notif']  = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-danger"></i> 404</h4>
                Data pegawai tidak ditemukan
              </div>';

    }

    echo json_encode($response);

  }


}
