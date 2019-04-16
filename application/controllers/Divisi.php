<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
  	$this->load->model('mDivisi');
    $this->load->model('mPegawai');

  }

  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/divisi');
    $this->load->view('template/footer');
  }

  function AllDivisi()
  {
    $query = $this->mDivisi->getAll();
		foreach ($query->result() as $hasil) {
          $id = $hasil->id_divisi;
  				$response['data'][] = array(
  					'id_divisi' => $hasil->id_divisi,
  					'nama_divisi' => $hasil->nama_divisi,
  					'keterangan' => $hasil->keterangan,
            'jumlah' => $this->mDivisi->countPegawai($id),
  				);
  			}
    echo json_encode($response);
  }

  function droplistDivisi()
  {
    $response = $this->mDivisi->getAll()->result();
    echo json_encode($response);
  }

  function json(){
        $this->datatables->select('*');
        $this->datatables->from('Divisi');
        return print_r($this->datatables->generate());
    }

  function DivisiByID()
  {
    $id = $this->input->get('id_divisi');
    $where = array('id_divisi' => $id, );
    $data = $this->mDivisi->getByID($where);
    echo json_encode($data);
  }

  function insertDivisi()
  {
    $divisi = $this->input->post('nama_divisi');
    $keterangan = $this->input->post('keterangan');
    $where = array(
      'nama_divisi' => $divisi,
      'keterangan' => $keterangan,
    );

    $data = $this->mDivisi->insert($where);
    echo json_encode($data);
  }

  function updateDivisi()
  {
    $id_divisi = $this->input->post('id_divisi');
    $nama_divisi = $this->input->post('nama_divisi');
    $keterangan = $this->input->post('keterangan');

    $update = array(
      'nama_divisi' => $nama_divisi,
      'keterangan' => $keterangan,
    );

    $data = $this->mDivisi->update($id_divisi,$update);
    echo json_encode($data);
  }

  function deleteDivisi()
  {
    $id = $this->input->post('id_divisi');

    $wherePegawai = array('id_divisi' => $id, );
    $pegawai = $this->mPegawai->getByID($wherePegawai);
    if ($pegawai->num_rows()>0) {
      $response['status'] = 'error';
      $response['msg'] = 'Ada pegawai dengan divisi tersebut';
    } else {
      $where = array('id_divisi' => $id, );
      $data = $this->mDivisi->delete($where);
      $response['status'] = 'success';
      $response['msg'] = 'Dihapus';
    }
    echo json_encode($response);
  }

}
