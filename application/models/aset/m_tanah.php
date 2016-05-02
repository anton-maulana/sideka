<?php
class M_tanah extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_aset_tanah';
	$this->load->library('Excel_generator');
    //get instance
    $this->CI = get_instance();
  }
	public function getTanahFlexigrid()
    {
        //Build contents query
        $this->db->select('tbl_aset_tanah.*,		
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset
		')->from($this->_table);		
		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_tanah.id_kepemilikan_aset'); 
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_aset_tanah) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    


	function insertTanah($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteTanah($id)
	{
		$this->db->where('id_aset_tanah', $id);
		$this->db->delete($this->_table);
	}

	function updateTanah($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getTanahByIdTanah($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_aset_tanah' => $id))->row();
	}
	function cekLokasiNull($id)
	{
		$this->db->select('lokasi');
		$this->db->where('id_aset_tanah', $id);
		$this->db->limit(1);
		$q = $this->db->get($this->_table);
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['lokasi'];	
		if(!empty( $data['lokasi']))
		{
			return false;
		}
		else if(empty( $data['lokasi']))
		{
			return  true;	
		}	
	}
	
	function getExportExcel()
	{
		 $this->db->select('tbl_aset_tanah.*,		
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset
		')->from($this->_table);	
		
		//$this->db->select("DATE_FORMAT(tbl_penduduk.tanggal_lahir, '%d/%m/%Y') AS tanggal_lahir", FALSE);

		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_tanah.id_kepemilikan_aset'); 
		//$this->db->group_by('tbl_penduduk.nik');
		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}
}

?>