<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_portal extends CI_Model {

  function __construct()
	  {
		parent::__construct();
		$this->_table='ref_desa';
		
		//get instance
		$this->CI = get_instance();
	  }
    
	function get_desa()
	{
		$this->db->select('nama_desa');
		$this->db->where('id_desa', 1);
		$q = $this->db->get('ref_desa');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['nama_desa'];
		if ($result == NULL)
		{
			return 'tidak ditemukan';
		}
		else
		{			
			return  $result;
		}
	}
	function getDataPekerjaan(){
        $this->db->select('ref_pekerjaan.deskripsi');				
		$this->db->from('tbl_penduduk');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = tbl_penduduk.id_pekerjaan','left');
		$this->db->group_by("ref_pekerjaan.deskripsi");
		$query = $this->db->get();
		return $query->result();
    }	
	function getDataPekerja(){
        $this->db->select('ref_pekerjaan.deskripsi ,count(tbl_penduduk.id_pekerjaan) ');				
		$this->db->from('tbl_penduduk');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = tbl_penduduk.id_pekerjaan','left');
		$this->db->group_by("ref_pekerjaan.deskripsi");
		$query = $this->db->get();
		return $query->result();
    }
	function getBuruhMigran(){
        $this->db->select('count(tbl_penduduk.id_pekerjaan)');				
		$this->db->from('tbl_penduduk');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = tbl_penduduk.id_pekerjaan','left');
		$this->db->group_by("ref_pekerjaan.deskripsi");
		$query = $this->db->get();
		return $query->result();
    }
}