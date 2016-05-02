<?php
class M_lpj extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//$this->_table='tbl_rp_rabdes';
		$this->_table='tbl_rp_lpj';
		//get instance
		$this->CI = get_instance();
		$this->load->library('subquery');
	}
	
	public function get_lpj_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'
		tbl_rp_lpj.id_lpj,
		tbl_rp_lpj.id_spp,
		tbl_rp_lpj.penerima,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_lpj.tgl_entry
		'
		)->from($this->_table);
		$this->db->join('tbl_rp_spp','tbl_rp_spp.id_spp = tbl_rp_lpj.id_spp', 'left');
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_lpj.id_lpj) as record_count")->from($this->_table);        
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	function insertLpj($data)
	{
		$this->db->insert($this->_table, $data);
	} 
	
	function getLpjByIdLpj($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_lpj' => $id))->row();
	}
	
	function updateLpj($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	

	function deleteLpj($id)
	{
		$this->db->where('id_lpj', $id);
		$this->db->delete($this->_table);
	}
	
	function get_spp() 
	{
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
		$this->db->where('tbl_rp_spp.id_spp !=','0');
		$this->db->order_by('tbl_rp_spp.id_spp','desc');
		$records = $this->db->get('tbl_rp_spp');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_spp] = $row->kegiatan;
		}
		return ($data);
	}
	
	function getIdSpp_ByIdLpj($id_lpj)
	{
		$this->db->select('id_spp');
		$this->db->where('id_lpj',$id_lpj);
		$q = $this->db->get('tbl_rp_lpj');
		$data = array_shift($q->result_array());
		return ($data['id_spp']);
	}
	
	public function getLpj_ByIdSpp($id_spp)
    {
		$this->db->select(
		'
		tbl_rp_lpj.id_lpj,
		tbl_rp_lpj.id_spp,
		tbl_rp_lpj.penerima,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_spp.total
		'
		);
		$this->db->join('tbl_rp_spp','tbl_rp_spp.id_spp = tbl_rp_lpj.id_spp', 'left');
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
		
		$this->db->where('tbl_rp_lpj.id_spp',$id_spp);
		$data=array();
		$query=$this->db->get('tbl_rp_lpj');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function getRowLpj_ByIdLpj($id)
	{
		$this->db->select('*');
		$this->db->where('id_lpj',$id);
		$query = $this->db->get('tbl_rp_lpj');
		return $query->row();
	}
	
	
}
?>
