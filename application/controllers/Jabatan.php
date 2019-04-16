<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
  	$this->load->model('mJabatan');
    $this->load->model('mPegawai');

  }

  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/jabatan');
    $this->load->view('template/footer');
  }

  function Alljabatan()
  {
    $query = $this->mJabatan->getAll();
    foreach ($query->result() as $hasil) {
          $id = $hasil->id_jabatan;
          $response['data'][] = array(
            'id_jabatan' => $hasil->id_jabatan,
            'nama_jabatan' => $hasil->nama_jabatan,
            'keterangan' => $hasil->keterangan,
            'jumlah' => $this->mJabatan->countPegawai($id),
          );
        }
    echo json_encode($response);
  }

  function droplistjabatan()
  {
    $data = $this->mJabatan->getAll()->result();
    echo json_encode($data);
  }

  function JabatanByID()
  {
    $id = $this->input->get('id_jabatan');
    $where = array('id_jabatan' => $id, );
    $data = $this->mJabatan->getByID($where);
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

    $data = $this->mJabatan->insert($where);
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

    $data = $this->mJabatan->update($id_jabatan,$update);
    echo json_encode($data);
  }

  function deleteJabatan()
  {
    $id = $this->input->post('id_jabatan');
    $wherePegawai = array('id_jabatan' => $id, );
    $pegawai = $this->mPegawai->getByID($wherePegawai);
    if ($pegawai->num_rows()>0) {
      $response['status'] = 'error';
      $response['msg']    = 'Ada pegawai dengan divisi tersebut';
    } else {
      $where = array('id_jabatan' => $id, );
      $response['data']   = $this->mJabatan->delete($where);
      $response['status'] = 'success';
      $response['msg']    = 'Jabatan dihapus';
    }
    echo json_encode($response);
  }
}
