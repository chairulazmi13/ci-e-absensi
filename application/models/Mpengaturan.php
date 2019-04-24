<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mPengaturan extends CI_Model {

	function getPengaturan()
	{
		$query = $this->db->get('pengaturan');
		return $query;
	}

	function getPengaturanWhere($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('pengaturan');
		return $query;
	}

	function updatePengaturan($id,$data)
	 {
	   $this->db->where('id',$id);
	   $this->db->update('pengaturan', $data);
	 }

}