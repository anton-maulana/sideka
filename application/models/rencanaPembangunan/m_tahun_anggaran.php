<?php
class M_tahun_anggaran extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_rp_tahun_anggaran';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_tahun_anggaran_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'
		ref_rp_tahun_anggaran.id_tahun_anggaran,
		ref_rp_tahun_anggaran.deskripsi,
		ref_rp_tahun_anggaran.regulasi,
		ref_rp_tahun_anggaran.keterangan,
		ref_rp_tahun_anggaran.tahun,
		ref_rp_tahun_anggaran.id_periode,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode
		',false
		)->from($this->_table);
        $this->db->join('ref_rp_periode', 'ref_rp_periode.id_periode = ref_rp_tahun_anggaran.id_periode');
        $this->db->where('id_tahun_anggaran !=', 0);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_tahun_anggaran) as record_count")->from($this->_table);        
        $this->db->where('id_tahun_anggaran !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	function insertTahun_anggaran($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deleteTahun_anggaran($id)
	{
		$this->db->where('id_tahun_anggaran', $id);
		$this->db->delete($this->_table);
	}

	function getTahun_anggaranByIdTahun_anggaran($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_tahun_anggaran' => $id))->row();
	}

	function updateTahun_anggaran($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('deskripsi' => $deskripsi))->row();
	}
	
	function get_year() 
	{      
		$data = array();
		$base_year = date("Y");
		$min_year = $base_year - 5;
		$max_year = $base_year + 10;

		for( $i = $min_year; $i <= $max_year; $i++)
		{   
			$data[''] = '--Pilih--';
			$data[$i] = $i;
		}

		return ($data);
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
}
?>