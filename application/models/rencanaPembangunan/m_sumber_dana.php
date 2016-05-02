<?php
class M_sumber_dana extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_rp_sumber_dana';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_sumber_dana_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'
		ref_rp_sumber_dana.id_sumber_dana,
		ref_rp_sumber_dana.sumber,
		ref_rp_sumber_dana.deskripsi,
		ref_rp_sumber_dana.nominal,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		')->from($this->_table);
        $this->db->where('id_sumber_dana !=', 0);
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = ref_rp_sumber_dana.id_tahun_anggaran', 'left');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_sumber_dana) as record_count")->from($this->_table);        
        $this->db->where('id_sumber_dana !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertSumber_dana($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteSumber_dana($id)
  {
    $this->db->where('id_sumber_dana', $id);
    $this->db->delete($this->_table);
  }
  
  function getSumber_danaByIdSumber_dana($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_sumber_dana' => $id))->row();
  }
  
  function updateSumber_dana($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('deskripsi' => $deskripsi))->row();
	}
	
	function get_tahun_anggaran() 
	{      
		$this->db->where('id_tahun_anggaran !=','0');
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
}
?>