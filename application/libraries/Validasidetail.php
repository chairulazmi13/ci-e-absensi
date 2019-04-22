<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Validasidetail
{
	private $CI = null; 
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('mDinas');
        $this->CI->load->model('mCuti');
    }

    public function insertDetailDinas($id_pegawai,$id_dinas,$tgl_pengajuan,$tgl_mulai,$tgl_selesai)
    {
    	  // menentukan tanggal awal dan akhir dinas
          $begin = new DateTime($tgl_mulai);
          $end   = new DateTime($tgl_selesai);
          // Menambhkan detail Dinas
          for($i = $begin; $i <= $end; $i->modify('+1 day')){
              $rangeTanggal = $i->format("Y-m-d");
              $this->CI->mDinas->insertDetailDinas($id_pegawai,$id_dinas,$tgl_pengajuan,$rangeTanggal);
          }
    }

    public function deleteDetailDinas($id)
    {
    	// jika menghapus detailDinas terlebih dahulu
	    $whereDinas = array('id_dinas' => $id, );
	    $this->CI->mDinas->deleteDetailDinas($whereDinas);
    }

    public function insertDetailCuti($id_pegawai,$id_cuti,$tgl_pengajuan,$tgl_mulai,$tgl_selesai)
    {
 		$begin = new DateTime($tgl_mulai);
        $end   = new DateTime($tgl_selesai);

    	for($i = $begin; $i <= $end; $i->modify('+1 day')){
			$rangeTanggal = $i->format("Y-m-d");
			$this->CI->mCuti->insertDetailCuti($id_pegawai,$id_cuti,$tgl_pengajuan,$rangeTanggal);
		}
    }

    public function deleteDetailCuti($id)
    {
    	// jika menghapus detailDinas terlebih dahulu
	    $whereCuti = array('id_cuti' => $id, );
	    $this->CI->mCuti>deleteDetailCuti($whereCuti);
    }

    public function cekTanggalMulai($status,$pegawai,$start,$end)
	{		
			if ($status == 'cuti') {
				$id_pegawai = $pegawai;
				$tgl_mulai = date($start);
				$tgl_selesai = date($end);

			    $cekTglMulai   = $this->CI->mCuti->whereDetailCuti($id_pegawai,$tgl_mulai);
			    if ($cekTglMulai->num_rows() > 0 ) {
	      			return $response = 1;
			    }

			} elseif ($status == 'dinas') {
				$id_pegawai = $pegawai;
				$tgl_mulai = date($start);
				$tgl_selesai = date($end);

			    $cekTglMulai   = $this->CI->mCuti->whereDetailDinas($id_pegawai,$tgl_mulai);
			    if ($cekTglMulai->num_rows() > 0 ) {
	      			return $response = 1;
			    }
			}

	}

	public function cekTanggalSelesai($status,$pegawai,$start,$end)
	{		
		if ($status == 'cuti') {
			$id_pegawai = $pegawai;
			$tgl_mulai = date($start);
			$tgl_selesai = date($end);

		    $cekTglSelesai = $this->CI->mCuti->whereDetailCuti($id_pegawai,$tgl_selesai);
		    if ($cekTglSelesai->num_rows() > 0) {
      			return $response = 1;
		    }
		} elseif ($status == 'dinas') {
			$id_pegawai = $pegawai;
			$tgl_mulai = date($start);
			$tgl_selesai = date($end);

		    $cekTglSelesai = $this->CI->mCuti->whereDetailDinas($id_pegawai,$tgl_selesai);
		    if ($cekTglSelesai->num_rows() > 0) {
      			return $response = 1;
		    }
		}
	}
}