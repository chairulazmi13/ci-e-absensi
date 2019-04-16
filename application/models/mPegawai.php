<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mPegawai extends CI_Model {

	function getAll(){
		$this->db->select('id,aktif_pegawai,nip,nama,kota,alamat,ip_address,last_activity,nama_divisi,nama_jabatan');
		$this->db->from('pegawai');
		$this->db->join('divisi', 'divisi.id_divisi = pegawai.id_divisi','left'); // Join tabel divisi
		$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan','left'); // join tabel jabatan
		$this->db->where('aktif_pegawai',1);
		$query = $this->db->get();
		return $query;
	}

	function getByWhere($where){
		$this->db->select('id,nip,aktif_pegawai,nama,kota,alamat,ip_address,password_pegawai,last_activity,nama_divisi,nama_jabatan');
		$this->db->from('pegawai');
		$this->db->join('divisi', 'divisi.id_divisi = pegawai.id_divisi','left'); // Join tabel divisi
		$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan','left'); // join tabel jabatan
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	function insert($data)
	{
		$query = $this->db->insert('pegawai',$data);
		return $query;
	}

	function generateQR($id,$qr)
	{
		date_default_timezone_set("Asia/Bangkok");
		$data = array(
			'qr_code' => $qr,
			'last_activity' => date("Y-m-d H:i:s"),
		);
		$this->db->where('id',$id);
	    $this->db->update('pegawai',$data);
	}

	function delete($where)
	{
		$query = $this->db->delete('pegawai',$where);
		return $query;
	}

	function update($id,$data)
	{
	    $this->db->where('id',$id);
	    return $this->db->update('pegawai',$data);
	}

	function getDetailByID($id)
	{
		$this->db->select('id,nip,nama,kota,alamat,ip_address,last_activity,pegawai.id_divisi as id_div,nama_divisi,pegawai.id_jabatan as id_jab ,nama_jabatan');
		$this->db->from('pegawai');
		$this->db->join('divisi', 'divisi.id_divisi = pegawai.id_divisi','left'); // Join tabel divisi
		$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan','left'); // join tabel jabatan
		$this->db->where($id);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			foreach ($query->result_array() as $hasil) {
				$data = array(
					'id'   => $hasil['id'],
					'nip'   => $hasil['nip'],
					'nama'   => $hasil['nama'],
					'alamat'   => $hasil['alamat'],
					'kota'   => $hasil['kota'],
					'id_div'   => $hasil['id_div'],
					'id_jab'   => $hasil['id_jab'],
					'nama_divisi'   => $hasil['nama_divisi'],
					'nama_jabatan'   => $hasil['nama_jabatan'],
					'ip_address'   => $hasil['ip_address'],
					'last_activity'   => $hasil['last_activity'],
				);
			}
		}
		return $data;
	}

	function getByID($id)
	{
		$query = $this->db->get_where('pegawai',$id);
		return $query;
	}

	function getLike($id)
	{
		$this->db->like($id);
		$this->db->select('id,nip,nama,kota,alamat,ip_address,last_activity,pegawai.id_divisi as id_div,nama_divisi,pegawai.id_jabatan id_jab ,nama_jabatan');
		$this->db->from('pegawai');
		$this->db->join('divisi', 'divisi.id_divisi = pegawai.id_divisi','left'); // Join tabel divisi
		$this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan','left'); // join tabel jabatan
		$query = $this->db->get();
		return $query;
	}
}
