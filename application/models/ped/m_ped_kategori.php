<?php
class M_ped_kategori extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_ped_kategori';
    //get instance
    $this->CI = get_instance();
  }
	public function getPedKategoriFlexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
			
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_ped_kategori) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    


	function insertPedKategori($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deletePedKategori($id)
	{
		$this->db->where('id_ped_kategori', $id);
		$this->db->delete($this->_table);
	}

	function updatePedKategori($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}	
	  
	function getPedKategoriByIdPedKategori($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_ped_kategori' => $id))->row();
	}
	
	
}

?>