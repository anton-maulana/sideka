<?php
class M_aset extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_aset_master';
	$this->load->library('Excel_generator');
    //get instance
    $this->CI = get_instance();
  }
	public function getAsetFlexigrid()
    {
        //Build contents query
        $this->db->select('
		tbl_aset_master.*,
		tbl_aset_ruangan.deskripsi as nama_ruangan,
		ref_kategori_aset.deskripsi as kategori_aset,
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset,
		ref_asal_aset.deskripsi as asal_aset
		')->from($this->_table);
		$this->db->join('tbl_aset_ruangan','tbl_aset_ruangan.id_aset_ruangan = tbl_aset_master.id_aset_ruangan'); 
		$this->db->join('ref_kategori_aset','ref_kategori_aset.id_kategori_aset = tbl_aset_master.id_kategori_aset'); 
		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_master.id_kepemilikan_aset'); 
		$this->db->join('ref_asal_aset','ref_asal_aset.id_asal_aset = tbl_aset_master.id_asal_aset'); 
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_aset_master) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
    
	function SetNoAset()
	{
		$sqlstr = "UPDATE tbl_aset_master SET no_aset=CONCAT('AST',id_aset_ruangan, LAST_INSERT_ID()) WHERE no_aset IS NULL";		
		$query = $this->db->query($sqlstr);
	}

	function insertAset($data)
	{
		$this->db->insert($this->_table, $data);
		//$this->SetNoAset(); Trigger BEFORE INSERT on this table
	}

	function deleteAset($id)
	{
		$this->db->where('id_aset_master', $id);
		$this->db->delete($this->_table);
	}

	function updateAset($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function getAsetByIdAset($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_aset_master' => $id))->row();
	}
	
	function get_AsetRuangan($nama_ruangan)
	{
		$this->db->select('tbl_aset_ruangan.deskripsi as nama_ruangan,
		tbl_aset_bangunan.deskripsi as nama_bangunan');
		$this->db->join('tbl_aset_bangunan','tbl_aset_bangunan.id_aset_bangunan = tbl_aset_ruangan.id_aset_bangunan'); 
        $this->db->like('tbl_aset_ruangan.deskripsi', $nama_ruangan);
        $query = $this->db->get('tbl_aset_ruangan');
		
        return $query->result();
	}
	
	function getRuanganAndBangunanByIdRuangan($id_aset_ruangan) 
	{	
		$this->db->select('
		tbl_aset_ruangan.deskripsi as nama_ruangan,
		tbl_aset_bangunan.deskripsi as nama_bangunan
		')->from('tbl_aset_ruangan');
		$this->db->join('tbl_aset_bangunan','tbl_aset_bangunan.id_aset_bangunan = tbl_aset_ruangan.id_aset_bangunan'); 
		$this->db->where('tbl_aset_ruangan.id_aset_ruangan', $id_aset_ruangan);
		
        return $this->db->get()->row();
	}
	
	function getIdRuanganByNamaRuangan($nama_ruangan)
	{
		$this->db->select('id_aset_ruangan');
		$this->db->where('deskripsi', $nama_ruangan);
		$q = $this->db->get('tbl_aset_ruangan');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_aset_ruangan'];	
		return  $result;	
	}

	function getKategoriAset()
	{
		$records = $this->db->get('ref_kategori_aset');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_kategori_aset] = $row->deskripsi;
        }
        return ($data);
	}
	function getKepemilikanAset()
	{
		$records = $this->db->get('ref_kepemilikan_aset');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_kepemilikan_aset] = $row->deskripsi;
        }
        return ($data);
	}
	function getAsalAset()
	{
		$records = $this->db->get('ref_asal_aset');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_asal_aset] = $row->deskripsi;
        }
        return ($data);
	}
	function getDeskripsiKepemilikan($id)
	{
		$this->db->select('deskripsi');
		$this->db->where('id_kepemilikan_aset', $id);
		$this->db->limit(1);
		$q = $this->db->get('ref_kepemilikan_aset');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['deskripsi'];	
		return  $result;	
	}
	
	function getExportExcel()
	{
		 $this->db->select('
		tbl_aset_master.*,
		tbl_aset_ruangan.deskripsi as nama_ruangan,
		ref_kategori_aset.deskripsi as kategori_aset,
		ref_kepemilikan_aset.deskripsi as kepemilikan_aset,
		ref_asal_aset.deskripsi as asal_aset
		')->from($this->_table);
		$this->db->join('tbl_aset_ruangan','tbl_aset_ruangan.id_aset_ruangan = tbl_aset_master.id_aset_ruangan'); 
		$this->db->join('ref_kategori_aset','ref_kategori_aset.id_kategori_aset = tbl_aset_master.id_kategori_aset'); 
		$this->db->join('ref_kepemilikan_aset','ref_kepemilikan_aset.id_kepemilikan_aset = tbl_aset_master.id_kepemilikan_aset'); 
		$this->db->join('ref_asal_aset','ref_asal_aset.id_asal_aset = tbl_aset_master.id_asal_aset'); 
		$this->db->order_by('id_aset_master', 'asc');
		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}
	
}

?>