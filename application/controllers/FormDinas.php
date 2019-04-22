<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class formDinas extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
  	$this->load->model('mPegawai');
    $this->load->model('mDinas');
    $this->load->helper('download');
    $this->load->library('hitunghari');
    $this->load->library('validasidetail');
  }

  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/form_dinas');
    $this->load->view('template/footer');
  }

  function getDinasByDate($fromDate,$toDate)
  {
    $where = array(
      'tanggal_pengajuan >=' => $fromDate,
      'tanggal_pengajuan <=' => $toDate,
    );
    $response['data'] = $this->mDinas->getWhere($where)->result_array();
    echo json_encode($response);
  }

  function getDinasByID()
  {
    $id = $this->input->get('id_dinas');
    $where = array('id_dinas' => $id, );
    $query = $this->mDinas->getWhere($where);
    if ($query->num_rows()>0) {
      foreach ($query->result_array() as $hasil) {
        $response = array(
          'id_dinas' => $hasil['id_dinas'],
          'id_pegawai' => $hasil['id_pegawai'],
          'tanggal_pengajuan' => $hasil['tanggal_pengajuan'],
          'tanggal_selesai' => $hasil['tanggal_selesai'],
          'tanggal_mulai' => $hasil['tanggal_mulai'],
          'jumlah_hari' => $hasil['jumlah_hari'],
          'tempat' => $hasil['tempat'],
          'keterangan' => $hasil['keterangan'],
        );
      }
    }
    echo json_encode($response);
  }

  function insert()
  {
    $id_dinas      = $this->mDinas->createIdDinas();
    $id_pegawai    = $this->input->post('id_pegawai');
    $tgl_pengajuan = date('Y-m-d');
    $tgl_mulai     = $this->input->post('tgl_mulai');
    $tgl_selesai   = $this->input->post('tgl_selesai');

    // merubah format tanggal 
    $start = $this->hitunghari->tglindo($tgl_mulai);
    $end   = $this->hitunghari->tglindo($tgl_selesai);
    $jumlah_hari   = $this->hitunghari->hitungHariKerja($start, $end,"-");

    $tempat        = $this->input->post('tempat');
    $keterangan    = $this->input->post('keterangan');

    if ($id_pegawai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'pegawai tidak boleh Kosong';
    } elseif ($tgl_mulai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'Tanggal mulai tidak boleh Kosong';
    } elseif ($tgl_selesai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'Tanggal Selesai tidak boleh Kosong';
    } elseif ($tempat === ""){
      $response['status'] = 'error';
      $response['msg'] = 'Tempat tidak boleh Kosong';
    } elseif ($keterangan == "") {
      $response['status'] = 'error';
      $response['msg'] = 'keterangan tidak boleh Kosong';
    } else {

          $data = array(
            'id_dinas' => $id_dinas,
            'id_pegawai' => $id_pegawai,
            'tanggal_pengajuan' => $tgl_pengajuan,
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'jumlah_hari' => $jumlah_hari,
            'keterangan' => $keterangan,
            'tempat' => $tempat,
            );

          $this->validasidetail->insertDetailDinas($id_pegawai,$id_dinas,$tgl_pengajuan,$tgl_mulai,$tgl_selesai);

          $response['status'] = 'success';
          $response['data']   = $this->mDinas->insert($data); // melakuakn insert ke database
          $response['msg']    = 'Pegawai dibuatkan dinas';
    }
    echo json_encode($response);
  }

  function updateDinas()
  {
    $id_dinas      = $this->input->post('id_dinas');
    $id_pegawai    = $this->input->post('id_pegawai');
    $tgl_pengajuan = $this->input->post('tgl_pengajuan');
    $tgl_mulai     = $this->input->post('tgl_mulai');
    $tgl_selesai   = $this->input->post('tgl_selesai');
    // merubah format tanggal 
    $start = $this->hitunghari->tglindo($tgl_mulai);
    $end   = $this->hitunghari->tglindo($tgl_selesai);
    $jumlah_hari   = $this->hitunghari->hitungHariKerja($start, $end,"-");

    $tempat        = $this->input->post('tempat');
    $keterangan    = $this->input->post('keterangan');

    $data = array(
      'tanggal_mulai' => $tgl_mulai,
      'tanggal_selesai' => $tgl_selesai,
      'jumlah_hari' => $jumlah_hari,
      'tempat' => $tempat,
      'keterangan' => $keterangan,
    );

    // mengupdate detailDinas, dengan menghapus terlebih dahulu kemudina minginput ulang
    $this->validasidetail->deleteDetailDinas($id_dinas);
    $this->validasidetail->insertDetailDinas($id_pegawai,$id_dinas,$tgl_pengajuan,$tgl_mulai,$tgl_selesai);

    $response['data'] = $this->mDinas->update($id_dinas,$data);
    $response['msg'] = 'Data diubah';
    $response['status'] = 'success';

    echo json_encode($response);
  }

  function hapusDinas()
  {
    $id = $this->input->post('id_dinas');
    $where = array('id_dinas' => $id, );

    $this->validasidetail->deleteDetailDinas($id);
    $this->mDinas->delete($where);

    $response['msg'] = 'Data perjalanan Dihapus';
    $response['status'] = 'success';

    echo json_encode($response);
  }

  function uploadFiles()
  {
          $id_pegawai    = $this->input->post('upload_id');
          // config upload
          $config['upload_path']="./assets/filesdinas";
          $config['allowed_types']='pdf|jpg|png';
          $config['encrypt_name'] = TRUE;
          $this->load->library('upload',$config);
          // -------------------------------------
          if( ! $this->upload->do_upload('file')){
            echo $this->upload->display_errors();
          } else {
            $dofile = array('upload_data' => $this->upload->data());
            $file = $dofile['upload_data']['file_name'];

            $data = array('file' => $file, );
            $this->mDinas->update($id_pegawai,$data); // melakuakn insert ke database
            echo 'Dokumen ditambahkan';
          }
  }

  function download($data){
    force_download('assets/filesdinas/'.$data,NULL);
  }

  function getKode()
  {
    echo $this->mDinas->createIdDinas();
  }
}
