<?php
class M_ruangan extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_aset_ruangan';
	$this->load->library('Excel_generator');
    //get instance
    $this->CI = get_instance();
  }
	public function getRuanganFlexigrid()
    {
        //Build contents query
        $this->db->select('
		tbl_aset_ruangan.*,
		tbl_aset_bangunan.no_imb as no_imb,
		tbl_aset_bangunan.deskripsi as nama_bangunan
		')->from($this->_table);
		$this->db->join('tbl_aset_bangunan','tbl_aset_bangunan.id_aset_bangunan = tbl_aset_ruangan.id_aset_bangunan'); 
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_aset_ruangan) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    


	function insertRuangan($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteRuangan($id)
	{
		$this->db->where('id_aset_ruangan', $id);
		$this->db->delete($this->_table);
	}

	function updateRuangan($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getRuanganByIdRuangan($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_aset_ruangan' => $id))->row();
	}
	
	function get_AsetRuangan($no_imb)
	{
		$this->db->select('no_imb,deskripsi');
        $this->db->like('no_imb', $no_imb);
        $query = $this->db->get('tbl_aset_bangunan');
		
        return $query->result();
	}
	
	function getBangunanByIdBangunan($id_aset_bangunan) 
	{	
		return $this->db->get_where('tbl_aset_bangunan',array('id_aset_bangunan' => $id_aset_bangunan))->row();
	}
	
	function getIdBangunanByNoImb($no_imb)
	{
		$this->db->select('id_aset_bangunan');
		$this->db->where('no_imb', $no_imb);
		$q = $this->db->get('tbl_aset_bangunan');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_aset_bangunan'];	
		return  $result;	
	}

	function getExportExcel()
	{
		 $this->db->select('
		tbl_aset_ruangan.*,
		tbl_aset_bangunan.no_imb as no_imb,
		tbl_aset_bangunan.deskripsi as nama_bangunan
		')->from($this->_table);
		$this->db->join('tbl_aset_bangunan','tbl_aset_bangunan.id_aset_bangunan = tbl_aset_ruangan.id_aset_bangunan');
		
		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}

}

?>