<?php
class M_rencana_pembangunan extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//get instance
		$this->CI = get_instance();
	}
	function getRpjmdes()
    	{
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
		);
		$this->db->join('tbl_rp_rpjmd','tbl_rp_rpjmd.id_rpjmd = tbl_rp_rpjmdes.id_rpjmd', 'left');
		$this->db->join('ref_rp_periode','ref_rp_periode.id_periode = tbl_rp_rpjmdes.id_periode', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rpjmdes.id_bidang', 'left');
		$this->db->where('tbl_rp_rpjmdes.id_parent_rpjmdes', null);
		$this->db->order_by('tbl_rp_rpjmdes.id_rpjmdes ', 'desc');
		$this->db->group_by('tbl_rp_rpjmdes.id_rpjmdes ', null);
		$this->db->limit(5);
		$data=array();
		$query=$this->db->get('tbl_rp_rpjmdes');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function getRkpdes()
    	{
		$this->db->select(
		'tbl_rp_rkpdes.id_rkpdes,
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
		);
		$this->db->join('tbl_rp_rpjmdes','tbl_rp_rpjmdes.id_rpjmdes = tbl_rp_rkpdes.id_rpjmdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rkpdes.id_tahun_anggaran', 'left');
		$this->db->join('ref_rp_bidang','ref_rp_bidang.id_bidang = tbl_rp_rkpdes.id_bidang', 'left');
		$this->db->join('ref_rp_coa','ref_rp_coa.id_coa = tbl_rp_rkpdes.id_coa', 'left');
		$this->db->join('ref_rp_sumber_dana','ref_rp_sumber_dana.id_sumber_dana = tbl_rp_rkpdes.id_sumber_dana', 'left');
       	 	$this->db->where('tbl_rp_rkpdes.id_parent_rkpdes', null);
        	$this->db->order_by('tbl_rp_rkpdes.id_rkpdes ', 'desc');
		$this->db->group_by('tbl_rp_rkpdes.id_rkpdes ', null);
		$this->db->limit(5);
		$data=array();
		$query=$this->db->get('tbl_rp_rkpdes');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function getRabdes()
    	{
		$this->db->select(
		'
		tbl_rp_rabdes.id_rabdes,
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
		);
		$this->db->join('tbl_rp_rkpdes','tbl_rp_rkpdes.id_rkpdes = tbl_rp_rabdes.id_rkpdes', 'left');
		$this->db->join('ref_rp_tahun_anggaran','ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rabdes.id_tahun_anggaran', 'left');
		$this->db->order_by('tbl_rp_rabdes.id_rabdes ', 'desc');
		$this->db->limit(5);
		$data=array();
		$query=$this->db->get('tbl_rp_rabdes');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function getSpp()
   	{
		$this->db->select(
		'
		tbl_rp_spp.id_spp,
		tbl_rp_spp.tgl_ambil,
		tbl_rp_spp.total,
		tbl_rp_spp.tgl_entry,
		tbl_rp_spp.id_rabdes,
		tbl_rp_rabdes.kegiatan
		'
		);
		$this->db->join('tbl_rp_rabdes','tbl_rp_rabdes.id_rabdes = tbl_rp_spp.id_rabdes', 'left');
		$this->db->order_by('tbl_rp_spp.id_spp ', 'desc');
		$this->db->limit(5);
		$data=array();
		$query=$this->db->get('tbl_rp_spp');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
  
	
}
?>