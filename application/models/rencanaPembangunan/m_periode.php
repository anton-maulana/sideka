<?php
class M_periode extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_rp_periode';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_periode_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->db->where('id_periode !=', 0);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_periode) as record_count")->from($this->_table);        
        $this->db->where('id_periode !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertperiode($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteperiode($id)
  {
    $this->db->where('id_periode', $id);
    $this->db->delete($this->_table);
  }
  
  function getperiodeByIdperiode($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_periode' => $id))->row();
  }
  
  function updateperiode($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('deskripsi' => $deskripsi))->row();
	}
	

		
	function get_year() 
	{      
		$data = array();
		$base_year = date("Y");
		$min_year = $base_year - 5;
		$max_year = $base_year + 10;

		for( $i = $min_year; $i <= $max_year; $i++) // or $i+=1;
		{   
			$data[''] = '--Pilih--';
			$data[$i] = $i;
		}

		return ($data);
	}
}
?>