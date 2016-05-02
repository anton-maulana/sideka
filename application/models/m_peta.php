<?php
class M_peta extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_peta';
	
    //get instance
    $this->CI = get_instance();
  }
  
  
	public function getPeta()
    {
        //Build contents query
       	$this->db->select('embed');
		$this->db->where('id_peta', 1);
		$q = $this->db->get($this->_table);
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['embed'];	
		if($result == NULL OR $result == "")
		{	
			$default = '{"zoom":"7","center":"-3.921332, 106.309123","type":"ROADMAP"}';
			return json_decode($default);
		}
		//else return json_decode($result);
		else 
			return json_decode($result);
			
    }
	
	public function getBatasWilayah()
    {
        //Build contents query
       	$this->db->select('lokasi');
		$this->db->where('id_peta', 1);
		$q = $this->db->get($this->_table);
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['lokasi'];	
		if($result == NULL OR $result == "")
		{	
			$default = '';
			return $default;
		}
		//else return json_decode($result);
		else 
			return $result;
			
    }
	
	function getLegendBatasWilayah()
	{		
		//Build contents query
       	$this->db->select('luas_wilayah');
		$this->db->where('id_desa', 1);
		$q = $this->db->get('ref_desa');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['luas_wilayah'];	
		if($result == NULL OR $result == "")
		{	
			$default = '';
			return $default;
		}
		//else return json_decode($result);
		else 
			return $result;
	}
	
	function updatePeta($where, $data){
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
		
	function getKoordinatTanah()
	{		
		$this->db->select('lokasi');
		$this->db->where('lokasi !=', 'null');
		$this->db->where('lokasi !=', '');
        $query = $this->db->get('tbl_aset_tanah');		
        return $query->result();
	}
	
	function getLegendTanah()
	{		
		$this->db->select('FORMAT(SUM(luas),2) as total_luas',FALSE);
		$this->db->where('lokasi !=', 'null');
		$this->db->where('lokasi !=', '');
        $query = $this->db->get('tbl_aset_tanah');		
        return $query->result();
	}
	
	function getKoordinatBangunan()
	{		
		$this->db->select('lokasi');
		$this->db->where('lokasi !=', 'null');
		$this->db->where('lokasi !=', '');
        $query = $this->db->get('tbl_aset_bangunan');		
        return $query->result();
	}
	
	function getLegendBangunan()
	{		
		$this->db->select('FORMAT(SUM(luas),2) as total_luas',FALSE);
		$this->db->where('lokasi !=', 'null');
		$this->db->where('lokasi !=', '');
        $query = $this->db->get('tbl_aset_bangunan');		
        return $query->result();
	}
	
	function getKoordinatPotensi()
	{		
		$this->db->select('tbl_ped.lokasi');
		$this->db->where('tbl_ped.lokasi !=', 'null');
		$this->db->where('tbl_ped.lokasi !=', '');
        $query = $this->db->get('tbl_ped');		
        return $query->result();
	}
	
	function getLegendPotensi()
	{		
		$this->db->select('tbl_ped.lokasi,ref_ped_sub.warna_peta,ref_ped_sub.satuan,ref_ped_sub.deskripsi as jenis_potensi,
		FORMAT(SUM(tbl_ped.luas),2) as total_luas',FALSE);
		$this->db->join('ref_ped_sub','ref_ped_sub.id_ped_sub = tbl_ped.id_ped_sub'); 
		$this->db->where('tbl_ped.lokasi !=', 'null');
		$this->db->where('tbl_ped.lokasi !=', '');
		$this->db->group_by('ref_ped_sub.id_ped_sub');
        $query = $this->db->get('tbl_ped');		
        return $query->result();
	}
    
}
?>