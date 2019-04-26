<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget
{
	private $CI = null; 
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Mlog');
    }

    function LogActivity()
    {
    	$no = 1;
		$data = $this->CI->Mlog->getLog();

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