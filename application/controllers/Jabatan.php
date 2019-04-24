<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('Login'));
  	}
  	$this->load->model('Mjabatan');
    $this->load->model('Mpegawai');

  }

  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/jabatan');
    $this->load->view('template/footer');
  }

  function Alljabatan()
  {
    $query = $this->Mjabatan->getAll();
    foreach ($query->result() as $hasil) {
          $id = $hasil->id_jabatan;
          $response['data'][] = array(
            'id_jabatan' => $hasil->id_jabatan,
            'nama_jabatan' => $hasil->nama_jabatan,
            'keterangan' => $hasil->keterangan,
            'jumlah' => $this->Mjabatan->countPegawai($id),
          );
        }
    echo json_encode($response);
  }

  function droplistjabatan()
  {
    $data = $this->Mjabatan->getAll()->result();
    echo json_encode($data);
  }

  function JabatanByID()
  {
    $id = $this->input->get('id_jabatan');
    $where = array('id_jabatan' => $id, );
    $data = $this->Mjabatan->getByID($where);
    echo json_encode($data);
  }

  function insertJabatan()
  {
    $jabatan = $this->input->post('nama_jabatan');
    $keterangan = $this->input->post('keterangan');
    $where = array(
      'nama_jabatan' => $jabatan,
      'keterangan' => $keterangan,
    );

    $data = $this->Mjabatan->insert($where);
    echo json_encode($data);
  }

  function updateJabatan()
  {
    $id_jabatan = $this->input->post('id_jabatan');
    $nama_jabatan = $this->input->post('nama_jabatan');
    $keterangan = $this->input->post('keterangan');

    $update = array(
      'nama_jabatan' => $nama_jabatan,
      'keterangan' => $keterangan,
    );

    $data = $this->Mjabatan->update($id_jabatan,$update);
    echo json_encode($data);
  }

  function deleteJabatan()
  {
    $id = $this->input->post('id_jabatan');
    $wherePegawai = array('id_jabatan' => $id, );
    $pegawai = $this->Mpegawai->getByID($wherePegawai);
    if ($pegawai->num_rows()>0) {
      $response['status'] = 'error';
      $response['msg']    = 'Ada pegawai dengan divisi tersebut';
    } else {
      $where = array('id_jabatan' => $id, );
      $response['data']   = $this->Mjabatan->delete($where);
      $response['status'] = 'success';
      $response['msg']    = 'Jabatan dihapus';
    }
    echo json_encode($response);
  }
}
