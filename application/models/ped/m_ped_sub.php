<?php
class M_ped_sub extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_ped_sub';
    //get instance
    $this->CI = get_instance();
  }
	public function getPedSubFlexigrid()
    {
        //Build contents query
        $this->db->select('
		ref_ped_sub.*,
		ref_ped_kategori.deskripsi as lahan
		')->from($this->_table);
		
		$this->db->join('ref_ped_kategori','ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori'); 
		 
	
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_ped_sub) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    


	function insertPedSub($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deletePedSub($id)
	{
		$this->db->where('id_ped_sub', $id);
		$this->db->delete($this->_table);
	}

	function updatePedSub($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getPedSubByIdPedSub($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_ped_sub' => $id))->row();
	}
	
	function get_ped_kategori() 
	{      
		$records = $this->db->get('ref_ped_kategori');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_ped_kategori] = $row->deskripsi;
		}
		return ($data);
	}	
	
	function get_satuan() 
	{      
		$data=array();
		
		$data[''] = '--Pilih--';
		$data['Ha'] = 'Ha';
		$data['m2'] = 'm2';
		
		return ($data);
	}
	
	
}

?>