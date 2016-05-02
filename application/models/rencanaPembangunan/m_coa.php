<?php

class M_coa extends CI_Model {

    private $_table = 'ref_rp_coa';
    public $_primary_key = 'id_coa';

    function __construct() {
        parent::__construct();
        $this->_table = 'ref_rp_coa';
        //get instance
        $this->CI = get_instance();
    }

    public function get_coa_flexigrid() {
        //Build contents query
        $this->db->select(
                'ref_rp_coa.id_coa,
		ref_rp_coa.kode_rekening,
		ref_rp_coa.deskripsi,
		ref_rp_coa.id_parent_coa,
		ref_rp_coa.id_top_coa,
		ref_rp_coa.level
		'
        )->from($this->_table);
        $this->db->where('ref_rp_coa.id_parent_coa', null);
        $this->db->order_by('ref_rp_coa.id_parent_coa ', null);
        $this->db->group_by('ref_rp_coa.id_coa ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(ref_rp_coa.id_coa) as record_count")->from($this->_table);
        $this->db->where('ref_rp_coa.id_parent_coa', null);
        $this->db->order_by('ref_rp_coa.id_parent_coa ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    public function get_coa_flexigrid_byIdCoa($id) {
        //Build contents query
        $this->db->select(
                'ref_rp_coa.id_coa,
		ref_rp_coa.kode_rekening,
		ref_rp_coa.deskripsi,
		ref_rp_coa.id_parent_coa,
		ref_rp_coa.id_top_coa,
		ref_rp_coa.level
		'
        )->from($this->_table);
        $this->db->where('ref_rp_coa.id_coa', $id);
        $this->db->or_where('ref_rp_coa.id_top_coa', $id);
//        $this->db->order_by('ref_rp_coa.id_parent_coa ', null);
        $this->db->order_by('ref_rp_coa.kode_rekening ', null);
        $this->db->group_by('ref_rp_coa.id_coa ', null);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_coa) as record_count")->from($this->_table);
        $this->db->where('ref_rp_coa.id_coa', $id);
        $this->db->or_where('ref_rp_coa.id_top_coa', $id);
        $this->db->where('ref_rp_coa.id_coa !=', 0);

        //$this->db->where('id_parent_coa ', null);
        //$this->db->order_by('ref_rp_coa.id_parent_coa ', null);

        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    function insertCoa($data) {
        $this->db->insert($this->_table, $data);
    }

    function deleteCoa($id) {
        $this->db->where('id_coa', $id);
        $this->db->delete($this->_table);
    }

    function getCoaByIdCoa($id) { //edit
        return $this->db->get_where($this->_table, array('id_coa' => $id))->row();
    }

    function updateCoa($where, $data) { //update
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    function cekFIleExist($kode_rekening) {
        return $this->db->get_where($this->_table, array('kode_rekening' => $kode_rekening))->row();
    }

    function getRowCoa_ByIdCoa($id_coa) {
        $this->db->select('*');
        $this->db->where('id_coa', $id_coa);
        $query = $this->db->get('ref_rp_coa');
        return $query->row();
    }

    function getResult_CoaByIdCoa($id) {
        $this->db->select('
		ref_rp_coa.id_coa,
		ref_rp_coa.kode_rekening,
		ref_rp_coa.kondisi_awal,
		ref_rp_coa.target,
		ref_rp_coa.id_parent_coa,
		ref_rp_coa.id_top_coa,
		ref_rp_coa.id_tahun_anggaran,
		');
        $this->db->where('ref_rp_coa.id_parent_coa', null);
        $this->db->where('ref_rp_coa.id_coa', $id);
        $this->db->or_where('ref_rp_coa.id_top_coa', $id);
        $q = $this->db->get('ref_rp_coa');
        return $q->result();
    }

    function getNumRowCoa_ByIdCoa($id) {
        $this->db->select('
		ref_rp_coa.id_coa,
		ref_rp_coa.kode_rekening,
		ref_rp_coa.kondisi_awal,
		ref_rp_coa.target,
		ref_rp_coa.id_parent_coa,
		ref_rp_coa.id_top_coa,
		ref_rp_coa.id_tahun_anggaran,
		');
        $this->db->where('ref_rp_coa.id_parent_coa', null);
        $this->db->where('ref_rp_coa.id_coa', $id);
        $this->db->or_where('ref_rp_coa.id_top_coa', $id);
        $q = $this->db->get('ref_rp_coa');
        return $q->num_rows();
    }

    function getIdParentCoa_ByIdParentCoa($id_parent_coa) {
        $this->db->select('id_parent_coa');
        $this->db->where('id_parent_coa', $id_parent_coa);
        $q = $this->db->get('ref_rp_coa');
        $data = array_shift($q->result_array());
        return ($data['id_parent_coa']);
    }

    function getIdTopCoa_ByIdCoa($id_coa) {
        $this->db->select('id_top_coa');
        $this->db->where('id_coa', $id_coa);
        $q = $this->db->get('ref_rp_coa');
        $data = array_shift($q->result_array());
        return ($data['id_top_coa']);
    }

    function getIdCoa_ByIdCoa($id_coa) {
        $this->db->select('id_coa');
        $this->db->where('id_coa', $id_coa);
        $q = $this->db->get('ref_rp_coa');
        $data = array_shift($q->result_array());
        return ($data['id_coa']);
    }

    function getKodeRekening_ByIdCoa($id_coa) {
        $this->db->select('kode_rekening');
        $this->db->where('id_coa', $id_coa);
        $q = $this->db->get('ref_rp_coa');
        $data = array_shift($q->result_array());
        return ($data['kode_rekening']);
    }

    function getDeskripsi_ByIdCoa($id_coa) {
        $this->db->select('deskripsi');
        if (is_array($id_coa)) {
            $this->db->where_in('id_coa', $id_coa);
        } else {
            $this->db->where('id_coa', $id_coa);
        }
        $q = $this->db->get('ref_rp_coa');
        $data = array();
        $data_found = array();
        if (is_array($id_coa) && $q) {
            $data_found = $q->result();
        } elseif ($q) {
            $data = array_shift($q->result_array());
            $data_found = ($data['deskripsi']);
        }
        unset($data);
        return $data_found;
    }

    function getId_ByIdCoa($id_coa) {
        $this->db->select('id_coa');
        $this->db->where('id_coa', $id_coa);
        $q = $this->db->get('ref_rp_coa');
        $data = array_shift($q->result_array());
        return ($data['id_coa']);
    }

    function getParentCoaByIdCoa($id_coa = FALSE, $level = FALSE, $only_id = FALSE) {
        $parent_found = FALSE;
        if ($id_coa) {
            $this->db->where($this->_table . '.id_coa', $id_coa);
            $q = $this->db->get($this->_table);
            if ($q) {
                $self_detail = $q->row();

                $parent_found = $self_detail;
                if ($only_id) {
                    $parent_found = $self_detail->id_coa;
                }
                if ($level && $self_detail->level != $level) {
                    $parent_found = $this->getParentCoaByIdCoa($self_detail->id_parent_coa, $level, $only_id);
                }
                unset($self_detail);
            }
        }
        return $parent_found;
    }

    function getDeskripsiBidangFromConfig() {
        $id_coa = $this->getIdFromConfig();
        
        $this->db->where_in($this->_primary_key, $id_coa);
        $q = $this->db->get($this->_table);
        $result_set = array();
        if($q){
            $rs = $q->result();
            foreach($rs as $record){
                $result_set[$record->id_coa] = $record->deskripsi;
            }
            
            unset($rs);
        }
        return $result_set;
    }

    function getIdFromConfig($config_name = 'rp_rancangan_rpjm_desa', $config_item = 'array_total_bidang') {
        $this->config->load($config_name);
        $array_total_bidang = $this->config->item($config_item);

        $where_coa = array();
        foreach (array_keys($array_total_bidang) as $kode_rekening) {
            $where_coa[] = "kode_rekening = '" . $kode_rekening . "'";
        }

        return $this->getId(implode(" or ", $where_coa));
    }

    /**
     * @return Array array of keys
     * @param type $where
     */
    function getId($where = FALSE) {

        if ($where) {
            $this->db->where($where);
        }

        $arr_key = array();
        $q = $this->db->get($this->_table);
        if ($q) {
            $rs = $q->result();

            foreach ($rs as $key => $record) {
                $arr_key[] = $record->id_coa;
            }
            unset($rs);
        }
        return $arr_key;
    }

    function getCoaForInputSelect($keyword = '', $additional_where = FALSE, $where_id_coa = FALSE, $is_rpjm_desa = FALSE) {

        $select = $this->_table . ".id_coa as id, " .
                "CONCAT(" . $this->_table . ".kode_rekening, ' - ', " . $this->_table . ".deskripsi) as text";

        $this->db->select($select, FALSE);
        $where = "level >= 3 and (deskripsi LIKE '%" . addslashes($keyword) . "%' or kode_rekening LIKE '%" . addslashes($keyword) . "%') ";
		
		if($is_rpjm_desa){
			$where .= "  and SUBSTR(kode_rekening,1,1) = '2' ";
		}

        if($additional_where){
            $this->db->where($additional_where);
        }
        
        if($where_id_coa){
            $where = 'id_coa = '.$where_id_coa;
        }
        
        $this->db->where($where);
        $query = $this->db->get($this->_table);

        if ($query) {
            return $query->result();
        }

        return array();
    }
    
    function getTopLevelCoa(){
        $this->db->where('id_parent_coa', NULL);
        $this->db->order_by('ref_rp_coa.kode_rekening ', null);
        $q = $this->db->get($this->_table);
        $rs = FALSE;
        if($q){
            $rs = $q->result();
        }
        return $rs;
    }

}

?>
