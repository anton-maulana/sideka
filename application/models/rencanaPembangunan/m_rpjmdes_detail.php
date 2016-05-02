<?php
class M_rpjmdes_detail extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->_table='tbl_rp_rpjmdes_detail';
		$this->load->library('Excel_generator');		
		
		$this->CI = get_instance();
	}
	
	public function getDetailRpjmdesFlexigrid($id_periode)
    {
		$min_year = $this->get_PeriodeAwal_ById($id_periode);//$base_year - 5;
		$year_1 = $min_year + 1 ; 
		$year_2 = $min_year + 2 ; 
		$year_3 = $min_year + 3 ; 
		$max_year = $this->get_PeriodeAkhir_ById($id_periode);//$base_year + 5;
		
        //Build contents query
        $this->db->select(
		'tbl_rp_rpjmdes_detail.id_rpjmdes_detail,
		ref_rp_bidang.kode_bidang,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		tbl_rp_rpjmdes.indikator,
		tbl_rp_rpjmdes.id_periode,
		tbl_rp_rpjmdes_detail.volume,
		tbl_rp_rpjmdes_detail.satuan,
		tbl_rp_rpjmdes_detail.nominal,
		tbl_rp_rpjmdes_detail.lokasi,
		tbl_rp_rpjmdes_detail.tanggal,
		tbl_rp_rpjmdes_detail.id_rpjmdes,
		sum(case ref_rp_tahun_anggaran.tahun when '."$min_year".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_1,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_1".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_2,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_2".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_3,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_3".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_4,
		sum(case ref_rp_tahun_anggaran.tahun when '."$max_year".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_5,
		tbl_rp_rpjmdes.capaian,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		',false
		)->from($this->_table);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmdes_detail.id_tahun_anggaran', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_periode',$id_periode);
		$this->db->group_by('tbl_rp_rpjmdes_detail.id_rpjmdes');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rpjmdes_detail.id_rpjmdes_detail) as record_count")->from($this->_table);        
        $this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmdes_detail.id_tahun_anggaran', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_periode',$id_periode);
		$this->db->group_by('tbl_rp_rpjmdes_detail.id_tahun_anggaran');
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
		
        $row = $record_count->row();
        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
		
    }
	
	function getDataForExportExcel($id_periode)
	{
		$min_year = $this->get_PeriodeAwal_ById($id_periode);//$base_year - 5;
		$year_1 = $min_year + 1 ; 
		$year_2 = $min_year + 2 ; 
		$year_3 = $min_year + 3 ; 
		$max_year = $this->get_PeriodeAkhir_ById($id_periode);//$base_year + 5;
		
        //Build contents query
        $this->db->select(
		'tbl_rp_rpjmdes_detail.id_rpjmdes_detail,
		ref_rp_bidang.kode_bidang,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		tbl_rp_rpjmdes.indikator,
		tbl_rp_rpjmdes.id_periode,
		tbl_rp_rpjmdes_detail.volume,
		tbl_rp_rpjmdes_detail.satuan,
		tbl_rp_rpjmdes_detail.nominal,
		tbl_rp_rpjmdes_detail.lokasi,
		tbl_rp_rpjmdes_detail.tanggal,
		tbl_rp_rpjmdes_detail.id_rpjmdes,
		sum(case ref_rp_tahun_anggaran.tahun when '."$min_year".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_1,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_1".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_2,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_2".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_3,
		sum(case ref_rp_tahun_anggaran.tahun when '."$year_3".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_4,
		sum(case ref_rp_tahun_anggaran.tahun when '."$max_year".' then tbl_rp_rpjmdes_detail.nominal else 0 end) as tahun_5,
		tbl_rp_rpjmdes.capaian,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		',false
		)->from($this->_table);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmdes_detail.id_tahun_anggaran', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_periode',$id_periode);
		$this->db->group_by('tbl_rp_rpjmdes_detail.id_rpjmdes');
		$query = $this->db->get();
		$this->excel_generator->set_query($query);
	}
	
	function getPeriode() 
	{      
		$this->db->where('id_periode !=','0');
		$records = $this->db->get('ref_rp_periode');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '-- Pilih Periode --';
			$data[$row->id_periode] = 'Periode: '.$row->periode_awal .' - '. $row->periode_akhir;
		}
		return ($data);
	} 
	function get_PeriodeAwal_ById($id_periode)
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
	function get_year() 
	{      
		$data = array();
		$base_year = date("Y");
		$min_year = $base_year - 0;
		$max_year = $base_year + 5;

		for( $i = $min_year; $i <= $max_year; $i++) // or $i+=1;
		{   
			$data[''] = '--Pilih--';
			$data[$i] = $i;
		}

		return ($data);
	}
	
	/* 
	function __construct()
	{
		parent::__construct();
		$this->_table='tbl_rp_rpjmdes_detail';
		$this->CI = get_instance();
	}
	
	function getDetilRPJMDes()
	{
		$this->db->select(
		'tbl_rp_rpjmdes_detail.id_rpjmdes_detail,
		ref_rp_bidang.kode_bidang,
		tbl_rp_rpjmdes.program as program_rpjmdes,
		CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir) AS periode,
		tbl_rp_rpjmdes.indikator,
		tbl_rp_rpjmdes_detail.volume,
		tbl_rp_rpjmdes_detail.satuan,
		tbl_rp_rpjmdes_detail.nominal,
		tbl_rp_rpjmdes_detail.lokasi,
		tbl_rp_rpjmdes_detail.tanggal,
		tbl_rp_rpjmdes_detail.id_rpjmdes,
		tbl_rp_rpjmdes_detail.id_tahun_anggaran,
		tbl_rp_rpjmdes.capaian,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		',false
		)->from($this->_table);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmdes_detail.id_tahun_anggaran', 'left');
		$this->db->group_by('ref_rp_bidang.kode_bidang');
		$q = $this->db->get();
		return $q->result();
	}
	
	function getIdRpjmdes_ByIdDetilRpjmdes($id_rpjmdes_detail)
	{
		$this->db->select('id_rpjmdes');
		$this->db->where('id_rpjmdes_detail',$id_rpjmdes_detail);
		$q = $this->db->get('tbl_rp_rpjmdes_detail');
		$data = array_shift($q->result_array());
		return ($data['id_rpjmdes']);
	}
	
	function getNominalByIdRpjmdes($id_rpjmdes)
	{
		$this->db->select(
		'
		tbl_rp_rpjmdes_detail.nominal
		'
		)->from($this->_table);
		$this->db->where('tbl_rp_rpjmdes_detail.id_rpjmdes',$id_rpjmdes);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rpjmdes_detail.id_rpjmdes', 'left');
		$q = $this->db->get();
		return $q->result();
	}
	
	function get_periode() 
	{      
		$this->db->where('id_periode !=','0');
		$records = $this->db->get('ref_rp_periode');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih Periode--';
			$data[$row->id_periode] = $row->periode_awal .' - '. $row->periode_akhir;
		}
		return ($data);
	} */
}
?>