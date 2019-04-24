<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	function cekUsername($where)
	{
		return $this->db->get_where('user',$where);
	}

	function getByWhere($where){
		$this->db->select('id_user,username,password,id_level,aktif,pegawai.id as id_pegawai,nip,nama,alamat');
		$this->db->from('user');
	    $this->db->join('pegawai','pegawai.id=user.id_pegawai');
		$this->db->where($where);
		return $this->db->get();
	}

	function getAll(){
		$this->db->select('user.id_user as user_id,username,user.id_level as user_level,nama_level,aktif,pegawai.id as id_pegawai,nip,nama,alamat');
		$this->db->from('user');
	    $this->db->join('pegawai','pegawai.id=user.id_pegawai');
	    $this->db->join('level','level.id_level=user.id_level');
		return $this->db->get();
	}

	function insert($data)
	{
		$query = $this->db->insert('user',$data);
		return $query;
	}

	function delete($where)
	{
		$query = $this->db->delete('user',$where);
		return $query;
	}

	function update($id,$data)
	{
    $this->db->where('id_user',$id);
    $this->db->update('user',$data);
  }

}
