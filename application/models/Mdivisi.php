<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mDivisi extends CI_Model {

	function getAll(){
		$query = $this->db->get('divisi');
		return $query;
	}

	function getByID($id)
	{
		$query = $this->db->get_where('divisi',$id);
		if ($query->num_rows()>0) {
			foreach ($query->result_array() as $hasil) {
				$data = array(
					'id_divisi' => $hasil['id_divisi'],
					'nama_divisi' => $hasil['nama_divisi'],
					'keterangan' => $hasil['keterangan'],
				);
			}
		}
		return $data;
	}

	function insert($data)
	{
		$query = $this->db->insert('divisi',$data);
		return $query;
	}

	function update($id_divisi,$data){
    	$this->db->where('id_divisi',$id_divisi);
    	$this->db->update('divisi',$data);
  	}

	function delete($where)
	{
		$query = $this->db->delete('divisi',$where);
		return $query;
	}

	function countPegawai($id)
	{
		$this->db->where('id_divisi', $id);
		$this->db->from('pegawai');
		return $this->db->count_all_results();
	}

}
