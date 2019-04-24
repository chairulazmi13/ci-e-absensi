<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('Login'));
  	}
	  	$this->load->model('Mpegawai');
	    $this->load->model('Mabsensi');
	    $this->load->model('Mcuti');
	    $this->load->model('Mdinas');
	    $this->load->model('Mlog');
  	}

	public function index()
	{
		$data['widget_absenmasuk'] = $this->Mabsensi->countAbsenMasuk();
		$data['widget_absenpulang'] = $this->Mabsensi->countAbsenPulang();
		$data['widget_cuti'] = $this->Mcuti->countPendingCuti();
		$data['widget_dinas'] = $this->Mdinas->countDinasToday();
		$this->load->view('template/header');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('template/footer');
	}

	function widgetLog()
	{
		$no = 1;
		$data = $this->Mlog->getLog();

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
