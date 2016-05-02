<?php
class M_jurnal_warga extends CI_Model {

  function __construct(){
		parent::__construct();
		$this->_table='tbl_berita';
	
		//get instance
		$this->CI = get_instance();
	}
	public function get_berita_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_berita) as record_count")->from($this->_table);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	function insertJurnalWarga($data){
		$this->db->insert($this->_table, $data);
	}
	
}
?>