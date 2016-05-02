<?php

class M_bidang extends CI_Model {
    
    private $_table = 'ref_rp_bidang';

    function __construct() {
        parent::__construct();
        $this->_table = 'ref_rp_bidang';
        //get instance
        $this->CI = get_instance();
    }

    public function get_bidang_flexigrid() {
        //Build contents query
        $this->db->select(
                '
		ref_rp_bidang.id_bidang,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi,
		ref_rp_bidang.id_parent_bidang,
		ref_rp_bidang.id_top_bidang,
		ref_rp_bidang.level
		'
        )->from($this->_table);
        $this->db->where('ref_rp_bidang.id_parent_bidang', null);
        $this->db->order_by('ref_rp_bidang.id_parent_bidang ', null);
        $this->db->group_by('ref_rp_bidang.id_bidang ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(ref_rp_bidang.id_bidang) as record_count")->from($this->_table);
        $this->db->where('ref_rp_bidang.id_parent_bidang', null);
        $this->db->order_by('ref_rp_bidang.id_parent_bidang ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    public function get_bidang_flexigrid_byIdBidang($id) {
        //Build contents query
        $this->db->select(
                '
		ref_rp_bidang.id_bidang,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi,
		ref_rp_bidang.id_parent_bidang,
		ref_rp_bidang.id_top_bidang,
		ref_rp_bidang.level
		'
        )->from($this->_table);
        $this->db->where('ref_rp_bidang.id_bidang', $id);
        $this->db->or_where('ref_rp_bidang.id_top_bidang', $id);
        $this->db->order_by('ref_rp_bidang.id_parent_bidang ', null);
        $this->db->group_by('ref_rp_bidang.id_bidang ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_bidang) as record_count")->from($this->_table);
        $this->db->where('ref_rp_bidang.id_bidang', $id);
        $this->db->or_where('ref_rp_bidang.id_top_bidang', $id);
        $this->db->where('ref_rp_bidang.id_bidang !=', 0);

        //$this->db->where('id_parent_bidang ', null);
        //$this->db->order_by('ref_rp_bidang.id_parent_bidang ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    function insertBidang($data) {
        $this->db->insert($this->_table, $data);
    }

    function deleteBidang($id) {
        $this->db->where('id_bidang', $id);
        $this->db->delete($this->_table);
    }

    function getBidangByIdBidang($id) { //edit
        return $this->db->get_where($this->_table, array('id_bidang' => $id))->row();
    }

    function updateBidang($where, $data) { //update
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    function cekFIleExist($deskripsi) {
        return $this->db->get_where($this->_table, array('deskripsi' => $deskripsi))->row();
    }

    function getRowBidang_ByIdBidang($id_bidang) {
        $this->db->select('*');
        $this->db->where('id_bidang', $id_bidang);
        $query = $this->db->get('ref_rp_bidang');
        return $query->row();
    }

    function getResult_BidangByIdBidang($id) {
        $this->db->select(
                '
		ref_rp_bidang.id_bidang,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi,
		ref_rp_bidang.level,
		ref_rp_bidang.id_parent_bidang,
		ref_rp_bidang.id_top_bidang
		');
        $this->db->where('ref_rp_bidang.id_parent_bidang', null);
        $this->db->where('ref_rp_bidang.id_bidang', $id);
        $this->db->or_where('ref_rp_bidang.id_top_bidang', $id);
        $q = $this->db->get('ref_rp_bidang');
        return $q->result();
    }

    function getNumRowBidang_ByIdBidang($id) {
        $this->db->select(
                '
		ref_rp_bidang.id_bidang,
		ref_rp_bidang.kode_bidang,
		ref_rp_bidang.deskripsi,
		ref_rp_bidang.level,
		ref_rp_bidang.id_parent_bidang,
		ref_rp_bidang.id_top_bidang
		');
        $this->db->where('ref_rp_bidang.id_parent_bidang', null);
        $this->db->where('ref_rp_bidang.id_bidang', $id);
        $this->db->or_where('ref_rp_bidang.id_top_bidang', $id);
        $q = $this->db->get('ref_rp_bidang');
        return $q->num_rows();
    }

    function getIdParentBidang_ByIdParentBidang($id_parent_bidang) {
        $this->db->select('id_parent_bidang');
        $this->db->where('id_parent_bidang', $id_parent_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['id_parent_bidang']);
    }

    function getIdTopBidang_ByIdBidang($id_bidang) {
        $this->db->select('id_top_bidang');
        $this->db->where('id_bidang', $id_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['id_top_bidang']);
    }

    function getIdBidang_ByIdBidang($id_bidang) {
        $this->db->select('id_bidang');
        $this->db->where('id_bidang', $id_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['id_bidang']);
    }

    function getDeskripsi_ByIdBidang($id_bidang) {
        $this->db->select('deskripsi');
        $this->db->where('id_bidang', $id_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['deskripsi']);
    }

    function getKodeBidang_ByIdBidang($id_bidang) {
        $this->db->select('kode_bidang');
        $this->db->where('id_bidang', $id_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['kode_bidang']);
    }

    function getId_ByIdBidang($id_bidang) {
        $this->db->select('id_bidang');
        $this->db->where('id_bidang', $id_bidang);
        $q = $this->db->get('ref_rp_bidang');
        $data = array_shift($q->result_array());
        return ($data['id_bidang']);
    }

    function getTopLevelBidang() {
        $this->db->select('id_bidang, deskripsi');
        $this->db->where('level', 1);
        $q = $this->db->get('ref_rp_bidang');
        return $q->result_array();
    }

    function get_Bidang($keyword) {
        $where = "level >= 3 and (deskripsi LIKE '%".addslashes($keyword)."%' or kode_bidang LIKE '%".addslashes($keyword)."%') ";

        $this->db->where($where);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

}

?>
