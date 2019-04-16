<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class formCuti extends CI_Controller {
  function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
  	$this->load->model('mPegawai');
    $this->load->model('mCuti');
    $this->load->helper('download');
    $this->load->library('hitunghari');
    $this->load->library('validasidetail');
  }

  function index()
  {
    $this->load->view('template/header');
    $this->load->view('admin/form_cuti');
    $this->load->view('template/footer');
  }

  function getAllCuti()
  {
    $response['data'] = $this->mCuti->getAll()->result_array();
     echo json_encode($response);
  }

  function getCuti()
  {
    $id = $this->input->get('id_cuti');
    $where = array('id_cuti' => $id, );
    $query = $this->mCuti->getWhere($where);
    if ($query->num_rows()>0) {
      foreach ($query->result_array() as $hasil) {
        $response = array(
          'id_cuti' => $hasil['id_cuti'],
          'id_pegawai' => $hasil['id_pegawai'],
          'tanggal_pengajuan' => $hasil['tanggal_pengajuan'],
          'tanggal_selesai' => $hasil['tanggal_selesai'],
          'tanggal_mulai' => $hasil['tanggal_mulai'],
          'jenis_cuti' => $hasil['jenis_cuti'],
          'keterangan' => $hasil['keterangan'],
          'approve' => $hasil['approve'],
        );
      }
    }
    echo json_encode($response);
  }

  function hapusCuti()
  {
    $id = $this->input->post('id_cuti');
    $where = array('id_cuti' => $id, );
    $this->mCuti->deleteDetailCuti($where);
    
    $response['msg'] = 'Cuti Dihapus';
    $response['data'] = $this->mCuti->delete($where);
    $response['status'] = 'success';

    echo json_encode($response);
  }

  function updateCuti()
  {
    $id = $this->input->post('id_cuti');
    $id_pegawai = $this->input->post('id_pegawai');
    $tgl_pengajuan = $this->input->post('tgl_pengajuan');
    $tgl_mulai     = $this->input->post('tgl_mulai');
    $tgl_selesai   = $this->input->post('tgl_selesai');

	// merubah format tanggal 
    $start = $this->hitunghari->tglindo($tgl_mulai);
    $end   = $this->hitunghari->tglindo($tgl_selesai);
    $jumlah_hari   = $this->hitunghari->hitungHariKerja($start, $end,"-");

    $keterangan    = $this->input->post('keterangan');
    $approve   = $this->input->post('approve');

    // membungkus data update dari variable
    $data = array(
      'tanggal_mulai' => $tgl_mulai,
      'tanggal_selesai' => $tgl_selesai,
      'jumlah_hari' => $jumlah_hari,
      'keterangan' => $keterangan,
    );

    // ceking jika tanggal awal -> sampai yang di edit sudah pernah diajukan cuti
    $cekTglMulai = $this->validasidetail->cekTanggalMulai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);
	$cekTglSelesai = $this->validasidetail->cekTanggalSelesai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);
	if ($cekTglMulai == 1) {
		$response['status'] = 'error';
		$response['msg'] = 'Update Gagal, sudah pernah cuti di awal tanggal ini';
	} elseif($cekTglSelesai == 1){
		$response['status'] = 'error';
		$response['msg'] = 'Update gagal, sudah pernah cuti di tanggal selesai ini';
	} else {

	      // validasi jika status cuti sudah di approve
	    // if ($approve == 1) {
	      // jika menghapus detailCuti terlebih dahulu
	      // $whereCuti = array('id_cuti' => $id, );
	      // $this->mCuti->deleteDetailCuti($whereCuti);

	      // kemudian mengupdate detail Cuti
	      // for($i = $awal; $i <= $akhir; $i->modify('+1 day')){
	      //     $rangeTanggal = $i->format("Y-m-d");
	      //     $this->mCuti->insertDetailCuti($id,$tgl_pengajuan,$rangeTanggal);
	      // }
	    $response['data'] = $this->mCuti->update($id,$data);
    	$response['msg'] = 'Cuti diubah';
    	$response['status'] = 'success';
    }

    echo json_encode($response);
  }

  function statusApproval()
  {
    // mendefenisikan variable
    $id = $this->input->post('id_cuti');
    $approve = $this->input->post('approve');
    $approve_by = $this->session->userdata('username');

    // mendapatkan detail data cuti
    $whereCuti = array('id_cuti' => $id, );
    $dataCuti = $this->mCuti->getWhere($whereCuti);

    // menampilkan data detail cuti
    foreach ($dataCuti->result_array() as $row) {
      $pegawai = $row['id_pegawai'];
      $pengajuan = $row['tanggal_pengajuan'];
      $awal = $row['tanggal_mulai'];
      $akhir = $row['tanggal_selesai'];
    }

    // status data approval
    $data = array(
      'id_cuti' => $id,
      'approve' => $approve, // jika 1 = approve, 0 = pending, 2 = ditolak
      'approve_by' => $approve_by,
    );

	    if ($approve == 1) {
	    	$cekTglMulai = $this->validasidetail->cekTanggalMulai('cuti',$pegawai,$awal,$akhir);
		    $cekTglSelesai = $this->validasidetail->cekTanggalSelesai('cuti',$pegawai,$awal,$akhir);
			if ($cekTglMulai == 1) {
				$response['status'] = 'error';
		      	$response['msg'] = 'Approval gagal, sudah pernah cuti di awal tanggal ini';
			} elseif($cekTglSelesai == 1){
			 	$response['status'] = 'error';
		      	$response['msg'] = 'Approval gagal, sudah pernah cuti di tanggal selesai ini';
			} else {
				// mengupdate status approval cuti
	    		$response['data'] = $this->mCuti->update($id,$data);
			    // jika di approve maka range tanggal akan dimasukan ke tabel detailCuti
			    $this->validasidetail->insertDetailCuti($pegawai,$id,$pengajuan,$awal,$akhir);
			    $response['status'] = 'success';
			    $response['msg'] = 'Cuti Disetujui';
			  }

	    } elseif ($approve == 2) {
	    	// mengupdate status approval cuti
	       $response['data'] = $this->mCuti->update($id,$data);
	       $response['status'] = 'error';
	       $response['msg'] = 'Cuti Ditolak';
	    } else {
	       // mengupdate status approval cuti
	       $response['data'] = $this->mCuti->update($id,$data);
	       // jika Dipending detailCuti akan dihapus
	       $this->mCuti->deleteDetailCuti($whereCuti);
	       $response['status'] = 'success';
	       $response['msg'] = 'Cuti Dipending';
	    }

    echo json_encode($response);

  }

  function insert()
  {
    $id_pegawai    = $this->input->post('id_pegawai');
    $tgl_pengajuan = date('Y-m-d');
    $tgl_mulai     = $this->input->post('tgl_mulai');
    $tgl_selesai   = $this->input->post('tgl_selesai');

	// merubah format tanggal 
    $start = $this->hitunghari->tglindo($tgl_mulai);
    $end   = $this->hitunghari->tglindo($tgl_selesai);
    $jumlah_hari   = $this->hitunghari->hitungHariKerja($start, $end,"-");

    $jenis_cuti    = $this->input->post('jenis_cuti');
    $keterangan    = $this->input->post('keterangan');
    $approve       = 0;
    $approve_by    = $this->session->userdata('username');

    if ($id_pegawai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'pegawai tidak boleh Kosong';
    } elseif ($tgl_mulai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'Tanggal mulai tidak boleh Kosong';
    } elseif ($tgl_selesai == "") {
      $response['status'] = 'error';
      $response['msg'] = 'Tanggal Selesai tidak boleh Kosong';
    } elseif ($jenis_cuti == "") {
      $response['status'] = 'error';
      $response['msg'] = 'Jenis Cuti tidak boleh Kosong';
    }
     elseif ($keterangan == "") {
      $response['status'] = 'error';
      $response['msg'] = 'keterangan tidak boleh Kosong';
    } else {

		    $cekTglMulai = $this->validasidetail->cekTanggalMulai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);
		    $cekTglSelesai = $this->validasidetail->cekTanggalSelesai('cuti',$id_pegawai,$tgl_mulai,$tgl_selesai);
		    if ($cekTglMulai == 1) {
		    	$response['status'] = 'error';
      			$response['msg'] = 'sudah cuti di awal tanggal ini';
		    } elseif($cekTglSelesai == 1){
		    	$response['status'] = 'error';
      			$response['msg'] = 'sudah cuti di tanggal selesai ini';
		    } else {

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
	          $response['msg']    = 'Pegawai dibuatkan cuti';
          }
    }
    echo json_encode($response);
  }

  function uploadFiles()
  {
          $id_pegawai    = $this->input->post('upload_id');
          // config upload
          $config['upload_path']="./assets/files";
          $config['allowed_types']='pdf|jpg|png';
          $config['encrypt_name'] = TRUE;
          $this->load->library('upload',$config);
          // -------------------------------------
          if( ! $this->upload->do_upload("file")){
            $response = $this->upload->display_errors();
          } else {
            $dofile = array('upload_data' => $this->upload->data());
            $file = $dofile['upload_data']['file_name'];

            $data = array('file' => $file, );

            $this->mCuti->update($id_pegawai,$data); // melakuakn insert ke database
            $response = 'Dokumen ditambahkan';
          }
          echo json_encode($response);
  }

  function download($data){
    force_download('assets/files/'.$data,NULL);
  }
}
