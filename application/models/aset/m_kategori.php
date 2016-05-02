<?php
class M_kategori extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_kategori_aset';
    //get instance
    $this->CI = get_instance();
  }
	public function getKategoriFlexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_kategori_aset) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    
	function insertKategori($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteKategori($id)
	{
		$this->db->where('id_kategori_aset', $id);
		$this->db->delete($this->_table);
	}

	function updateKategori($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getKategoriByIdKategori($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_kategori_aset' => $id))->row();
	}
}

?>