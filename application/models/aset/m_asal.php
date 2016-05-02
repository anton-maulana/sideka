<?php
class M_asal extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_asal_aset';
    //get instance
    $this->CI = get_instance();
  }
	public function getAsalFlexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_asal_aset) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    
	function insertAsal($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteAsal($id)
	{
		$this->db->where('id_asal_aset', $id);
		$this->db->delete($this->_table);
	}

	function updateAsal($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getAsalByIdAsal($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_asal_aset' => $id))->row();
	}
}

?>