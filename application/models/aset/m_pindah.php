<?php
class M_pindah extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_aset_master';
    //get instance
    $this->CI = get_instance();
  }
	
	function updateAset($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function get_Aset($nama)
	{
		$this->db->select('no_aset,nama');
        $this->db->like('nama', $nama);
        $query = $this->db->get('tbl_aset_master');
		
        return $query->result();
	}
	
	function get_AsetRuangan($nama_ruangan)
	{
		$this->db->select('tbl_aset_ruangan.deskripsi as nama_ruangan,
		tbl_aset_bangunan.deskripsi as nama_bangunan');
		$this->db->join('tbl_aset_bangunan','tbl_aset_bangunan.id_aset_bangunan = tbl_aset_ruangan.id_aset_bangunan'); 
        $this->db->like('tbl_aset_ruangan.deskripsi', $nama_ruangan);
        $query = $this->db->get('tbl_aset_ruangan');
		
        return $query->result();
	}
	
	function getIdAsetByNoAset($no_aset)
	{
		$this->db->select('id_aset_master');
		$this->db->where('no_aset', $no_aset);
		$this->db->limit(1);
		$q = $this->db->get('tbl_aset_master');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_aset_master'];	
		return  $result;	
	}
	
	function getIdRuanganByNamaRuangan($nama_ruangan)
	{
		$this->db->select('id_aset_ruangan');
		$this->db->where('deskripsi', $nama_ruangan);
		$this->db->limit(1);
		$q = $this->db->get('tbl_aset_ruangan');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_aset_ruangan'];	
		return  $result;	
	}
}

?>