<?php
class M_rpjmdes extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_rp_rpjmdes';
    $this->_tableDetailRpjmdes='tbl_rp_rpjmdes_detail';
    $this->_tableTahun='tbl_rp_tahun_anggaran';
    //get instance
    $this->CI = get_instance();
  }
	public function get_rpjmdes_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'tbl_rp_rpjmdes.id_rpjmdes,
		tbl_rp_rpjmd.program as program_rpjmd,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		tbl_rp_rpjmdes.indikator,
		tbl_rp_rpjmdes.kondisi_awal,
		tbl_rp_rpjmdes.target,
		tbl_rp_rpjmdes.capaian,
		tbl_rp_rpjmdes.id_parent_rpjmdes,
		tbl_rp_rpjmdes.id_top_rpjmdes,
		tbl_rp_rpjmdes.id_periode,
		tbl_rp_rpjmdes.id_bidang,
		ref_rp_periode.periode_awal,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi as deskripsi_bidang
		',false
		)->from($this->_table);
        //$this->db->where('tbl_rp_rpjmdes.id_rpjmdes !=', 0);
		//$this->db->join('tbl_rp_rpjmdes as a1','a1.id_parent_rpjmdes = tbl_rp_rpjmdes.id_rpjmdes', 'left');
		$this->db->join('tbl_rp_rpjmd','tbl_rp_rpjmd.id_rpjmd = tbl_rp_rpjmdes.id_rpjmd', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
        $this->db->order_by('tbl_rp_rpjmdes.id_parent_rpjmdes ', null);
		$this->db->group_by('tbl_rp_rpjmdes.id_rpjmdes ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rpjmdes.id_rpjmdes) as record_count")->from($this->_table);    
		$this->db->join('tbl_rp_rpjmd','tbl_rp_rpjmd.id_rpjmd = tbl_rp_rpjmdes.id_rpjmd', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');		
        $this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
        $this->db->order_by('tbl_rp_rpjmdes.id_parent_rpjmdes ', null);
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function get_rpjmdes_flexigrid_byIdRpjmdes($id)
    {
        //Build contents query
       $this->db->select(
		'tbl_rp_rpjmdes.id_rpjmdes,
		tbl_rp_rpjmd.program as program_rpjmd,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		tbl_rp_rpjmdes.indikator,
		tbl_rp_rpjmdes.kondisi_awal,
		tbl_rp_rpjmdes.target,
		tbl_rp_rpjmdes.capaian,
		tbl_rp_rpjmdes.id_parent_rpjmdes,
		tbl_rp_rpjmdes.id_top_rpjmdes,
		tbl_rp_rpjmdes.id_periode,
		tbl_rp_rpjmdes.id_bidang,
		ref_rp_periode.periode_awal,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi as deskripsi_bidang
		',false
		)->from($this->_table);
        $this->db->where('tbl_rp_rpjmdes.id_rpjmdes', $id);
        $this->db->or_where('tbl_rp_rpjmdes.id_top_rpjmdes', $id);
        //$this->db->where('tbl_rp_rpjmdes.id_rpjmdes !=', 0);
		$this->db->join('tbl_rp_rpjmd','tbl_rp_rpjmd.id_rpjmd = tbl_rp_rpjmdes.id_rpjmd', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
        //$this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_rpjmdes) as record_count")->from($this->_table);   
		$this->db->join('tbl_rp_rpjmd','tbl_rp_rpjmd.id_rpjmd = tbl_rp_rpjmdes.id_rpjmd', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_rpjmdes', $id);
		$this->db->or_where('tbl_rp_rpjmdes.id_top_rpjmdes', $id);
        $this->db->where('tbl_rp_rpjmdes.id_rpjmdes !=', 0);
		
		//$this->db->where('id_parent_rpjmdes ', null);
		//$this->db->order_by('tbl_rp_rpjmdes.id_parent_rpjmdes ', null);
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	
	public function get_detail_rpjmdes_flexigrid($id)
    {
        //Build contents query
        $this->db->select(
		'tbl_rp_rpjmdes_detail.id_rpjmdes_detail,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		tbl_rp_rpjmdes_detail.volume,
		tbl_rp_rpjmdes_detail.satuan,
		tbl_rp_rpjmdes_detail.nominal,
		tbl_rp_rpjmdes_detail.lokasi,
		tbl_rp_rpjmdes_detail.tanggal,
		tbl_rp_rpjmdes_detail.id_rpjmdes,
		tbl_rp_rpjmdes_detail.id_tahun_anggaran,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		',false
		)->from($this->_tableDetailRpjmdes);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmdes_detail.id_tahun_anggaran', 'left');
		$this->db->where('tbl_rp_rpjmdes_detail.id_rpjmdes', $id);
        //$this->db->order_by('tbl_rp_rpjmdes_detail.id_rpjmdes_detail ', null);
		//$this->db->group_by('tbl_rp_rpjmdes_detail.id_rpjmdes_detail ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rpjmdes_detail.id_rpjmdes_detail) as record_count")->from($this->_tableDetailRpjmdes);        
        $this->db->where('tbl_rp_rpjmdes_detail.id_rpjmdes', $id);
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertRpjmdes($data)
  {
    $this->db->insert($this->_table, $data);
  } 
  
  function insertDetailRpjmdes($data)
  {
    $this->db->insert($this->_tableDetailRpjmdes, $data);
  }
  
  function deleteRpjmdes($id)
  {
    $this->db->where('id_rpjmdes', $id);
    $this->db->delete($this->_table);
  }
  
  function deleteDetailRpjmdes($id)
  {
    $this->db->where('id_rpjmdes_detail', $id);
    $this->db->delete($this->_tableDetailRpjmdes);
  }
  
  function getRpjmdesByIdRpjmdes($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_rpjmdes' => $id))->row();
  }
  
  function getDetailRpjmdesByIdDetailRpjmdes($id) //edit
  {	
    return $this->db->get_where($this->_tableDetailRpjmdes,array('id_rpjmdes_detail' => $id))->row();
  }
  
  function updateRpjmdes($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
  function updateDetailRpjmdes($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_tableDetailRpjmdes, $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($program)
	{	
		return $this->db->get_where($this->_table,array('program' => $program))->row();
	}
	
	function cekFIleExistDetail($id_tahun_anggaran)
	{	
		return $this->db->get_where($this->_tableDetailRpjmdes,array('id_tahun_anggaran' => $id_tahun_anggaran))->row();
	}
	
	function getRowRpjmdes_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('*');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$query = $this->db->get('tbl_rp_rpjmdes');
		return $query->row();
	}
	
	function getRowBidang_ByIdBidang($id_bidang)
	{
		$this->db->select('*');
		$this->db->where('id_bidang',$id_bidang);
		$query = $this->db->get('ref_rp_bidang');
		return $query->row();
	}
	
	function getResult_RpjmdesByIdRpjmdes($id)
	{
		$this->db->select('
		tbl_rp_rpjmdes.id_rpjmdes,
		tbl_rp_rpjmdes.program,
		tbl_rp_rpjmdes.kondisi_awal,
		tbl_rp_rpjmdes.target,
		tbl_rp_rpjmdes.id_parent_rpjmdes,
		tbl_rp_rpjmdes.id_top_rpjmdes,
		tbl_rp_rpjmdes.id_tahun_anggaran,
		');
		$this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
		$this->db->where('tbl_rp_rpjmdes.id_rpjmdes', $id);
		$this->db->or_where('tbl_rp_rpjmdes.id_top_rpjmdes', $id);
		$q = $this->db->get('tbl_rp_rpjmdes');
		return $q->result();
	}
	
	function getNumRowRpjmdes_ByIdRpjmdes($id)
	{
		$this->db->select('
		tbl_rp_rpjmdes.id_rpjmdes,
		tbl_rp_rpjmdes.program,
		tbl_rp_rpjmdes.kondisi_awal,
		tbl_rp_rpjmdes.target,
		tbl_rp_rpjmdes.id_parent_rpjmdes,
		tbl_rp_rpjmdes.id_top_rpjmdes,
		tbl_rp_rpjmdes.id_tahun_anggaran,
		');
		$this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
		$this->db->where('tbl_rp_rpjmdes.id_rpjmdes', $id);
		$this->db->or_where('tbl_rp_rpjmdes.id_top_rpjmdes', $id);
		$q = $this->db->get('tbl_rp_rpjmdes');
		return $q->num_rows();
	}
	
	function getIdParentRpjmdes_ByIdParentRpjmdes($id_parent_rpjmdes)
	{
		$this->db->select('id_parent_rpjmdes');
		$this->db->where('id_parent_rpjmdes',$id_parent_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_parent_rpjmdes']);
	}
	
	function getIdTopRpjmdes_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_top_rpjmdes');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_top_rpjmdes']);
	}
	
	function getIdRpjmdes_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_rpjmdes');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_rpjmdes']);
	}
	
	function getProgram_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('program');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['program']);
	}
	
	function getPeriode_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode',false);
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['periode']);
	}
	
	function get_tahun_anggaran() 
	{      
		$this->db->where('id_tahun_anggaran !=','0');
		$this->db->order_by('deskripsi','asc');
		$records = $this->db->get('ref_rp_tahun_anggaran');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_tahun_anggaran] = $row->tahun;
		}
		return ($data);
	}
	
	function get_rpjmd() 
	{      
		$this->db->where('id_rpjmd !=','0');
		$this->db->where('id_parent_rpjmd', null);
		$this->db->order_by('program','asc');
		$records = $this->db->get('tbl_rp_rpjmd');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_rpjmd] = $row->program;
		}
		return ($data);
	}
	
	function getIdRpjmd_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_rpjmd');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_rpjmd']);
	}
	
	function getIdBidang_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_bidang');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	
	function getIdPeriode_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_periode');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_periode']);
	}
	
	function getProgram_ByIdRpjmd($id_rpjmd)
	{
		$this->db->select('program');
		$this->db->where('id_rpjmd',$id_rpjmd);
		$q = $this->db->get('tbl_rp_rpjmd');
		$data = array_shift($q->result_array());
		return ($data['program']);
	}

	public function get_program() {
		$this->db->select('
		*
		');
		$this->db->where('id_parent_rpjmdes', null);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$q->result();
		//example -> //$query = $this->db->get_where('categories', array('category_id_parent' => 0));
		//$q = $this->db->get_where('tbl_rp_rpjmdes', array('id_parent_rpjmdes' => 0));
		if ($q->num_rows() > 0):
			return $q;
		endif;
		
	}
	
	function get_periode() 
	{      
		$this->db->where('id_periode !=','0');
		$records = $this->db->get('ref_rp_periode');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_periode] = $row->periode_awal .' - '. $row->periode_akhir;
		}
		return ($data);
	}
	
	function get_Bidang($deskripsi)
	{
		$this->db->select('*');
		
        $this->db->where('level',3);
        $this->db->or_where('level',4);
		
        $this->db->like('deskripsi', $deskripsi);
        $query = $this->db->get('ref_rp_bidang');
        return $query->result();
	}
	
	function get_IdBidangByKodeBidang($kode_bidang)
	{
		$this->db->select('id_bidang');
		$this->db->where('kode_bidang',$kode_bidang);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	function get_IdBidangByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_bidang');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	
	function get_BidangByIdBidang($id_bidang)
	{
		$this->db->select('*');
		$this->db->where('id_bidang',$id_bidang);
		$query = $this->db->get('ref_rp_bidang');
		return $query->row();
	}
	
	function get_IdPeriode_ByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select('id_periode');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['id_periode']);
	}
	
	/* function get_PeriodeAwal_ById($id_periode)
	{
		$this->db->select('periode_awal');
		$this->db->where('id_periode',$id_periode);
		$q = $this->db->get('ref_rp_periode');
		$data = array_shift($q->result_array());
		return ($data['periode_awal']);
	}
	
	function get_PeriodeAkhir_ById($id_periode)
	{
		$this->db->select('periode_akhir');
		$this->db->where('id_periode',$id_periode);
		$q = $this->db->get('ref_rp_periode');
		$data = array_shift($q->result_array());
		return ($data['periode_akhir']);
	}
	
	
	function get_tahun_byIdPeriode($id_periode) 
	{      
		$data = array();
		$base_year = date("Y");
		$min_year = $this->get_PeriodeAwal_ById($id_periode);//$base_year - 5;
		$max_year = $this->get_PeriodeAkhir_ById($id_periode);//$base_year + 5;

		for( $i = $min_year; $i <= $max_year; $i++)
		{   
			$data[''] = '--Pilih--';
			$data[$i] = $i;
		}
		return ($data);
	} */
	
	function get_tahun_ByIdPeriode($id_periode) 
	{   
		$this->db->select(
		'
		ref_rp_tahun_anggaran.id_tahun_anggaran,
		ref_rp_tahun_anggaran.tahun,
		ref_rp_periode.periode_awal,
		ref_rp_periode.periode_akhir
		');
		$this->db->where('ref_rp_periode.id_periode !=','0');
		$this->db->where('ref_rp_periode.id_periode',$id_periode);
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = ref_rp_tahun_anggaran.id_periode');
		$records = $this->db->get('ref_rp_tahun_anggaran');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->tahun] = $row->tahun;
		}
		return ($data);
	}
	
	function getIdTahunAnggaran_ByTahun($tahun)
	{
		$this->db->select('id_tahun_anggaran');
		$this->db->where('tahun',$tahun);
		$q = $this->db->get('ref_rp_tahun_anggaran');
		$data = array_shift($q->result_array());
		return ($data['id_tahun_anggaran']);
	}
	
	function getTreeview()
	{
		 $query = $this->db->get('tbl_rp_rpjmdes');
		 return $query->result_array();
	}

}
?>
