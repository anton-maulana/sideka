<?php
class M_spp extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//$this->_table='tbl_rp_rabdes';
		$this->_table='tbl_rp_spp';
		//get instance
		$this->CI = get_instance();
		$this->load->library('subquery');
	}
	
	public function get_spp_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'
		tbl_rp_spp.id_spp,
		tbl_rp_spp.tgl_ambil,
		tbl_rp_spp.total,
		tbl_rp_spp.tgl_entry,
		tbl_rp_spp.id_rabdes,
		tbl_rp_rabdes.kegiatan
		'
		)->from($this->_table);
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_spp.id_spp) as record_count")->from($this->_table);        
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function getSpp_ByIdSpp($id_spp)
    {
        //Build contents query
        $this->db->select(
		'
		tbl_rp_spp.id_spp,
		tbl_rp_spp.tgl_ambil,
		tbl_rp_spp.total,
		tbl_rp_spp.tgl_entry,
		tbl_rp_spp.id_rabdes,
		tbl_rp_rabdes.kegiatan
		');
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
		$this->db->where('tbl_rp_spp.id_spp',$id_spp);
        $data=array();
		$query=$this->db->get('tbl_rp_spp');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
    }
	
	public function getSPP_detail_flexigrid_ById($id_spp)
    {
        //Build contents query
        $this->db->select(
		'
		tbl_rp_spp_detail.id_spp_detail,
		tbl_rp_spp_detail.pagu_anggaran,
		tbl_rp_spp_detail.pencairan_yg_lalu,
		tbl_rp_spp_detail.permintaan_sekarang,
		tbl_rp_spp_detail.jumlah_saat_ini,
		tbl_rp_spp_detail.sisa_dana,
		tbl_rp_spp_detail.id_spp,
		tbl_rp_rabdes_anggaran.uraian 
		'
		)->from('tbl_rp_spp_detail');
		$this->db->join('tbl_rp_spp','tbl_rp_spp.id_spp = tbl_rp_spp_detail.id_spp', 'left');
		$this->db->join('tbl_rp_rabdes_anggaran','tbl_rp_rabdes_anggaran.id_rabdes_anggaran = tbl_rp_spp_detail.id_rabdes_anggaran', 'left');
		//$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');
		$this->db->where('tbl_rp_spp_detail.id_spp',$id_spp);
		$this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_spp_detail.id_spp_detail) as record_count")->from('tbl_rp_spp_detail');        
		$this->db->where('tbl_rp_spp_detail.id_spp',$id_spp);
        
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;
		$this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }
	
	public function getSppDetail_ByIdSpp($id_spp)
    {
		$this->db->select(
		'
		tbl_rp_spp_detail.id_spp_detail,
		tbl_rp_spp_detail.pagu_anggaran,
		tbl_rp_spp_detail.pencairan_yg_lalu,
		tbl_rp_spp_detail.permintaan_sekarang,
		tbl_rp_spp_detail.permintaan_sekarang,
		tbl_rp_spp_detail.jumlah_saat_ini,
		tbl_rp_spp_detail.sisa_dana,
		tbl_rp_spp_detail.id_spp,
		tbl_rp_rabdes_anggaran.uraian 
		'
		);
		$this->db->join('tbl_rp_spp','tbl_rp_spp.id_spp = tbl_rp_spp_detail.id_spp', 'left');
		$this->db->join('tbl_rp_rabdes_anggaran','tbl_rp_rabdes_anggaran.id_rabdes_anggaran = tbl_rp_spp_detail.id_rabdes_anggaran', 'left');
		$this->db->where('tbl_rp_spp_detail.id_spp',$id_spp);
		$data=array();
		$query=$this->db->get('tbl_rp_spp_detail');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	public function getSppDetail_SUM_ByIdSpp($id_spp)
    {
		$this->db->select(
		'
		SUM(tbl_rp_spp_detail.pagu_anggaran) as sum_pagu_anggaran,
		SUM(tbl_rp_spp_detail.pencairan_yg_lalu) as sum_pencarian_yg_lalu,
		SUM(tbl_rp_spp_detail.permintaan_sekarang) as sum_permintaan_sekarang,
		SUM(tbl_rp_spp_detail.jumlah_saat_ini) as sum_jumlah_saat_ini,
		SUM(tbl_rp_spp_detail.sisa_dana) as sum_sisa_dana
		', TRUE
		);
		$this->db->where('tbl_rp_spp_detail.id_spp',$id_spp);
		$data=array();
		$query=$this->db->get('tbl_rp_spp_detail');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
		
	}
	
	function insertSpp($data)
	{
		$this->db->insert($this->_table, $data);
	} 
	function insertSppDetail($data)
	{
		$this->db->insert('tbl_rp_spp_detail', $data);
	} 
	
	function getSppByIdSpp($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_spp' => $id))->row();
	}
	
	function updateSpp($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function updateSppDetail($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update('tbl_rp_spp_detail', $data);
		return $this->db->affected_rows();
	}

	function deleteSpp($id)
	{
		$this->db->where('id_spp', $id);
		$this->db->delete($this->_table);
	}
	
	function deleteSppDetail($id)
	{
		$id_spp = $this->getIdSpp_ByIdSppDetail($id);
		$permintaan_sekarang = $this->getPermintaanSekarang_ByIdSppDetail($id);
		$temp_total = $this->getTotal_ByIdSpp($id_spp);
		$total = $temp_total - $permintaan_sekarang;
		$data1 = array(
			'id_spp' => $id_spp,
			'total' => $total
		);
		$this->db->where('id_spp_detail', $id);
		$this->db->delete('tbl_rp_spp_detail');
		$this->m_spp->updateSpp(array('id_spp' => $id_spp), $data1);
	}
	
	/* function cekFIleExist($kegiatan)
	{	
		return $this->db->get_where($this->_table,array('kegiatan' => $kegiatan))->row();
	} */
	function get_rkpdes() 
	{      
		$this->db->where('id_rkpdes !=','0');
		$this->db->where('id_top_rkpdes',null);
		$this->db->order_by('id_rkpdes','asc');
		$records = $this->db->get('tbl_rp_rkpdes');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_rkpdes] = $row->program;
		}
		return ($data);
	}
	function get_rabdes() 
	{      
		$this->db->where('id_rabdes !=','0');
		$this->db->order_by('id_rabdes','asc');
		$records = $this->db->get('tbl_rp_rabdes');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[''] = '--Pilih--';
			$data[$row->id_rabdes] = $row->kegiatan;
		}
		return ($data);
	}
	
	function getIdRabdes_ByIdSpp($id_spp)
	{
		$this->db->select('id_rabdes');
		$this->db->where('id_spp',$id_spp);
		$q = $this->db->get('tbl_rp_spp');
		$data = array_shift($q->result_array());
		return ($data['id_rabdes']);
	}
	
	function getIdRabdesAnggaran_ByIdSpp($id_spp)
	{
		$this->db->select('id_rabdes_anggaran');
		$this->db->where('id_spp',$id_spp);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['id_rabdes_anggaran']);
	}

	function getIdRkpdes_ByIdRabdes($id_rabdes)
	{
		$this->db->select('id_rkpdes');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['id_rkpdes']);
	}
	
	function getRkpdes_ByIdRkpdes_dynamic($id_rkpdes) 
	{      
		$this->db->where('id_rkpdes !=','0');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$this->db->order_by('id_rkpdes','asc');
		$records = $this->db->get('tbl_rp_rkpdes');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[$row->id_rkpdes] = $row->program;
		}
		return ($data);
	}
	
	function get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_tahun_anggaran');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_tahun_anggaran']);
	}
	
	function get_tahun_anggaran_dynamic($id_tahun_anggaran) 
	{      
		$this->db->where('id_tahun_anggaran !=','0');
		$this->db->where('id_tahun_anggaran',$id_tahun_anggaran);	
		$this->db->order_by('tahun','asc');
		$records = $this->db->get('ref_rp_tahun_anggaran');
		$data=array();
		foreach ($records->result() as $row)
		{	
			$data[$row->id_tahun_anggaran] = $row->tahun;
		}
		return ($data);
	}
	
	function getRowSpp_ByIdSpp($id_spp)
	{
		$this->db->select('*');
		$this->db->where('id_spp',$id_spp);
		$query = $this->db->get('tbl_rp_spp');
		return $query->row();
	}
	
	function getRowSppDetail_ByIdSppDetail($id_spp_detail)
	{
		$this->db->select('*');
		$this->db->where('id_spp_detail',$id_spp_detail);
		$this->db->join('tbl_rp_rabdes_anggaran','tbl_rp_rabdes_anggaran.id_rabdes_anggaran = tbl_rp_spp_detail.id_rabdes_anggaran', 'left');
		$query = $this->db->get('tbl_rp_spp_detail');
		return $query->row();
	}
	
	function getRowRkpdes_ByIdRkpdes($id_spp)
	{
		$this->db->select('*');
		$this->db->where('id_spp',$id_spp);
		$query = $this->db->get('tbl_rp_spp');
		return $query->row();
	}
	
	function getRowRabdesAnggaran_ByIdRabdes($id_rabdes)
	{
		$this->db->select(
		'tbl_rp_rabdes_anggaran.id_rabdes_anggaran,
		tbl_rp_rabdes_anggaran.id_rabdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes_anggaran.uraian,
		tbl_rp_rabdes_anggaran.volume,
		tbl_rp_rabdes_anggaran.harga_satuan,
		tbl_rp_rabdes_anggaran.jumlah,
		tbl_rp_rabdes_anggaran.tgl_entry,
		tbl_rp_spp_detail.jumlah_saat_ini,
		tbl_rp_spp_detail.sisa_dana
		'
		);
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');
		$this->db->join('tbl_rp_spp_detail','tbl_rp_spp_detail.id_rabdes_anggaran = tbl_rp_rabdes_anggaran.id_rabdes_anggaran', 'left');
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
		
		$subquery="(Select max(tbl_rp_spp_detail.id_spp_detail)
           from tbl_rp_spp_detail
           where tbl_rp_spp_detail.id_rabdes_anggaran=tbl_rp_rabdes_anggaran.id_rabdes_anggaran)";
		$this->db->where('tbl_rp_spp_detail.id_spp_detail ='.$subquery, null,FALSE);
		$this->db->or_where('tbl_rp_spp_detail.id_spp_detail',null);
		
		/* $sub = $this->subquery->start_subquery('where');
		$sub->select('tbl_rp_rabdes.id_rabdes')->from('tbl_rp_rabdes');
		$sub->where('tbl_rp_rabdes.id_rabdes', $id_rabdes);
		$this->subquery->end_subquery('tbl_rp_rabdes.id_rabdes'); 
		
		$sub = $this->subquery->start_subquery('where_in');
		$sub->select('MAX(tbl_rp_spp_detail.id_spp_detail)')->from('tbl_rp_spp_detail');
		$sub->where('tbl_rp_rabdes_anggaran.id_rabdes_anggaran = tbl_rp_spp_detail.id_rabdes_anggaran');
		$this->subquery->end_subquery('tbl_rp_spp_detail.id_spp_detail'); */
		
		$query=$this->db->get('tbl_rp_rabdes_anggaran');
		
		return $query->result();
		
		/* 
		$this->db->select(
		'tbl_rp_rabdes_anggaran.id_rabdes_anggaran,
		tbl_rp_rabdes_anggaran.id_rabdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes_anggaran.uraian,
		tbl_rp_rabdes_anggaran.volume,
		tbl_rp_rabdes_anggaran.harga_satuan,
		tbl_rp_rabdes_anggaran.jumlah,
		tbl_rp_rabdes_anggaran.tgl_entry,
		tbl_rp_spp_detail.jumlah_saat_ini,
		tbl_rp_spp_detail.sisa_dana
		'
		);
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');
		$this->db->join('tbl_rp_spp_detail','tbl_rp_spp_detail.id_rabdes_anggaran = tbl_rp_rabdes_anggaran.id_rabdes_anggaran', 'left');
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
		//$this->db->where('tbl_rp_spp_detail.id_rabdes_anggaran <>','tbl_rp_rabdes_anggaran.id_rabdes_anggaran');
		//$this->db->group_by('tbl_rp_rabdes_anggaran.id_rabdes_anggaran');
		$query=$this->db->get('tbl_rp_rabdes_anggaran');
		return $query->result(); */
	}
	
	function getJumlah_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('jumlah');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_rabdes_anggaran');
		$data = array_shift($q->result_array());
		return ($data['jumlah']);
	}
	
	function getPaguAnggaran_ByIdSppDetail($id_spp_detail)
	{
		$this->db->select('pagu_anggaran');
		$this->db->where('id_spp_detail',$id_spp_detail);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['pagu_anggaran']);
	}
	
	function getUraian_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('uraian');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_rabdes_anggaran');
		$data = array_shift($q->result_array());
		return ($data['uraian']);
	}
	
	function getIdSpp_ByIdSppDetail($id_spp_detail)
	{
		$this->db->select('id_spp');
		$this->db->where('id_spp_detail',$id_spp_detail);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['id_spp']);
	}
	
	function getPencairanYangLalu_ByIdSpp($id_spp)
	{
		$this->db->select('pencairan_yg_lalu');
		$this->db->where('id_spp',$id_spp);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['pencairan_yg_lalu']);
	}
	function getSisaDana_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('sisa_dana');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['sisa_dana']);
	}
	function getJumlahSaatIni_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('jumlah_saat_ini');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['jumlah_saat_ini']);
	}
	
	function getTotal_ByIdSpp($id_spp)
	{
		$this->db->select('total');
		$this->db->where('id_spp',$id_spp);
		$q = $this->db->get('tbl_rp_spp');
		$data = array_shift($q->result_array());
		return ($data['total']);
	}
	
	function getPermintaanSekarang_ByIdSppDetail($id_spp_detail)
	{
		$this->db->select('permintaan_sekarang');
		$this->db->where('id_spp_detail',$id_spp_detail);
		$q = $this->db->get('tbl_rp_spp_detail');
		$data = array_shift($q->result_array());
		return ($data['permintaan_sekarang']);
	}
	
	function getIdTahunAnggaran_ByIdRabdes($id_rabdes)
	{
		$this->db->select('id_tahun_anggaran');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['id_tahun_anggaran']);
	}
	
	function getIdBidang_byIdRkpdes($id)
	{
		$this->db->select('id_bidang');
		$this->db->where('id_rkpdes',$id);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	
	function getIdTopBidang_byIdBidang($id)
	{
		$this->db->select('id_top_bidang');
		$this->db->where('id_top_bidang',$id);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['id_top_bidang']);
	}
	
	function getBidang_byIdBidang($id)
	{
		$id_top_bidang = $this->getIdTopBidang_byIdBidang($id);
		$this->db->select('deskripsi');
		$this->db->where('id_top_bidang',$id_top_bidang);
		$this->db->where('level',1);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['deskripsi']);
	}
	
	function getKegiatan_byIdBidang($id)
	{
		$this->db->select('deskripsi');
		$this->db->where('id_bidang',$id);
		$this->db->where('level',4);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['deskripsi']);
	}
	
	function getIdPerangkat_ByIdRabdes($id_rabdes)
	{
		$this->db->select('id_perangkat');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['id_perangkat']);
	}
	
	function getIdPenduduk_ByIdPerangkat($id)
	{
		$this->db->select('id_penduduk');
		$this->db->where('id_perangkat',$id);
		$q = $this->db->get('tbl_perangkat');
		$data = array_shift($q->result_array());
		return ($data['id_penduduk']);
	}
	
	function getNamaKades_ByIdPenduduk($id)
	{
		$this->db->select('nama');
		$this->db->where('id_penduduk',$id);
		$q = $this->db->get('tbl_penduduk');
		$data = array_shift($q->result_array());
		return ($data['nama']);
	}
	function getNik_ByIdRabdes($id_rabdes)
	{
		$this->db->select('nik');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['nik']);
	}
	function getNip_ByIdRabdes($id_rabdes)
	{
		$this->db->select('nip');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['nip']);
	}
	function getNamaPengguna_ByNik($nik)
	{
		$this->db->select('nama');
		$this->db->where('nik',$nik);
		$q = $this->db->get('tbl_penduduk');
		$data = array_shift($q->result_array());
		return ($data['nama']);
	}
	function getPerangkatDesa_ByJabatan($jabatan)
	{
		$this->db->select(
		'
			tbl_perangkat.id_penduduk,
			tbl_perangkat.id_jabatan,
			tbl_penduduk.nama as nama,
			ref_jabatan.deskripsi
		');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_perangkat.id_penduduk', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = tbl_perangkat.id_jabatan', 'left');
		$this->db->where('tbl_perangkat.is_aktif','Y');
		$this->db->where('ref_jabatan.deskripsi',$jabatan);
		$q = $this->db->get('tbl_perangkat');
		$data = array_shift($q->result_array());
		return ($data['nama']);
	}
	
	function getNipPerangkatDesa_ByJabatan($jabatan)
	{
		$this->db->select(
		'
			tbl_perangkat.id_penduduk,
			tbl_perangkat.nip as nip,
			tbl_perangkat.id_jabatan,
			tbl_penduduk.nama,
			ref_jabatan.deskripsi
		');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_perangkat.id_penduduk', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = tbl_perangkat.id_jabatan', 'left');
		$this->db->where('tbl_perangkat.is_aktif','Y');
		$this->db->where('ref_jabatan.deskripsi',$jabatan);
		$q = $this->db->get('tbl_perangkat');
		$data = array_shift($q->result_array());
		return ($data['nip']);
	}
	
	
	/*
	public function get_rabdes_flexigrid()
    {
        //Build contents query
        $this->db->select(
		'tbl_rp_rabdes.id_rabdes,
		tbl_rp_rkpdes.program as program_rkpdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes.waktu_pelaksanaan_awal,
		tbl_rp_rabdes.waktu_pelaksanaan_akhir,
		tbl_rp_rabdes.total,
		tbl_rp_rabdes.id_tahun_anggaran,
		tbl_rp_rabdes.id_rkpdes,
		tbl_rp_rabdes.id_pengguna,
		tbl_rp_rabdes.nik,
		tbl_rp_rabdes.id_perangkat,
		tbl_rp_rabdes.nip,
		tbl_rp_rabdes.tgl_entry,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		'
		)->from($this->_table);
		$this->db->join('tbl_rp_rkpdes','tbl_rp_rkpdes.id_rkpdes = tbl_rp_rabdes.id_rkpdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rabdes.id_tahun_anggaran', 'left');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rabdes.id_rabdes) as record_count")->from($this->_table);        
		
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function getAnggaran_rabdes_flexigrid_ById($id_rabdes)
    {
        //Build contents query
        $this->db->select(
		'tbl_rp_rabdes_anggaran.id_rabdes_anggaran,
		tbl_rp_rabdes_anggaran.id_rabdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes_anggaran.uraian,
		tbl_rp_rabdes_anggaran.volume,
		tbl_rp_rabdes_anggaran.harga_satuan,
		tbl_rp_rabdes_anggaran.jumlah,
		tbl_rp_rabdes_anggaran.tgl_entry
		'
		)->from('tbl_rp_rabdes_anggaran');
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
		$this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rabdes_anggaran.id_rabdes_anggaran) as record_count")->from('tbl_rp_rabdes_anggaran');        
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function getRabdes_ByIdRabdes($id_rabdes)
    {
        //Build contents query
        $this->db->select(
		'tbl_rp_rabdes.id_rabdes,
		tbl_rp_rkpdes.program as program_rkpdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes.waktu_pelaksanaan_awal,
		tbl_rp_rabdes.waktu_pelaksanaan_akhir,
		tbl_rp_rabdes.total,
		tbl_rp_rabdes.id_tahun_anggaran,
		tbl_rp_rabdes.id_rkpdes,
		tbl_rp_rabdes.id_pengguna,
		tbl_rp_rabdes.nik,
		tbl_rp_rabdes.id_perangkat,
		tbl_rp_rabdes.nip,
		tbl_rp_rabdes.tgl_entry,
		ref_rp_tahun_anggaran.tahun as tahun_anggaran
		');
		$this->db->join('tbl_rp_rkpdes','tbl_rp_rkpdes.id_rkpdes = tbl_rp_rabdes.id_rkpdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rabdes.id_tahun_anggaran', 'left');
		$this->db->where('tbl_rp_rabdes.id_rabdes',$id_rabdes);
        $data=array();
		$query=$this->db->get('tbl_rp_rabdes');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
    }
	public function getRabdesAnggaran_ByIdRabdes($id_rabdes)
    {
		$this->db->select(
		'tbl_rp_rabdes_anggaran.id_rabdes_anggaran,
		tbl_rp_rabdes_anggaran.id_rabdes,
		tbl_rp_rabdes.kegiatan,
		tbl_rp_rabdes_anggaran.uraian,
		tbl_rp_rabdes_anggaran.volume,
		tbl_rp_rabdes_anggaran.harga_satuan,
		tbl_rp_rabdes_anggaran.jumlah,
		tbl_rp_rabdes_anggaran.tgl_entry
		'
		);
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
		$data=array();
		$query=$this->db->get('tbl_rp_rabdes_anggaran');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	
	
	function deleteRabdesAnggaran($id)
	{
		$id_rabdes = $this->getIdRabdes_ByIdRabdesAnggaran($id);
		$jumlah = $this->getJumlah_ByIdRabdesAnggaran($id);
		$total = $this->getTotal_ByIdRabdes($id_rabdes);
		$temp_total = $total - $jumlah;
		$data1 = array(
			'id_rabdes' => $id_rabdes,
			'total' => $temp_total
		);
		
		$this->db->where('id_rabdes_anggaran', $id);
		$this->db->delete('tbl_rp_rabdes_anggaran');
		$this->m_rabdes->updateRabdes(array('id_rabdes' => $id_rabdes), $data1);
	}
	
	function getRowRabdes_ByIdRabdes($id_rabdes)
	{
		$this->db->select('*');
		$this->db->where('id_rabdes',$id_rabdes);
		$query = $this->db->get('tbl_rp_rabdes');
		return $query->row();
	}

	function getRowRabdesAnggaran_ByIdRabdes($id_rabdes)
	{
		$this->db->select('*');
		$this->db->where('id_rabdes',$id_rabdes);
		$query = $this->db->get('tbl_rp_rabdes_anggaran');
		return $query->row();
	}
	
	function getRowRabdesAnggaran_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('*');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$query = $this->db->get('tbl_rp_rabdes_anggaran');
		return $query->row();
	}
	
	
	
	
	
	function getKegiatan_ByIdRabdes($id_rabdes)
	{
		$this->db->select('kegiatan');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['kegiatan']);
	}
	

	function getTotal_ByIdRabdes($id_rabdes)
	{
		$this->db->select('total');
		$this->db->where('id_rabdes',$id_rabdes);
		$q = $this->db->get('tbl_rp_rabdes');
		$data = array_shift($q->result_array());
		return ($data['total']);
	}
	
	function getJumlah_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('jumlah');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_rabdes_anggaran');
		$data = array_shift($q->result_array());
		return ($data['jumlah']);
	}
	

	
	function getIdRabdes_ByIdRabdesAnggaran($id_rabdes_anggaran)
	{
		$this->db->select('id_rabdes');
		$this->db->where('id_rabdes_anggaran',$id_rabdes_anggaran);
		$q = $this->db->get('tbl_rp_rabdes_anggaran');
		$data = array_shift($q->result_array());
		return ($data['id_rabdes']);
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

	
	function getRow_KepalaDesa()
	{
		$this->db->select('id_perangkat, nik as nip, tbl_perangkat.id_penduduk, is_aktif, deskripsi, nip');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = tbl_perangkat.id_jabatan', 'left');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_perangkat.id_penduduk', 'left');
		$this->db->where('ref_jabatan.deskripsi',"Kepala Desa");
		$this->db->where('tbl_perangkat.is_aktif',"Y");
		$query = $this->db->get('tbl_perangkat');
		return $query->row();
	}
	// --------- model untuk print rabdes ------ //
	function getTahunAnggaran_ByIdTahunAnggaran($id)
	{
		$this->db->select('tahun');
		$this->db->where('id_tahun_anggaran',$id);
		$q = $this->db->get('ref_rp_tahun_anggaran');
		$data = array_shift($q->result_array());
		return ($data['tahun']);
	}
	
	function getIdPenduduk_ByIdPerangkat($id)
	{
		$this->db->select('id_penduduk');
		$this->db->where('id_perangkat',$id);
		$q = $this->db->get('tbl_perangkat');
		$data = array_shift($q->result_array());
		return ($data['id_penduduk']);
	}
	
	function getNamaKades_ByIdPenduduk($id)
	{
		$this->db->select('nama');
		$this->db->where('id_penduduk',$id);
		$q = $this->db->get('tbl_penduduk');
		$data = array_shift($q->result_array());
		return ($data['nama']);
	}
	
	function getNamaPengguna_ByNik($nik)
	{
		$this->db->select('nama');
		$this->db->where('nik',$nik);
		$q = $this->db->get('tbl_penduduk');
		$data = array_shift($q->result_array());
		return ($data['nama']);
	}
	
	function getIdBidang_byIdRkpdes($id)
	{
		$this->db->select('id_bidang');
		$this->db->where('id_rkpdes',$id);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_bidang']);
	}
	
	function getIdTopBidang_byIdBidang($id)
	{
		$this->db->select('id_top_bidang');
		$this->db->where('id_top_bidang',$id);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['id_top_bidang']);
	}
	
	function getBidang_byIdBidang($id)
	{
		$id_top_bidang = $this->getIdTopBidang_byIdBidang($id);
		$this->db->select('deskripsi');
		$this->db->where('id_top_bidang',$id_top_bidang);
		$this->db->where('level',1);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['deskripsi']);
	}
	
	function getKegiatan_byIdBidang($id)
	{
		$this->db->select('deskripsi');
		$this->db->where('id_bidang',$id);
		$this->db->where('level',4);
		$q = $this->db->get('ref_rp_bidang');
		$data = array_shift($q->result_array());
		return ($data['deskripsi']);
	}
	*/
	

}
?>
