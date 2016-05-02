<?php
class M_rkpdes extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_rp_rkpdes';
    $this->_tableRefSumberDana='ref_rp_sumber_dana';
    //get instance
    $this->CI = get_instance();
  }
	public function get_rkpdes_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'
		tbl_rp_rkpdes.id_rkpdes,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		tbl_rp_rkpdes.program as program_rkpdes,
		tbl_rp_rkpdes.indikator,
		tbl_rp_rkpdes.kondisi_awal,
		tbl_rp_rkpdes.target,
		tbl_rp_rkpdes.lokasi,
		tbl_rp_rkpdes.nominal,
		tbl_rp_rkpdes.id_parent_rkpdes,
		tbl_rp_rkpdes.id_top_rkpdes,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran,
		ref_rp_bidang.deskripsi as bidang,
		ref_rp_bidang.kode_bidang as kode_bidang,
		ref_rp_coa.kode_rekening as kode_rekening,
		ref_rp_sumber_dana.sumber as sumber_dana
		'
		)->from($this->_table);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rkpdes.id_rpjmdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rkpdes.id_tahun_anggaran', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rkpdes.id_bidang', 'left');
		$this->db->join('ref_rp_coa','ref_rp_coa.id_coa = tbl_rp_rkpdes.id_coa', 'left');
		$this->db->join('ref_rp_sumber_dana','ref_rp_sumber_dana.id_sumber_dana = tbl_rp_rkpdes.id_sumber_dana', 'left');
        $this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
        $this->db->order_by('tbl_rp_rkpdes.id_parent_rkpdes ', null);
		$this->db->group_by('tbl_rp_rkpdes.id_rkpdes ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rkpdes.id_rkpdes) as record_count")->from($this->_table);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rkpdes.id_rpjmdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rkpdes.id_tahun_anggaran', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rkpdes.id_bidang', 'left');
		$this->db->join('ref_rp_coa','ref_rp_coa.id_coa = tbl_rp_rkpdes.id_coa', 'left');
		$this->db->join('ref_rp_sumber_dana','ref_rp_sumber_dana.id_sumber_dana = tbl_rp_rkpdes.id_sumber_dana', 'left');
        $this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
        $this->db->order_by('tbl_rp_rkpdes.id_parent_rkpdes ', null);
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function get_rkpdes_flexigrid_byIdRkpdes($id)
    {
        //Build contents query
       $this->db->select(
		'
		tbl_rp_rkpdes.id_rkpdes,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		tbl_rp_rkpdes.program as program_rkpdes,
		tbl_rp_rkpdes.indikator,
		tbl_rp_rkpdes.kondisi_awal,
		tbl_rp_rkpdes.target,
		tbl_rp_rkpdes.lokasi,
		tbl_rp_rkpdes.nominal,
		tbl_rp_rkpdes.id_parent_rkpdes,
		tbl_rp_rkpdes.id_top_rkpdes,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran,
		ref_rp_bidang.deskripsi as bidang,
		ref_rp_bidang.kode_bidang as kode_bidang,
		ref_rp_coa.kode_rekening as kode_rekening,
		ref_rp_sumber_dana.sumber as sumber_dana'
		)->from($this->_table);
       
        //$this->db->where('tbl_rp_rkpdes.id_rkpdes !=', 0);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rkpdes.id_rpjmdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rkpdes.id_tahun_anggaran', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rkpdes.id_bidang', 'left');
		$this->db->join('ref_rp_coa','ref_rp_coa.id_coa = tbl_rp_rkpdes.id_coa', 'left');
		$this->db->join('ref_rp_sumber_dana','ref_rp_sumber_dana.id_sumber_dana = tbl_rp_rkpdes.id_sumber_dana', 'left');
		 $this->db->where('tbl_rp_rkpdes.id_rkpdes', $id);
        $this->db->or_where('tbl_rp_rkpdes.id_top_rkpdes', $id);
        //$this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
        $this->db->order_by('tbl_rp_rkpdes.id_parent_rkpdes ', null);
        $this->db->group_by('tbl_rp_rkpdes.id_rkpdes ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_rkpdes) as record_count")->from($this->_table);     
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rkpdes.id_rpjmdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rkpdes.id_tahun_anggaran', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rkpdes.id_bidang', 'left');
		$this->db->join('ref_rp_coa','ref_rp_coa.id_coa = tbl_rp_rkpdes.id_coa', 'left');
		$this->db->join('ref_rp_sumber_dana','ref_rp_sumber_dana.id_sumber_dana = tbl_rp_rkpdes.id_sumber_dana', 'left');		
		$this->db->where('tbl_rp_rkpdes.id_rkpdes', $id);
		$this->db->or_where('tbl_rp_rkpdes.id_top_rkpdes', $id);
        $this->db->where('tbl_rp_rkpdes.id_rkpdes !=', 0);
		
		//$this->db->where('id_parent_rkpdes ', null);
		//$this->db->order_by('tbl_rp_rkpdes.id_parent_rkpdes ', null);
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
  function insertRkpdes($data)
  {
    $this->db->insert($this->_table, $data);
  } 
  
  function deleteRkpdes($id)
  {
    $this->db->where('id_rkpdes', $id);
    $this->db->delete($this->_table);
  }
  
  function getRkpdesByIdRkpdes($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_rkpdes' => $id))->row();
  }
  
  function updateRkpdes($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
  function updateSumberDana($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update('ref_rp_sumber_dana', $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($program)
	{	
		return $this->db->get_where($this->_table,array('program' => $program))->row();
	}
	
	function getRowRkpdes_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('*');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$query = $this->db->get('tbl_rp_rkpdes');
		return $query->row();
	}
	
	function getRowBidang_ByIdBidang($id_bidang)
	{
		$this->db->select('*');
		$this->db->where('id_bidang',$id_bidang);
		$query = $this->db->get('ref_rp_bidang');
		return $query->row();
	}
	
	function getRowSumberDana_ByIdSumberDana($id_sumber_dana)
	{
		$this->db->select('*');
		$this->db->where('id_sumber_dana',$id_sumber_dana);
		$query = $this->db->get('ref_rp_sumber_dana');
		return $query->row();
	}
	
	function getResult_RkpdesByIdRkpdes($id)
	{
		$this->db->select('
		tbl_rp_rkpdes.id_rkpdes,
		tbl_rp_rkpdes.program,
		tbl_rp_rkpdes.kondisi_awal,
		tbl_rp_rkpdes.target,
		tbl_rp_rkpdes.id_parent_rkpdes,
		tbl_rp_rkpdes.id_top_rkpdes,
		tbl_rp_rkpdes.id_tahun_anggaran,
		');
		$this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
		$this->db->where('tbl_rp_rkpdes.id_rkpdes', $id);
		$this->db->or_where('tbl_rp_rkpdes.id_top_rkpdes', $id);
		$q = $this->db->get('tbl_rp_rkpdes');
		return $q->result();
	}
	
	function getNumRowRkpdes_ByIdRkpdes($id)
	{
		$this->db->select('
		tbl_rp_rkpdes.id_rkpdes,
		tbl_rp_rkpdes.program,
		tbl_rp_rkpdes.kondisi_awal,
		tbl_rp_rkpdes.target,
		tbl_rp_rkpdes.id_parent_rkpdes,
		tbl_rp_rkpdes.id_top_rkpdes,
		tbl_rp_rkpdes.id_tahun_anggaran,
		');
		$this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
		$this->db->where('tbl_rp_rkpdes.id_rkpdes', $id);
		$this->db->or_where('tbl_rp_rkpdes.id_top_rkpdes', $id);
		$q = $this->db->get('tbl_rp_rkpdes');
		return $q->num_rows();
	}
	
	function getIdParentRkpdes_ByIdParentRkpdes($id_parent_rkpdes)
	{
		$this->db->select('id_parent_rkpdes');
		$this->db->where('id_parent_rkpdes',$id_parent_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_parent_rkpdes']);
	}
	
	function getIdTopRkpdes_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_top_rkpdes');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_top_rkpdes']);
	}
	
	function getIdRkpdes_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_rkpdes');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_rkpdes']);
	}
	
	function getIdRpjmdes_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_rpjmdes');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_rpjmdes']);
	}
	
	function getIdRkpdes_ByIdSumberDana($id_sumber_dana)
	{
		$this->db->select('id_rkpdes');
		$this->db->where('id_sumber_dana',$id_sumber_dana);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_rkpdes']);
	}
	
	function getNominal_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('nominal');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['nominal']);
	}
	
	function getIdBidang_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_bidang');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	
	function getIdSumberDana_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_sumber_dana');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_sumber_dana']);
	}
	
	/* function getIdSumberDana_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_sumber_dana');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_sumber_dana']);
	} */
	
	function getProgram_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('program');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['program']);
	}
	
	function getIdBidangByKodeBidang($kode_bidang)
	{
		$this->db->select('id_bidang');
		$this->db->where('kode_bidang',$kode_bidang);
		$q = $this->db->get('ref_rp_bidang');
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
	
	function get_tahun_anggaran_dynamic($id_periode) 
	{      
		$this->db->where('id_tahun_anggaran !=','0');
		$this->db->where('id_periode',$id_periode);	
		$this->db->order_by('tahun','asc');
		$records = $this->db->get('ref_rp_tahun_anggaran');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_tahun_anggaran] = $row->tahun;
		}
		return ($data);
	}
	
	function get_rpjmdes() 
	{      
		$this->db->select('id_rpjmdes, program, id_periode');
		$this->db->where('id_rpjmdes !=','0');
		$this->db->where('id_parent_rpjmdes', null);
		$this->db->order_by('program','asc');
		$records = $this->db->get('tbl_rp_rpjmdes');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_rpjmdes] = $row->program;
		}
		return ($data);
	}
	
	function get_sumber_dana() 
	{      
		$this->db->where('id_sumber_dana !=','0');
		$this->db->order_by('id_sumber_dana','asc');
		$records = $this->db->get('ref_rp_sumber_dana');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_sumber_dana] = $row->sumber;
		}
		return ($data);
	}
	
	function get_nominal_sumber_dana($id_sumber_dana)
	{
		$this->db->select('id_sumber_dana,nominal');
		$this->db->where('id_sumber_dana',$id_sumber_dana);
		$q = $this->db->get('ref_rp_sumber_dana');
		$data = array_shift($q->result_array());
		return ($data['nominal']);
	}
	
	function get_Bidang($deskripsi)
	{
		$this->db->select('*');
        $this->db->like('deskripsi',$deskripsi);
        $this->db->where('level',3);
        $this->db->or_where('level',4);
        $query = $this->db->get('ref_rp_bidang');
        return $query->result();
	}
	
	function get_coa() 
	{      
		$this->db->where('id_coa !=','0');
		$this->db->where('level','3');
		$this->db->or_where('level','4');
		$this->db->order_by('kode_rekening','asc');
		$records = $this->db->get('ref_rp_coa');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_coa] = $row->kode_rekening .' - '. $row->deskripsi;
		}
		return ($data);
	}
	
	function getIdRpjmd_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_rpjmdes');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_rpjmdes']);
	}
	
	function getProgram_ByIdRpjmd($id_rpjmdes)
	{
		$this->db->select('program');
		$this->db->where('id_rpjmdes',$id_rpjmdes);
		$q = $this->db->get('tbl_rp_rpjmdes');
		$data = array_shift($q->result_array());
		return ($data['program']);
	}
	function getTreeview()
	{
		 $query = $this->db->get('tbl_rp_rkpdes');
		 return $query->result_array();
	}

}
?>
