<?php
class M_bangunan extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_aset_bangunan';
	$this->load->library('Excel_generator');
    //get instance
    $this->CI = get_instance();
  }
	public function getBangunanFlexigrid()
    {
        //Build contents query
        $this->db->select('
		tbl_aset_bangunan.*,
		tbl_aset_tanah.no_sertifikat as no_sertifikat,		
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset,
		')->from($this->_table);
		$this->db->join('tbl_aset_tanah','tbl_aset_tanah.id_aset_tanah = tbl_aset_bangunan.id_aset_tanah'); 		
		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_bangunan.id_kepemilikan_aset'); 
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_aset_bangunan) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    


	function insertBangunan($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteBangunan($id)
	{
		$this->db->where('id_aset_bangunan', $id);
		$this->db->delete($this->_table);
	}

	function updateBangunan($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getBangunanByIdBangunan($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_aset_bangunan' => $id))->row();
	}
	
	function get_AsetTanah($deskripsi)
	{
		$this->db->select('no_sertifikat,deskripsi');
        $this->db->like('deskripsi', $deskripsi);
        $query = $this->db->get('tbl_aset_tanah');
		
        return $query->result();
	}
	
	function getTanahByIdTanah($id_aset_tanah) 
	{	
		return $this->db->get_where('tbl_aset_tanah',array('id_aset_tanah' => $id_aset_tanah))->row();
	}
	
	function getIdTanahByNoSertifikat($no_sertifikat)
	{
		$this->db->select('id_aset_tanah');
		$this->db->where('no_sertifikat', $no_sertifikat);
		$q = $this->db->get('tbl_aset_tanah');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_aset_tanah'];	
		return  $result;	
	}
	
	function cekFIleExist($no_imb)
	{	
		return $this->db->get_where($this->_table,array('no_imb' => $no_imb))->row();
	}
	
	function getNoImbExist($no_imb)
	{
		$this->db->select('no_imb');
		$this->db->where('no_imb', $no_imb);
		$q = $this->db->get($this->_table);
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['no_imb'];	
		if($result == NULL)
		{	
			return FALSE;
		}
		else return TRUE;
	}
	function cekLokasiNull($id)
	{
		$this->db->select('lokasi');
		$this->db->where('id_aset_bangunan', $id);
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
		 $this->db->select('
		tbl_aset_bangunan.*,
		tbl_aset_tanah.no_sertifikat as no_sertifikat,		
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset,
		')->from($this->_table);
		$this->db->select("DATE_FORMAT(tbl_aset_bangunan.tgl_bangun, '%d/%m/%Y') AS tgl_bangun", FALSE);
		$this->db->join('tbl_aset_tanah','tbl_aset_tanah.id_aset_tanah = tbl_aset_bangunan.id_aset_tanah'); 		
		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_bangunan.id_kepemilikan_aset');	
		
		
		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}

}

?>