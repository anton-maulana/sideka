<?php
class M_sso extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_sso';
	
    //get instance
    $this->CI = get_instance();
  }
	  
  function getSso($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_sso' => $id))->row();
  }
  function updateSso($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
}
?>