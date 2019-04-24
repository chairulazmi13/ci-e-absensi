<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlog extends CI_Model {

function getLog()
{
	$query = $this->db->query('select * from log_activity order by id_log DESC limit 10');
	return $query;
}

function insert($data)
 {
   $query = $this->db->insert('log_activity',$data);
   return $query;
 }

}