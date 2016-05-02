<?php

class M_rpjmd extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_rp_rpjmd';
        $this->_tableTahun = 'tbl_rp_tahun_anggaran';
        //get instance
        $this->CI = get_instance();
    }

    public function getRpjmdFlexigrid() {
        //Build contents query
        $this->db->select(
                'tbl_rp_rpjmd.id_rpjmd,
		tbl_rp_rpjmd.program,
		tbl_rp_rpjmd.kondisi_awal,
		tbl_rp_rpjmd.target,
		tbl_rp_rpjmd.id_parent_rpjmd,
		tbl_rp_rpjmd.id_top_rpjmd,
		tbl_rp_rpjmd.id_tahun_anggaran,
		ref_rp_tahun_anggaran.tahun as deskripsi'
        )->from($this->_table);
        //$this->db->where('tbl_rp_rpjmd.id_rpjmd !=', 0);
        //$this->db->join('tbl_rp_rpjmd as a1','a1.id_parent_rpjmd = tbl_rp_rpjmd.id_rpjmd', 'left');
        $this->db->join('ref_rp_tahun_anggaran', 'ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmd.id_tahun_anggaran', 'left');
        $this->db->where('tbl_rp_rpjmd.id_parent_rpjmd', null);
        $this->db->order_by('tbl_rp_rpjmd.id_parent_rpjmd ', null);
        $this->db->group_by('tbl_rp_rpjmd.id_rpjmd ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(tbl_rp_rpjmd.id_rpjmd) as record_count")->from($this->_table);
        $this->db->where('tbl_rp_rpjmd.id_parent_rpjmd', null);
        $this->db->order_by('tbl_rp_rpjmd.id_parent_rpjmd ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    public function getRpjmdFlexigridByIdRpjmd($id) {
        //Build contents query
        $this->db->select(
                'tbl_rp_rpjmd.id_rpjmd,
		tbl_rp_rpjmd.program,
		tbl_rp_rpjmd.kondisi_awal,
		tbl_rp_rpjmd.target,
		tbl_rp_rpjmd.id_parent_rpjmd,
		tbl_rp_rpjmd.id_top_rpjmd,
		tbl_rp_rpjmd.id_tahun_anggaran,
		ref_rp_tahun_anggaran.tahun as deskripsi'
        )->from($this->_table);
        $this->db->where('tbl_rp_rpjmd.id_rpjmd', $id);
        $this->db->or_where('tbl_rp_rpjmd.id_top_rpjmd', $id);
        //$this->db->where('tbl_rp_rpjmd.id_rpjmd !=', 0);
        $this->db->join('ref_rp_tahun_anggaran', 'ref_rp_tahun_anggaran.id_tahun_anggaran = tbl_rp_rpjmd.id_tahun_anggaran', 'left');
        //$this->db->where('tbl_rp_rpjmd.id_parent_rpjmd', null);
        $this->db->order_by('tbl_rp_rpjmd.id_parent_rpjmd ', null);
        $this->db->group_by('tbl_rp_rpjmd.id_rpjmd ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_rpjmd) as record_count")->from($this->_table);
        $this->db->where('tbl_rp_rpjmd.id_rpjmd', $id);
        $this->db->or_where('tbl_rp_rpjmd.id_top_rpjmd', $id);
        $this->db->where('tbl_rp_rpjmd.id_rpjmd !=', 0);

        //$this->db->where('id_parent_rpjmd ', null);
        //$this->db->order_by('tbl_rp_rpjmd.id_parent_rpjmd ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    function insertRpjmd($data) {
        $this->db->insert($this->_table, $data);
    }

    function deleteRpjmd($id) {
        $this->db->where('id_rpjmd', $id);
        $this->db->delete($this->_table);
    }

    function getRpjmdByIdRpjmd($id) { //edit
        return $this->db->get_where($this->_table, array('id_rpjmd' => $id))->row();
    }

    function updateRpjmd($where, $data) { //update
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    function cekFIleExist($program) {
        return $this->db->get_where($this->_table, array('program' => $program))->row();
    }

    function getRowRpjmd_ByIdRpjmd($id_rpjmd) {
        $this->db->select('*');
        $this->db->where('id_rpjmd', $id_rpjmd);
        $query = $this->db->get('tbl_rp_rpjmd');
        return $query->row();
    }

    function getResult_RpjmdByIdRpjmd($id) {
        $this->db->select('
		tbl_rp_rpjmd.id_rpjmd,
		tbl_rp_rpjmd.program,
		tbl_rp_rpjmd.kondisi_awal,
		tbl_rp_rpjmd.target,
		tbl_rp_rpjmd.id_parent_rpjmd,
		tbl_rp_rpjmd.id_top_rpjmd,
		tbl_rp_rpjmd.id_tahun_anggaran,
		');
        $this->db->where('tbl_rp_rpjmd.id_parent_rpjmd', null);
        $this->db->where('tbl_rp_rpjmd.id_rpjmd', $id);
        $this->db->or_where('tbl_rp_rpjmd.id_top_rpjmd', $id);
        $q = $this->db->get('tbl_rp_rpjmd');
        return $q->result();
    }

    function getNumRowRpjmd_ByIdRpjmd($id) {
        $this->db->select('
		tbl_rp_rpjmd.id_rpjmd,
		tbl_rp_rpjmd.program,
		tbl_rp_rpjmd.kondisi_awal,
		tbl_rp_rpjmd.target,
		tbl_rp_rpjmd.id_parent_rpjmd,
		tbl_rp_rpjmd.id_top_rpjmd,
		tbl_rp_rpjmd.id_tahun_anggaran,
		');
        $this->db->where('tbl_rp_rpjmd.id_parent_rpjmd', null);
        $this->db->where('tbl_rp_rpjmd.id_rpjmd', $id);
        $this->db->or_where('tbl_rp_rpjmd.id_top_rpjmd', $id);
        $q = $this->db->get('tbl_rp_rpjmd');
        return $q->num_rows();
    }

    function getIdParentRpjmd_ByIdParentRpjmd($id_parent_rpjmd) {
        $this->db->select('id_parent_rpjmd');
        $this->db->where('id_parent_rpjmd', $id_parent_rpjmd);
        $q = $this->db->get('tbl_rp_rpjmd');
        $data = array_shift($q->result_array());
        return ($data['id_parent_rpjmd']);
    }

    function getIdTopRpjmd_ByIdRpjmd($id_rpjmd) {
        $this->db->select('id_top_rpjmd');
        $this->db->where('id_rpjmd', $id_rpjmd);
        $q = $this->db->get('tbl_rp_rpjmd');
        $data = array_shift($q->result_array());
        return ($data['id_top_rpjmd']);
    }

    function getIdRpjmd_ByIdRpjmd($id_rpjmd) {
        $this->db->select('id_rpjmd');
        $this->db->where('id_rpjmd', $id_rpjmd);
        $q = $this->db->get('tbl_rp_rpjmd');
        $data = array_shift($q->result_array());
        return ($data['id_rpjmd']);
    }

    function getProgram_ByIdRpjmd($id_rpjmd) {
        $this->db->select('program');
        $this->db->where('id_rpjmd', $id_rpjmd);
        $q = $this->db->get('tbl_rp_rpjmd');
        $data = array_shift($q->result_array());
        return ($data['program']);
    }

    function get_tahun_anggaran() {
        $this->db->where('id_tahun_anggaran !=', '0');
        $this->db->order_by('tahun', 'asc');
        $records = $this->db->get('ref_rp_tahun_anggaran');
        $data = array();
        foreach ($records->result() as $row) {
            $data[''] = '--Pilih--';
            $data[$row->id_tahun_anggaran] = $row->tahun;
        }
        return ($data);
    }

    public function get_program() {
        $this->db->select('
		*
		');
        $this->db->where('id_parent_rpjmd', null);
        $q = $this->db->get('tbl_rp_rpjmd');
        $q->result();
        //example -> //$query = $this->db->get_where('categories', array('category_id_parent' => 0));
        //$q = $this->db->get_where('tbl_rp_rpjmd', array('id_parent_rpjmd' => 0));
        if ($q->num_rows() > 0):
            return $q;
        endif;
    }

    public function get_subprogram() {
        $this->db->select('
		*
		');
        $q = $this->db->get('tbl_rp_rpjmd');
        $query = $q->result();

        foreach ($query as $row) {
            $id_rpjmd = $row->id_rpjmd;
            if ($id_rpjmd == TRUE) {
                $this->db->from('tbl_rp_rpjmd');
                $this->db->where('id_parent_rpjmd', $id_rpjmd);
                $query = $this->db->get();
                return $query;
            } else
                return TRUE;
        }
    }

    public function get_FirstParent() {//dont have child
        $this->db->select('
		program
		');
        $this->db->where('id_parent_rpjmd', null);
        $q = $this->db->get('tbl_rp_rpjmd');
        $q->result();
    }

    /* GetParent()//get All parent have child
      GetChild(parent id)// get list of child from parent
     */

    function getTreeview() {
        $query = $this->db->get('tbl_rp_rpjmd');
        return $query->result_array();
    }

    function getProgram() {
        $query = $this->db->query("SELECT * FROM tbl_rp_rpjmd");
        $result = $query->result_array();
        $count = count($result);
        if (!empty($count)) {
            return $result;
        }
    }

    function getSubProgram() {
        $query = $this->db->query("SELECT * FROM tbl_rp_rpjmd");
        $result = $query->result_array();
        $count = count($result);
        if (!empty($count)) {
            return $result;
        }
    }

}

?>