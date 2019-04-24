<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjabatan extends CI_Model {

	function getAll(){
		$query = $this->db->query('SELECT*FROM jabatan ORDER BY id_jabatan ASC');
		return $query;
	}

	function getByID($id)
	{
		$query = $this->db->get_where('jabatan',$id);
		if ($query->num_rows()>0) {
			foreach ($query->result_array() as $hasil) {
				$data = array(
					'id_jabatan'   => $hasil['id_jabatan'],
					'nama_jabatan' => $hasil['nama_jabatan'],
					'keterangan'   => $hasil['keterangan'],
					'create_date'  => $hasil['create_date'],
					'update_date'  => $hasil['update_date'],
				);
			}
		}
		return $data;
	}

	function insert($data)
	{
		$query = $this->db->insert('jabatan',$data);
		return $query;
	}

	function update($id_divisi,$data)
	{
    	$this->db->where('id_jabatan',$id_divisi);
    	$this->db->update('jabatan',$data);
  }

	function delete($where)
	{
		$query = $this->db->delete('jabatan',$where);
		return $query;
	}

	function countPegawai($id)
	{
		$this->db->where('id_jabatan', $id);
		$this->db->from('pegawai');
		return $this->db->count_all_results();
	}

}
