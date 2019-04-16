<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
  	$this->load->model('mUser');
    $this->load->model('mPegawai');

  }

// Landing page halaman User
  function index()
  {
  	$this->load->view('template/header');
    $this->load->view('admin/user');
    $this->load->view('template/footer');
  }

  // Landing page halaman User
  function rubahPassword()
    {
    	$this->load->view('template/header');
      $this->load->view('admin/rubahPassword');
      $this->load->view('template/footer');
    }

// menampilkan data tabel user
  function getAllUser()
  {
    $response['data'] = $this->mUser->getAll()->result();
    echo json_encode($response);
  }

  // mendapatkan username by id_user
  function getUsernameByID()
  {
    $id_user = $this->input->post('id_user');
    $where = array('id_user' => $id_user, );
    $query = $this->mUser->getByWhere($where);
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $response = array(
          'id_user' => $row['id_user'],
          'username'=> $row['username'],
          'id_level'=> $row['id_level'],
          'aktif'=> $row['aktif'],
        );
      }
    }
    echo json_encode($response);
  }

  // ceking username, apakai sudah dipakai atau belum
  function cekUsername()
  {
    $username = $this->input->post('username');
    if (preg_match('/\s/',$username) or $username == '') {
        $response['status'] = 'empty';
        $response['class'] = 'form-group';
        $response['msg'] = '<div class="callout callout-warning"><h4>Peringatan</h4><p> Username haru disisi dan Jangan gunakan Spasi</p></div>';
    } else {
        $where = array('username' => $username, );
        $query = $this->mUser->getByWhere($where);
        if ($query->num_rows()>0) {
        $response['status'] = 'error';
        $response['class'] = 'form-group has-error';
        $response['msg'] = '<span class="control-label text-red"><i class="fa fa-bell"></i> username tidak tersedia</span>';
      } else{
        $response['status'] = 'success';
        $response['class'] = 'form-group has-success';
        $response['msg'] = '<span class="control-label text-green"><i class="fa fa-check"></i> Username tersedia</span>';
      }
    }
    echo json_encode($response);
  }

  function select2() // Menampilkan data pegawai di select2 sesuai NIP
  {
    $nama = $this->input->get('nama'); // = nama
    $where = array('nama' => $nama, );
    $data = $this->mPegawai->getLike($where); // like
    if ($data->num_rows() > 0) {
      foreach ($data->result_array() as $hasil) {
        $response[] = array(
          'id' => $hasil['id'],
          'text' => $hasil['nama'],
          'jabatan' => $hasil['nama_jabatan'],
          'divisi' => $hasil['nama_divisi'],
        );
      }
    }  else {
      $response[] = 'Data Kosong';
    }

    echo json_encode($response);
  }

  // insert user baru atau admin
  function insertUser()
  {
    $id_pegawai = $this->input->post('id_pegawai');
    $username   = $this->input->post('username');
    $password   = md5($this->input->post('password'));
    $level = $this->input->post('level');

    if ($id_pegawai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'pegawai tidak boleh Kosong';
    } elseif ($username == "") {
      $response['status'] = 'error';
      $response['msg'] = 'username tidak boleh Kosong';
    } elseif ($level == "") {
      $response['status'] = 'error';
      $response['msg'] = 'level tidak boleh Kosong';
    } else {
      $where = array('id_pegawai' => $id_pegawai, );
      $cekUser = $this->mUser->getByWhere($where); // ceking jika pegawai sudah dibuatkan user berdasarkan id_pegawai
      if ($cekUser->num_rows() > 0) { // jika sudah dibuatkan
        $response['status'] = 'error';
        $response['msg'] = 'pegawai tersebut sudah dibuat user';
      } else { // jika belum dibuatkan
        $data = array(
          'id_pegawai' => $id_pegawai,
          'username' => $username,
          'password' => $password,
          'id_level' => $level,
          'aktif' => 1,
          );
        $response['status'] = 'success';
        $response['data']   = $this->mUser->insert($data); // melakuakn insert ke database
        $response['msg']    = 'Pegawai dibuatkan user dengan username'.$username.'';
      }

    }
    echo json_encode($response);
  }

  function deleteUser()
  {
    $id_user = $this->input->post('id_user');
    $where = array('id_user' => $id_user, );
    $response['data'] = $this->mUser->delete($where);

    echo json_encode($response);
  }

  function updateuser()
  {
    $id_user = $this->input->post('id_user');
    $data = array(
      'aktif' => $this->input->post('status'),
      'id_level' => $this->input->post('level'),
    );
    $response['data'] = $this->mUser->update($id_user,$data);

    echo json_encode($response);
  }

  function updatePassword()
  {
    $id_user = $this->session->userdata('id_user');
    $old_password = $this->input->post('old_password');
    $new_password = $this->input->post('new_password');

    $whereUser = array(
      'id_user' => $id_user,
      'password' => md5($old_password)
    );

    $user = $this->mUser->getByWhere($whereUser);

    if($user->num_rows() > 0){
      $data = array(
        'password' => md5($new_password),
      );
      $this->mUser->update($id_user,$data);
      $response['msg'] = 'password dirubah';
    } else {
      $response['msg'] = 'password lama tidak sesuai!';
    }
    echo json_encode($response);
  }

}
