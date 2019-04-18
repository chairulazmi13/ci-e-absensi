<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mAbsensi extends CI_Model {

	function getByWhere($id)
	{
		$this->db->select('id_absensi,id_pegawai,nip,nama,tanggal,mulai_masuk,jam_masuk,telat,jam_pulang,masuk,keterangan');
		$this->db->from('absensi');
		$this->db->join('pegawai', 'pegawai.id = absensi.id_pegawai','left'); // Join tabel pegawai
		$this->db->where($id);
		$query = $this->db->get();
		return $query->result();
	}

	function insert($data)
	{
		$query = $this->db->insert('absensi',$data);
		return $query;
	}

	function update($where,$data){
    	$this->db->where($where);
    	$this->db->update('absensi',$data);
  	}

  	function getByID($id)
	{
		$query = $this->db->get_where('absensi',$id);
		return $query;
	}

	function countAbsenMasuk()
	{
		$this->db->select('*');
		$this->db->from('absensi');
		$this->db->where('jam_masuk !=', NULL);
		$this->db->where('tanggal', date('Y-m-d'));
		return $this->db->count_all_results();
	}

	function countAbsenPulang()
	{
		$this->db->select('*');
		$this->db->from('absensi');
		$this->db->where('jam_pulang !=', NULL);
		$this->db->where('tanggal', date('Y-m-d'));
		return $this->db->count_all_results();
	}

	// ---------------- HALAMAN PEGAWAI ----------------- //
	function indexKehadiran($bulan,$harikerja,$id_pegawai)
	{
		$query = $this->db->query('SELECT pg.id, pg.nip, pg.nama,
		 IFNULL(hd.hadir,0) as masuk,
		 IFNULL(ct.jumlah_cuti,0) as jumlah_cuti,
		 IFNULL(dn.jumlah_dinas,0) as jumlah_dinas,
		 SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) AS kehadiran,
		 '.$harikerja.' as harikerja,
		 '.$harikerja.' - SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) AS absen,
		 ROUND(SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) / '.$harikerja.',2) AS presentase
		 FROM pegawai as pg

		 LEFT JOIN (
			SELECT id_absensi,id_pegawai, COUNT(absensi.masuk) AS hadir
			FROM absensi
			WHERE id_pegawai = '.$id_pegawai.'
			AND MONTH(tanggal) = '.$bulan.'
			GROUP  BY id_pegawai
		 ) AS hd ON hd.id_pegawai = pg.id

		 LEFT JOIN (
			SELECT id_cuti,id_pegawai,SUM(jumlah_hari) AS jumlah_cuti
			FROM cuti
			WHERE id_pegawai = '.$id_pegawai.'
			AND MONTH(tanggal_mulai) = '.$bulan.'
			AND MONTH(tanggal_selesai) = '.$bulan.'
			AND approve = 1
			GROUP  BY id_pegawai
		 ) AS ct ON ct.id_pegawai = pg.id

		 LEFT JOIN (
			SELECT id_dinas,id_pegawai,SUM(jumlah_hari) AS jumlah_dinas
			FROM dinas
			WHERE id_pegawai = '.$id_pegawai.'
			AND MONTH(tanggal_mulai) = '.$bulan.'
			AND MONTH(tanggal_selesai) = '.$bulan.'
			GROUP  BY id_pegawai
		 ) AS dn ON dn.id_pegawai = pg.id

		 WHERE pg.id = '.$id_pegawai.'

		 GROUP BY pg.id
		 ORDER BY pg.nama ASC');
		return $query;
	}

	function getEvent($id,$start,$end)
	{
		$query = $this->db->query('SELECT*FROM absensi WHERE id_pegawai = '.$id.' AND tanggal BETWEEN "'.$start.'"AND"'.$end.'"');
		$data[] = 'Event Absensi';
		foreach ($query->result_array() as $hasil) {
	      $data[] = array(
	      	  'id' => $hasil['id_absensi'],
	          'title' => $hasil['keterangan'],
	          'start' => $hasil['tanggal'],
	          'end'   => $hasil['tanggal'],
	          'color' => 'green'
	        );
	    }
		return $data;
	}
	// -------------- END HALAMAN PEGAWAI ---------------- //

	// ------------ REPORT --------------------- //
	function reportAbsensi($tahun,$bulan)
	 {
	 	$query = $this->db->query('
						SELECT
						nip,
						nama,
						YEAR(tanggal) AS tahun,
						MONTH(tanggal) AS bulan,
						GROUP_CONCAT(DAY(jam_masuk) ORDER BY tanggal ASC SEPARATOR ",") AS tanggal_masuk,
						GROUP_CONCAT(DAY(jam_pulang) ORDER BY tanggal ASC SEPARATOR ",") AS tanggal_pulang,
						GROUP_CONCAT(TIME(jam_masuk) ORDER BY tanggal ASC SEPARATOR ",") AS masuk,
						GROUP_CONCAT(TIME(jam_pulang) ORDER BY tanggal ASC SEPARATOR ",") AS pulang,
						COUNT(absensi.jam_masuk) AS jmlh_masuk,
						COUNT(absensi.jam_pulang) AS jmlh_pulang,
						SUM(absensi.telat) AS terlambat

						FROM absensi
						LEFT JOIN pegawai ON pegawai.id = absensi.id_pegawai

						WHERE YEAR(tanggal) = '.$tahun.' AND MONTH(tanggal) = '.$bulan.'

						GROUP BY DATE_FORMAT(tanggal,"%Y%m"),nip
						ORDER BY nama ASC');
	 	return $query;
	 }

	 function reportSummaryAbsensi($startgl,$endtgl,$harikerja)
	 {
	 	$query = $this->db->query('SELECT pg.id, pg.nip, pg.nama,
			IFNULL(hd.hadir,0) as masuk,
			IFNULL(ct.jumlah_cuti,0) as jumlah_cuti,
			IFNULL(dn.jumlah_dinas,0) as jumlah_dinas,
			SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) AS kehadiran,
			'.$harikerja.' as harikerja,
			'.$harikerja.' - SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) AS absen,
			ROUND(SUM(IFNULL(hd.hadir,0)+IFNULL(ct.jumlah_cuti,0)+IFNULL(dn.jumlah_dinas,0)) / '.$harikerja.',2) AS presentase
			FROM pegawai as pg

			LEFT JOIN (
			 SELECT id_absensi,id_pegawai, COUNT(absensi.masuk) AS hadir
			 FROM absensi
			 WHERE tanggal BETWEEN "'.$startgl.'" AND "'.$endtgl.'"
			 GROUP  BY id_pegawai
			) AS hd ON hd.id_pegawai = pg.id

			LEFT JOIN (
			 SELECT id_cuti,id_pegawai,SUM(jumlah_hari) AS jumlah_cuti
			 FROM cuti
			 WHERE tanggal_mulai BETWEEN "'.$startgl.'" AND "'.$endtgl.'"
			 AND tanggal_selesai BETWEEN "'.$startgl.'" AND "'.$endtgl.'"
			 AND approve = 1
			 GROUP  BY id_pegawai
			) AS ct ON ct.id_pegawai = pg.id

			LEFT JOIN (
			 SELECT id_dinas,id_pegawai,SUM(jumlah_hari) AS jumlah_dinas
			 FROM dinas
			 WHERE tanggal_mulai BETWEEN "'.$startgl.'" AND "'.$endtgl.'"
			 AND tanggal_selesai BETWEEN "'.$startgl.'" AND "'.$endtgl.'"
			 GROUP  BY id_pegawai
			) AS dn ON dn.id_pegawai = pg.id

			GROUP BY pg.id
			ORDER BY pg.nama ASC');
	 		return $query;
		 }

}
