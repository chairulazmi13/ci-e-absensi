<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporanabsensi extends CI_Controller {
	function __construct(){
  	parent::__construct();

  	if($this->session->userdata('login') == 0){
  		redirect(base_url('Login'));
  	}

	  	$this->load->model('Mpegawai');
	    $this->load->model('Mabsensi');
	    $this->load->model('Mcuti');
	    $this->load->model('Mdinas');
	    $this->load->library('hitunghari');
  	}

	public function laporan_absensi()
	{
		$this->load->view('template/header');
	    $this->load->view('admin/report/laporanAbsensi');
	    $this->load->view('template/footer');
  	}

  	public function laporan_summary_absensi()
	{
		$this->load->view('template/header');
	    $this->load->view('admin/report/laporanSummaryAbsensi');
	    $this->load->view('template/footer');
  	}

  	function summaryAbsensi()
  	{
  		$startTgl = date($this->input->post('startTgl'));
  		$endTgl = date($this->input->post('endTgl'));

  		$start = $this->hitunghari->tglindo($startTgl);
    	$end   = $this->hitunghari->tglindo($endTgl);
  		$harikerja = $this->hitunghari->hitungHariKerja($start,$end,"-");
  		$no = 1;

  		$data = $this->Mabsensi->reportSummaryAbsensi($startTgl,$endTgl,$harikerja);

  		echo '<table class="table table-stripped" style="width:100%">';
  		echo '<tr class="bg-orange"><th colspan="10">Dari : '.$startTgl.'  Sampai : '.$endTgl.'</th></tr>
  		<tr class="bg-green">
  		<th>NO</th>
  		<th>NIP</th>
  		<th>Nama Pegawai</th>
  		<th>Masuk</th>
  		<th>Jumlah Cuti</th>
  		<th>Jumlah Dinas</th>
  		<th>Kehadiran</th>
  		<th>Hari Kerja</th>
  		<th>Absen</th>
  		<th>Presentase</th>
  		</tr>';

  		foreach ($data->result_array() as $key) {
  			echo '<tr>';
  			echo '<td>'.$no++.'</td>';
  			echo '<td>'.$key['nip'].'</td>';
  			echo '<td>'.$key['nama'].'</td>';
  			echo '<td>'.$key['masuk'].'</td>';
  			echo '<td>'.$key['jumlah_cuti'].'</td>';
  			echo '<td>'.$key['jumlah_dinas'].'</td>';
  			echo '<td>'.$key['kehadiran'].'</td>';
  			echo '<td>'.$key['harikerja'].'</td>';
  			echo '<td>'.$key['absen'].'</td>';
  			echo '<td>'.$key['presentase'].'</td>';
  			echo '</tr>';
  		}

  		echo '</table>';
  		echo '<script type="text/javascript">$("table").tableExport({
    		formats: ["xlsx","xls"],
    		bootstrap: true,
    		position: "top",
    		filename: "Laporan_Sumary_Absensi",
    		sheetname: "Laporan_Sumary_Absensi"
    	});</script>';
  	}

 	function report()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$maxdate = date('t', strtotime($tahun.'-'.$bulan.'-1'));

		echo '<table class="table table-stripped" style="width:100%">';
        echo '<tr class="bg-green"><th rowspan="2">NIP</th><th rowspan="2">Nama</th><th rowspan="2">Status</th><th colspan="'.$maxdate.'">Tanggal</th></tr>';
        echo '<tr>';
		$no = 0;
		for($i=1;$i<$maxdate;$i++) {
		  $date = strtotime($tahun.'-'.$bulan.'-'.$i);
		  echo date('w',$date)<>0 ? '<th class="bg-yellow">' . date('d',$date) . '</th>':'';
		}
		echo '<th class="bg-orange">Jumlah</th></tr>';

		$sql = $this->Mabsensi->reportAbsensi($tahun,$bulan);
		foreach ($sql->result_array() as $row) {
			$masuk  = array_combine( explode(',',$row['tanggal_masuk']) , explode(',', $row['masuk']) );
			$pulang = array_combine( explode(',',$row['tanggal_pulang']) , explode(',', $row['pulang']) );

			echo '<tr><td rowspan="2">'.$row['nip'].'</td><td rowspan="2">'.$row['nama'].'</td><td>Masuk</td>';

			for($i=1;$i<$maxdate;$i++) {
				$date = strtotime($tahun.'-'.$bulan.'-'.$i);
			    echo date('w',$date)<>0?'<td>' . ( isset($masuk[$i]) ? $masuk[$i] : '' ) . '</td>':'';
			  }
			echo '<td>'.$row["jmlh_masuk"].'</td>';
	        echo '</tr><tr><td>Pulang</td>';
	        for($i=1;$i<$maxdate;$i++) {
	        	$date = strtotime($tahun.'-'.$bulan.'-'.$i);
			    echo date('w',$date)<>0?'<td>' . ( isset($pulang[$i]) ? $pulang[$i] : '' ) . '</td>':'';
			  }
			echo '<td>'.$row["jmlh_pulang"].'</td>';
    	}
    	echo '</tr></table>';
    	echo '<script type="text/javascript">$("table").tableExport({
    		formats: ["xlsx","xls"],
    		bootstrap: true,
    		position: "top",
    		filename: "Laporan_Absensi_0'.$bulan.'_'.$tahun.'",
    		sheetname: "Laporan_Absensi_0'.$bulan.'_'.$tahun.'"
    	});</script>';
	}

  function loopingDate()
  {
        date_default_timezone_set('Asia/Jakarta');// Set timezone
        //variabel ini bisa kita isi dengan tanggal statis misalnya, ‘2017-05-01"
        $dari = '2019-02-01';// tanggal mulai
        $sampai = '2019-02-28';// tanggal akhir

        $start_date = new DateTime($dari);
        $end_date = new DateTime($sampai);
        $interval = $start_date->diff($end_date);
        $jmlh = $interval->days+1; // hasil : 217 hari

        echo '<table style="width:100%" border="1">';
        echo '<tr><th rowspan="2">No</th><th rowspan="2">Nama</th><th rowspan="2">Status</th><th colspan="'.$jmlh.'">Tanggal</th></tr>';
        echo '<tr>';
        while (strtotime($dari) <= strtotime($sampai)) {
        $tgl = $dari;
        $tanggal = substr($tgl,8);
        echo '<th>'.$tanggal.'</th>';
        $dari = date ("Y-m-d", strtotime("+1 day", strtotime($dari)));//looping tambah 1 date
        }
        echo '</tr>';
        echo '<tr><td rowspan="4">1</td><td rowspan="4">AA</td><td>Masuk</td></tr>';
        echo '<tr><td>Pulang</td></tr>';
        echo '<tr><td>Cuti</td></tr>';
        echo '<tr><td>DL</td></tr>';
        echo '</table>';
  }
}
