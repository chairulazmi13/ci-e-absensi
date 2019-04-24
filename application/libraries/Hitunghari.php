<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Hitunghari
{
	private $CI = null; 
    function __construct()
    {
        $this->CI =& get_instance();
    }

  	// mengubah format tanggal
	public function tglindo($tgl){
		   // merubah dari yyyy-mm-dd menjadi dd-mm-yyyy
		   $p = explode('-', $tgl);
		   return $p[2].'-'.$p[1].'-'.$p[0];
	}

	public function hitungHariKerja($tglawal,$tglakhir,$delimiter) {
	//    menetapkan parameter awal dan libur nasional
	//    pada prakteknya data libur nasional bisa diambil dari database
	 
		$this->CI->load->model('Mlibur');
		$harilibur = $this->CI->Mlibur->getAll();
		foreach ($harilibur->result_array() as $row) {
			$liburnasional[] = $this->tglindo($row['tanggal_libur']);
			// $liburnasional = array("01-05-2014","15-05-2014","27-05-2014","29-05-2014","11-03-2019");
		}
	 
	    $tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;
	    
	//    memecah tanggal untuk mendapatkan hari, bulan dan tahun
	    $pecah_tglawal = explode($delimiter, $tglawal);
	    $pecah_tglakhir = explode($delimiter, $tglakhir);
	    
	//    mengubah Gregorian date menjadi Julian Day Count
	    $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
	    $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);
	 
	//    mengubah ke unix timestamp
	    $jmldetik = 24*3600;
	    $a = strtotime($tglawal);
	    $b = strtotime($tglakhir);
	    
	//    menghitung jumlah libur nasional 
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        foreach ($liburnasional as $key => $tgllibur) {
	            if($tgllibur==date("d-m-Y",$i)){
	                $libur++;
	            }
	        }
	    }
	    
	//    menghitung jumlah hari minggu
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        if(date("w",$i)=="0"){
	            $minggu++;
	        }
	    }
	    
	//    menghitung jumlah hari sabtu
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        if(date("w",$i)=="6"){
	            $sabtu++;
	        }
	    }
	 
	//    dijalankan jika $tglakhir adalah hari sabtu atau minggu
	    if(date("w",$b)=="0" || date("w",$b)=="6"){
	        $koreksi = 1;
	    }
	    
	//    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
	    $jumlahhari =  $tgl_akhir - $tgl_awal - $libur - $minggu - $sabtu - $koreksi + 1;
	    return $jumlahhari;
	}
	
}