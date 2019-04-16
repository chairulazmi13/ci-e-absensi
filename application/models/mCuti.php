<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mCuti extends CI_Model {
 
  function getAll(){
    $this->db->select('id_pegawai,nip,nama,kota,alamat,id_cuti,tanggal_pengajuan,tanggal_mulai,tanggal_selesai,jumlah_hari,jenis_cuti,keterangan,approve,approve_by,file');
    $this->db->from('cuti');
    $this->db->join('pegawai', 'pegawai.id = cuti.id_pegawai','left'); // Join tabel pegawai
    $query = $this->db->get();
    return $query;
  }

  function getWhere($where){
    $this->db->select('id_pegawai,nip,nama,kota,alamat,id_cuti,tanggal_pengajuan,tanggal_mulai,tanggal_selesai,jumlah_hari,jenis_cuti,keterangan,approve,approve_by,file');
    $this->db->from('cuti');
    $this->db->join('pegawai', 'pegawai.id = cuti.id_pegawai','left'); // Join tabel pegawai
    $this->db->where($where);
    $query = $this->db->get();
    return $query;
  }

  function insert($data)
  {
    $query = $this->db->insert('cuti',$data);
    return $query;
  }

  function delete($where)
	{
		$query = $this->db->delete('cuti',$where);
		return $query;
	}

  function update($id,$data)
  {
    $this->db->where('id_cuti',$id);
    $this->db->update('cuti',$data);
  }


  // ----------------DETAIL CUTI-------------------
  function getDetailCuti($tanggal_cuti)
  {
  	# code...
  }

  function insertDetailCuti($d,$a,$b,$c)
  {
    $data = array(
      'id_pegawai'=> $d,
      'id_cuti' => $a,
      'tanggal_pengajuan' => $b,
      'tanggal_cuti' => $c,
    );
    $query = $this->db->insert('detailCuti',$data);
    return $query;
  }

  function whereDetailCuti($pegawai,$tanggal)
  {
    // $tanggal_cuti = date($tanggal);
  	$this->db->where('id_pegawai',$pegawai);
  	$this->db->where('tanggal_cuti',$tanggal);
    $query = $this->db->get('detailCuti');
    return $query;
  }

  function deleteDetailCuti($where)
  {
    $query = $this->db->delete('detailCuti',$where);
	  return $query;
  }

  function countPendingCuti()
  { 
    $this->db->select('*');
    $this->db->from('cuti');
    $this->db->where('approve', 0);
    return $this->db->count_all_results();
  }

  // ---------------- HALAMAN PEGAWAI ----------------- //
  function getEvent($id,$start,$end)
  {
    $query = $this->db->query('SELECT*FROM cuti WHERE id_pegawai = '.$id.' AND approve = 2 AND tanggal_mulai >= "'.$start.'" AND tanggal_selesai <= "'.$end.'"');
    $data[] = 'Event Cuti';

    foreach ($query->result_array() as $hasil) {
        $data[] = array(
            'id' => $hasil['id_cuti'],
            'title' => 'Cuti :'.$hasil['keterangan'],
            'start' => $hasil['tanggal_mulai'],
            'end'   => $hasil['tanggal_selesai'],
            'color' => 'orange'
          );
    }

    return $data;
  }
  // -------------- END HALAMAN PEGAWAI ---------------- //
}
