<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Loadpengaturan
{
	private $CI = null; 
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Mpengaturan');
    }

    public function getPengaturan($load)
    {
    	$data = $this->CI->Mpengaturan->getPengaturan();
    	foreach ($data->result_array() as $key) {
    		if ($load == 'nama_perusahaan') {
    			$hasil = $key['nama_perusahaan'];
    		} elseif ($load == 'alamat') {
    			$hasil = $key['alamat'];
    		} elseif ($load == 'mulai_absensi') {
    			$hasil = $key['mulai_absensi'];
    		} elseif ($load == 'mulai_masuk') {
    			$hasil = $key['mulai_masuk'];
    		} elseif ($load == 'mulai_pulang') {
    			$hasil = $key['mulai_pulang'];
    		} elseif ($load == 'timeout_qr_code') {
    			$hasil = $key['timeout_qr_code'];
    		}
    	}

    	return $hasil;
    }
}