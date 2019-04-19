<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mDinas extends CI_Model {

  function createIdDinas()
  {
      $this->db->select('RIGHT(dinas.id_dinas,4) as kode', FALSE);
      $this->db->order_by('id_dinas','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('dinas');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
      $kodejadi = "DNL-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
      return $kodejadi;  
  }

  function getAll()
  {
    $this->db->select('id_pegawai,nip,nama,kota,alamat,id_dinas,tanggal_pengajuan,tanggal_mulai,tanggal_selesai,jumlah_hari,keterangan,tempat,file');
    $this->db->from('dinas');
    $this->db->join('pegawai', 'pegawai.id = dinas.id_pegawai','left'); // Join tabel pegawai
    $query = $this->db->get();
    return $query;
  }

  function getWhere($where)
  {
    $this->db->select('id_pegawai,nip,nama,kota,alamat,id_dinas,tanggal_pengajuan,tanggal_mulai,tanggal_selesai,jumlah_hari,keterangan,tempat,file');
    $this->db->from('dinas');
    $this->db->join('pegawai', 'pegawai.id = dinas.id_pegawai','left'); // Join tabel pegawai
    $this->db->where($where);
    $query = $this->db->get();
    return $query;
  }

  function insert($data)
  {
    $query = $this->db->insert('dinas',$data);
    return $query;
  }

  function delete($where)
	{
		$query = $this->db->delete('dinas',$where);
		return $query;
	}

  function update($id,$data)
  {
    $this->db->where('id_dinas',$id);
    $this->db->update('dinas',$data);
  }

  // ----------------DETAIL DINAS-------------------
  function insertDetailDinas($d,$a,$b,$c)
  {
    $data = array(
      'id_dinas' => $a,
      'id_pegawai' => $d,
      'tanggal_pengajuan' => $b,
      'tanggal_dinas' => $c,
    );
    $query = $this->db->insert('detaildinas',$data);
    return $query;
  }

  function whereDetailDinas($pegawai,$tanggal)
  {
    // $tanggal_cuti = date($tanggal);
    $this->db->where('id_pegawai',$pegawai);
    $this->db->where('tanggal_dinas',$tanggal);
    $query = $this->db->get('detaildinas');
    return $query;
  }

  function deleteDetailDinas($where)
  {
    $query = $this->db->delete('detaildinas',$where);
    return $query;
  }

  function countDinasToday()
  { 
    $this->db->select('*');
    $this->db->from('detaildinas');
    $this->db->where('tanggal_dinas',date('Y-m-d'));
    return $this->db->count_all_results();
  }

  // ---------------- HALAMAN PEGAWAI ----------------- //
  function getEvent($id,$start,$end)
  {
    $query = $this->db->query('SELECT*FROM dinas WHERE id_pegawai = '.$id.' AND tanggal_mulai >= "'.$start.'" AND tanggal_selesai <= "'.$end.'"');
    $data[] = 'Event Dinas';

    foreach ($query->result_array() as $hasil) {
        $data[] = array(
            'id' => $hasil['id_dinas'],
            'title' => 'Dinas :'.$hasil['keterangan'],
            'start' => $hasil['tanggal_mulai']."T00:00:00",
            'end'   => $hasil['tanggal_selesai']."T23:59:00",
            'allDay' => false,
            'color' => 'aqua'
          );
    }

    return $data;
  }
  // -------------- END HALAMAN PEGAWAI ---------------- //
}
