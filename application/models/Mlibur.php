<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlibur extends CI_Model {
	function getAll()
	{
		$query = $this->db->get('harilibur');
    	return $query;
	}

	function insert($data)
	{
	    $query = $this->db->insert('harilibur',$data);
	    return $query;
	}


	function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('harilibur',$data);
	}

  	function delete($id)
	{
		$where = array('id' => $id, );
		$query = $this->db->delete('harilibur',$where);
		return $query;
	}

	function getByID($id)
	{
		$where = array('id' => $id);
		$query = $this->db->get_where('harilibur',$where);
		foreach ($query->result_array() as $hasil) {
	      $data = array(
	          'id' => $hasil['id'],
	          'tanggal_libur' => $hasil['tanggal_libur'],
	          'keterangan' => $hasil['keterangan'], 
	        );
	    }
		return $data;
	}

	function getEvent()
	{
		$query = $this->db->get('harilibur');
		foreach ($query->result_array() as $hasil) {
	      $data[] = array(
	      	  'id' => $hasil['id'],
	          'title' => $hasil['keterangan'],
	          'start' => $hasil['tanggal_libur'],
	          'end' => $hasil['tanggal_libur'],
	          'color' => 'red'
	        );
	    }
		return $data;
	}

}