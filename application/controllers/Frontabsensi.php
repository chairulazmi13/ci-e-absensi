<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontabsensi extends CI_Controller {

  function __construct(){
  	parent::__construct();
    $this->load->library('loadpengaturan');
  	$this->load->model('Mpegawai');
    $this->load->model('Mabsensi');
    $this->load->model('Mlog');
    $this->load->model('Mpengaturan');

  }

  function index()
  {
    $this->load->view('absen');
  }

  private function cekExpiredQR($last_activity)
  { 
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');

    $expired = date('Y-m-d').' '.$this->loadpengaturan->getPengaturan('timeout_qr_code'); 
    // Output:  (yyyy-mm-dd 00:00:00)
    $awal  = date_create($last_activity);
    $akhir = date_create($now); // waktu expired
    $diff  = date_diff( $awal, $akhir );

    $timeRange = date('Y-m-d').' '.$diff->format('%H:%I:%S'); // Output:  (yyyy-mm-dd 00:00:00)

    if ($timeRange >= $expired) {
      $response = 0; // QR Code Sudah Expired
    } elseif ($timeRange <= $expired) {
      $response = 1; // QR Code Belum Expired
    }
    return $response;
    // Output:  true false
  }

  private function cekTelatAbsensi($masuk)
  { 
    date_default_timezone_set('Asia/Jakarta');
    $data = $this->Mpengaturan->getPengaturan();
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
  function insert()
  {
    date_default_timezone_set('Asia/Jakarta');
    $qrcode = $this->input->post('qrcode');
    $nip = substr($qrcode,0,18);
    $get_ip = ltrim($qrcode,$nip);
    $phone_ip_address = long2ip($get_ip);
    $tanggal = date('Y-m-d');
    $jam_absensi = date('Y-m-d H:i:s');
    $time = date('H:i:s');
    $whereNip = array('nip' => $nip, );
    $cekNIP = $this->Mpegawai->getByID($whereNip);

    $getPengaturan = $this->Mpengaturan->getPengaturan();
    foreach ($getPengaturan->result_array() as $setelan) {
      $id_setelan = $setelan['id'];
      $namaPerusahaan = $setelan['nama_perusahaan'];
      $alamat = $setelan['alamat'];
      $mulai_absensi = $setelan['mulai_absensi'];
      $mulai_masuk = $setelan['mulai_masuk'];
      $mulai_pulang = $setelan['mulai_pulang'];
    }

    if ($cekNIP->num_rows()>0) { // cek NIP di tabel pegawai apakah ada ?
      foreach ($cekNIP->result_array() as $hasil) {
        $id_pegawai = $hasil['id'];
        $nip_pegawai = $hasil['nip'];
        $nama_pegawai = $hasil['nama'];
        $last_activity = $hasil['last_activity'];
        $ip_address = $hasil['ip_address'];
      }

        $where = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal);
        $cekAbsensi = $this->Mabsensi->getByID($where); //cek NIp apakah tanggal tersebut sudah absen ?

        if ($time < $mulai_absensi) {
          $response['msg']  = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Info</h4>
                Absensi belum dibuka.
              </div>';
        } elseif ($phone_ip_address != $ip_address) {
          $response['msg']  = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Absen gagal</h4>
                Pastikan device milik sendiri dan terhubung ke Jaringan Kantor
              </div>';
        } elseif ($this->cekExpiredQR($last_activity) == 0) {
          $response['msg']  = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Absen gagal</h4>
                QR Code expired
              </div>';
        } elseif ($this->cekExpiredQR($last_activity) == 1) {

          if ($time > $mulai_absensi) {

            $start_masuk = date($mulai_masuk);

            if ($time > $start_masuk) { // late
              $keterangan = 'Masuk Telat '. $this->cekTelatAbsensi($jam_absensi);
              $jam_telat = date($this->cekTelatAbsensi($jam_absensi));
              $telat = 1;
            } else { // ontime
              $keterangan = 'Masuk';
              $jam_telat = date('00:00:00');
              $telat = 0;
            }
            
            $in = array( // Data pegawai masuk
              'id_pegawai' => $id_pegawai,
              'tanggal' => $tanggal,
              'mulai_masuk' => $mulai_masuk,
              'jam_masuk' => $jam_absensi,
              'jam_telat' => $jam_telat,
              'telat' => $telat,
              'masuk' => 1,
              'keterangan' => $keterangan
            );

            $log_in = array( // Data Log pegawai masuk
              'nip' => $nip_pegawai,
              'nama' => $nama_pegawai,
              'tanggal' => $tanggal,
              'time' => $jam_absensi,
              'keterangan' => $keterangan
            );

            // if ($cekAbsensi->num_rows() > 0) { // jika sudah melakukan absensi
            //   $response['msg']  = '<div class="alert alert-warning alert-dismissible">
            //       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            //       <h4><i class="icon fa fa-warning"></i> info</h4>
            //       Anda sudah melakukan absensi masuk hari ini.
            //     </div>';

            // }

            if ($time < $mulai_pulang && $cekAbsensi->num_rows()<1){ // jika belum melakukan absensi dan masih dibawah jam kerja
                  $response['data'] = $this->Mabsensi->insert($in); // akan di input masuk
                  $response['msg']  = '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-success"></i> Selamat datang '.$nama_pegawai.'</h4>
                      Selamat bekerja :).
                    </div>';

                  if ($response['data'] == true) {
                    $this->Mlog->insert($log_in);
                  }
              }
                
            elseif ($time > $mulai_pulang && $cekAbsensi->num_rows()>0) { // jika sudah jam pulang
                  // dan pegawai sudah absen masuk
                      // maka akan di input absen pulang

                      $out = array( // Data waktu pulang
                        'jam_pulang' => $jam_absensi
                      );

                      $log_out = array( // Data Log pegawai masuk
                        'nip' => $nip_pegawai,
                        'nama' => $nama_pegawai,
                        'tanggal' => $tanggal,
                        'time' => $jam_absensi,
                        'keterangan' => 'pulang'
                      );

                      $where = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal); // where id && tanggal
                      $this->Mabsensi->update($where,$out);
                      $this->Mlog->insert($log_out);
                      $response['msg']  = '<div class="alert alert-info alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <h4><i class="icon fa fa-info"></i> Pulang</h4>
                              Hati hati dijalan '.$nama_pegawai.' :)
                            </div>';         
             }

            elseif ($cekAbsensi->num_rows() > 0) { // jika sudah melakukan absensi
              $response['msg']  = '<div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> info</h4>
                  Anda sudah melakukan absensi masuk hari ini.
                </div>';

             } 

            elseif ($cekAbsensi->num_rows() < 1) { // namun jika tidak ditak ditemukan absen masuk
                    // dinyaatakan tidak berangkat
                    $response['msg']  = '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-success"></i> Sudah jam pulang</h4>
                    Anda belum absen.
                    </div>';
              }

            }
          }
        
    
    } else { // jika NIP pegawai tidak ditemukan
      $response['msg']  = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-danger"></i> 404</h4>
                Data pegawai tidak ditemukan
              </div>';

    }
    echo json_encode($response);
  }

}