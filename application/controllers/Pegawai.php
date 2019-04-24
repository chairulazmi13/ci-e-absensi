<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('Login'));
  	}

  	$this->load->model('Mpegawai');

  }

  // Halaman data pegawai
  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/pegawai');
    $this->load->view('template/footer');
  }

  // Halaman Input Pegawai
  function forminsert()
  {
    $this->load->view('admin/pegawaiAdd');
  }

  // Halaman Edit Pegawai
  function formedit()
  {
    $this->load->view('admin/pegawaiEdit');
  }

  function getAllPegawai()
  {
    $response['data'] = $this->Mpegawai->getAll()->result();
    echo json_encode($response);
  }

  function getPegawaiID()
  {
    $id = $this->input->get('id');
    $where = array('id' => $id, );
    $response = $this->Mpegawai->getDetailByID($where);
    echo json_encode($response);
  }

  function insertPegawai()
  {
    $nama = $this->input->post('nama');
    $nip = $this->input->post('nip');
    $kota = $this->input->post('kota');
    $alamat = $this->input->post('alamat');
    $divisi = $this->input->post('divisi');
    $jabatan = $this->input->post('jabatan');
    $ip_address = $this->input->post('ip_address');
    $password = md5($nip);

    $data = array(
      'nip' => $nip ,
      'nama' => $nama,
      'password_pegawai' => $password,
      'kota' => $kota,
      'alamat' => $alamat,
      'id_divisi' => $divisi,
      'id_jabatan' => $jabatan,
      'ip_address' => $ip_address
    );

    $response = $this->Mpegawai->insert($data);
    echo json_encode($response);
  }

  function deletePegawai()
  {
    $id = $this->input->post('id');
    $data = array('aktif_pegawai' => 0, );
    $response['data'] = $this->Mpegawai->update($id,$data);
    if ($response['data'] == true) {
      $response['msg'] = 'Non aktif sukses';
    } else {
      $response['msg'] = 'Non aktif gagal';
    }
    echo json_encode($response);
  }

  function updatePegawai()
  {
    $id = $this->input->post('id');
    $data = array(
      'nip' => $this->input->post('nip'),
      'nama' => $this->input->post('nama'),
      'kota' => $this->input->post('kota'),
      'alamat' => $this->input->post('alamat'),
      'id_divisi' => $this->input->post('id_divisi'),
      'id_jabatan' => $this->input->post('id_jabatan'),
      'ip_address' => $this->input->post('ip_address'),
    );
    $response['data'] = $this->Mpegawai->update($id,$data);
    $response['msg'] = 'Data pegawai'.$this->input->post('nama').'dirubah';
    echo json_encode($response);
  }

  // cek NIP pegawai
  function PegawaiByNIP()
  {
    $id = $this->input->post('nip');
    if (preg_match('/\s/',$id) or $id == '') {
        $response['status'] = 'error';
        $response['msg'] = 'NIP haru disisi dan Jangan gunakan Spasi';
    } else {
      $where = array('nip' => $id, );
      $data = $this->Mpegawai->getByID($where)->num_rows();
      if ($data > 0) {
        $response['status'] = 'error';
        $response['msg'] = '<label class="control-label text-red" id="inputError"><i class="fa fa-times-circle-o"></i> NIP sudah ada</label>';
      } else {
        $response['status'] = 'success';
        $response['msg'] = '<label class="control-label text-green" id="inputSuccess"><i class="fa fa-check"></i> NIP Bisa Dipakai</label>';
      }
    }
    echo json_encode($response);
  }
}
