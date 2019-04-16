<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('login'));
  	}
	  	$this->load->model('mPegawai');
	    $this->load->model('mAbsensi');
	    $this->load->model('mCuti');
	    $this->load->model('mDinas');
	    $this->load->model('mLog');
  	}

	public function index()
	{
		$data['widget_absenmasuk'] = $this->mAbsensi->countAbsenMasuk();
		$data['widget_absenpulang'] = $this->mAbsensi->countAbsenPulang();
		$data['widget_cuti'] = $this->mCuti->countPendingCuti();
		$data['widget_dinas'] = $this->mDinas->countDinasToday();
		$this->load->view('template/header');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('template/footer');
	}

	function widgetLog()
	{
		$no = 1;
		$data = $this->mLog->getLog();

		echo '<table class="table table-condensed">';
        echo '<thead><tr>';
        echo '<th style="width: 10px">#</th>';
        echo '<th>Pegawai</th>';
        echo '<th>Waktu</th>';
        echo '<th>keterangan</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

		if ($data->result() < 0) {
			echo '<tr><td class colspan="5"></td>Data Kosong</tr>';
		} else {
			foreach ($data->result_array() as $key) {
				echo '<tr>';
				echo '<td>'.$no++.'</td>';
				echo '<td>'.$key['nama'].'</td>';
				echo '<td>'.$key['time'].'</td>';
				echo '<td>'.$key['keterangan'].'</td>';
				echo '</tr>';
			}
		}
		echo '<tbody></table>';
	}
}
