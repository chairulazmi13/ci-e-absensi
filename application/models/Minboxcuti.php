<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mInboxCuti extends CI_Model {

  var $table = 'cuti';
  var $column_order = array('id_cuti','tanggal_pengajuan','keterangan','tanggal_mulai','tanggal_selesai','Jenis_cuti','approve','file'); //set column field database for datatable orderable
  var $column_search = array('id_cuti','tanggal_pengajuan','keterangan','tanggal_mulai','tanggal_selesai','Jenis_cuti','approve','file'); //set column field database for datatable searchable 
  var $order = array('id_cuti' => 'asc'); // default order 

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Datatables server side
  private function _get_datatables_query($id_pegawai)
  {   
        $this->db->from($this->table);
        $this->db->where('id_pegawai',$id_pegawai);
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {     
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
  }

  function get_datatables($id_pegawai)
  {
    $this->_get_datatables_query($id_pegawai);
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered($id_pegawai)
  {
    $this->_get_datatables_query($id_pegawai);
    $query = $this->db->get();
    return $query->num_rows();
  }
 
  public function count_all($id_pegawai)
  {
    $this->db->from($this->table);
    $this->db->where('id_pegawai',$id_pegawai);
    return $this->db->count_all_results();
  }
  // End Datatables server side

}
