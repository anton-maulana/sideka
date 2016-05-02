<?php
class M_rabdes extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->_table='tbl_rp_rabdes';
		//get instance
		$this->CI = get_instance();
	}
	
	public function getRabdesFlexigrid()
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
		$this->db->join('tbl_rp_rkpdes','tbl_rp_rkpdes.id_rkpdes = tbl_rp_rabdes.id_rkpdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rabdes.id_tahun_anggaran', 'left');
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function getRabdesAnggaranFlexigridByIdRabdes($id_rabdes)
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
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_rabdes_anggaran.id_rabdes', 'left');		
		$this->db->where('tbl_rp_rabdes_anggaran.id_rabdes',$id_rabdes);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	
	public function getDataRabdesByIdRabdes($id_rabdes)
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
	public function getDataRabdesAnggaranByIdRabdes($id_rabdes)
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
	
	function insertRabdes($data)
	{
		$this->db->insert($this->_table, $data);
	} 
	
	function insertRabdesAnggaran($data)
	{
		$this->db->insert('tbl_rp_rabdes_anggaran', $data);
	}
	
	function getRabdesByIdRabdes($id) //edit
	{	
		return $this->db->get_where($this->_table,array('id_rabdes' => $id))->row();
	}
	
	function getRabdesAnggaranByIdRabdesAnggaran($id) //edit
	{	
		return $this->db->get_where('tbl_rp_rabdes_anggaran',array('id_rabdes_anggaran' => $id))->row();
	}
	
	function updateRabdes($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function updateRabdesAnggaran($where, $data) //update
	{
		$this->db->where($where);
		$this->db->update('tbl_rp_rabdes_anggaran', $data);
		return $this->db->affected_rows();
	}
	
	function deleteRabdes($id)
	{
		$this->db->where('id_rabdes', $id);
		$this->db->delete($this->_table);
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
	
	function cekFIleExist($kegiatan)
	{	
		return $this->db->get_where($this->_table,array('kegiatan' => $kegiatan))->row();
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
	
	function get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes)
	{
		$this->db->select('id_tahun_anggaran');
		$this->db->where('id_rkpdes',$id_rkpdes);
		$q = $this->db->get('tbl_rp_rkpdes');
		$data = array_shift($q->result_array());
		return ($data['id_tahun_anggaran']);
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
	
	

}
?>
