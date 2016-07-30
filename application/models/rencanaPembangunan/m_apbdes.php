<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_apbdes extends CI_Model {

    private $ci;
    private $_table = 'tbl_rp_apbdes';
    public $_primary_key = 'id_apbdes';
    public $form_field_names = array(
        'id_top_coa',
        'id_m_apbdes',
        'id_coa',
        'anggaran',
        'keterangan'
    );
    public $post_data = array();

    function __construct() {
        parent::__construct();
        $this->ci = get_instance();
    }

    private function _resetPostData() {
        $this->post_data = array();
    }

    function getDataApbdesTable($id_m_apbdes){
      $this->_setSelectAndJoin();
      $this->db->from($this->_table);
      $this->db->where($this->_table . '.id_m_apbdes', $id_m_apbdes);
      $query = $this->db->get();
      return $query->result();
    }

    public function getPostData($id_m_apbdes = FALSE) {
        if (!$id_m_apbdes) {
            $this->session->set_flashdata('id_master_not_found', TRUE);
            return FALSE;
        }

        $this->_resetPostData();

        $this->post_data['id_m_apbdes'] = $id_m_apbdes;

        foreach ($this->form_field_names as $key => $field_name) {
            if ($this->input->post($field_name)) {
                $this->post_data[$field_name] = addslashes($this->input->post($field_name));
            }else{
                if($field_name == 'keterangan'){
                    $this->post_data[$field_name] = '-';
                }
            }
        }

        return TRUE;
    }

    public function getDetail($id = FALSE, $returnArray = FALSE) {
        if (!$id) {
            return FALSE;
        }
        $this->_setSelectAndJoin();
        $query = $this->db->get_where($this->_table, array($this->_table . "." . $this->_primary_key => $id));

        $detail = FALSE;
        if ($returnArray) {
            $detail = $query->row_array();
        } else {
            $detail = $query->row();
        }
        return $detail;
    }

    public function isIdValid($id = FALSE) {
        $is_valid = FALSE;
        if ($id) {
            $detail = $this->getDetail($id);

            $is_valid = $detail != FALSE ? TRUE : FALSE;
            unset($detail);

            /**
             * ToDo : check wali data
             */
        }

        return $is_valid;
    }

    public function update($data, $id) {
        $this->db->where($this->_table . '.' . $this->_primary_key, $id);
        $this->db->update($this->_table, $data);
    }

    public function save($id = FALSE) {
        /**
         * Error Number :
         * 0 : tidak ada post data sama sekali
         * 1.1 : Sukses Insert data
         * 1.2 : Sukses Update data
         * 2 : data tidak valid
         */
        $response = array(
            "post_data" => $this->post_data,
            "error_message" => "Tidak ada data yang dikirim.",
            "inserted_id" => $id,
            "error_number" => "0"
        );

        /**
         * @todo kasih validasi disini
         */
        if (count($this->post_data) > 0) {

            $this->db->trans_off();

            $this->db->trans_begin();
            $this->db->trans_strict(FALSE);

            $id = $id;
            if ($id) {
                $response["error_message"] = "Perubahan ";
                $response["error_number"] = "1.2";

                $this->update($this->post_data, $id);


            } else {
                $response["error_message"] = "Data baru ";
                $response["error_number"] = "1.1";

                $this->db->insert($this->_table, $this->post_data);
                $response["inserted_id"] = $this->db->insert_id();

                $id = $response["inserted_id"];
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response["error_message"] .= "gagal dilakukan.";
                $response["error_number"] = "0";
                $this->db->trans_rollback();
            } else {
                $response["error_message"] .= "berhasil dilakukan.";
            }
            $this->db->trans_commit();
        }

        return $response;
    }

    private function __setSelect($additional_select = FALSE) {
        $select = $this->_table . '.' . $this->_primary_key . ', ' .
                $this->_table . '.id_m_apbdes, ' .
                $this->_table . '.id_top_coa, ' .
                $this->_table . '.id_coa, ' .
                $this->_table . '.anggaran, ' .
                $this->_table . '.keterangan';

        $this->db->select($select, FALSE);

        if ($additional_select && is_array($additional_select)) {
            $this->db->select($additional_select[0], $additional_select[1]);
        } elseif ($additional_select && !is_array($additional_select)) {
            $this->db->select($additional_select);
        }
    }

    private function _order_by_kode_rekening($table_coa_alias = 'ref_rp_coa_b') {
        $this->db->order_by($table_coa_alias . ".kode_rekening", "asc");
    }

    private function _setSelectAndJoin() {
        $select = 'ref_rp_coa_a.deskripsi as grup_coa, ' .
                'CONCAT(ref_rp_coa_b.kode_rekening, \' - \', ref_rp_coa_b.deskripsi) as kode_rekening ';

        $this->__setSelect(array($select, FALSE));

        $this->db->join('ref_rp_coa ref_rp_coa_a', 'ref_rp_coa_a.id_coa = ' . $this->_table . '.id_top_coa');
        $this->db->join('ref_rp_coa ref_rp_coa_b', 'ref_rp_coa_b.id_coa = ' . $this->_table . '.id_coa');

        $this->_order_by_kode_rekening();
    }

    function getArray() {

        $this->__setSelect();

        $q = $this->db->get($this->_table);
        $rs = FALSE;
        if ($q) {
            $rs = $q->result_array();
        }

        $arr_result = FALSE;
        if ($rs) {
            $arr_result = array();
            foreach ($rs as $record) {
                $arr_result[$record[$this->_primary_key]] = $record;
            }
        }
        return $arr_result;
    }

    public function reCalculateSubTotal($id_m_apbdes = FALSE, $id_top_coa = FALSE) {

        if ($id_top_coa && $id_m_apbdes) {
            $this->db->select("sum(" . $this->_table . ".anggaran) as sub_total");
            $this->db->where($this->_table . ".id_m_apbdes = '" . $id_m_apbdes . "' and " . $this->_table . ".id_top_coa = '" . $id_top_coa . "'");
            $q = $this->db->get($this->_table);

            if ($q) {
                $res = $q->row();
                return $res->sub_total;
            }
        }
        return FALSE;
    }

    public function getFlexigrid($id_m_apbdes) {
        //Build contents query

        $this->_setSelectAndJoin();

        $this->db->from($this->_table);
        //$this->db->where('tbl_rp_rpjmd.id_rpjmd !=', 0);
        //$this->db->join('tbl_rp_rpjmd as a1','a1.id_parent_rpjmd = tbl_rp_rpjmd.id_rpjmd', 'left');

        $this->db->where($this->_table . '.id_m_apbdes', $id_m_apbdes);
        $this->ci->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->join('ref_rp_coa ref_rp_coa_a', 'ref_rp_coa_a.id_coa = ' . $this->_table . '.id_top_coa');
        $this->db->join('ref_rp_coa ref_rp_coa_b', 'ref_rp_coa_b.id_coa = ' . $this->_table . '.id_coa');

        $this->db->where($this->_table . '.id_m_apbdes', $id_m_apbdes);

        $this->db->select("count(" . $this->_table . "." . $this->_primary_key . ") as record_count")->from($this->_table);

        $this->ci->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    public function getExcelRecordByIdMasterApbdes($id_m_apbdes = FALSE, $tahun_pelaksanaan = FALSE) {
        $grouped_apbdes_by_top_level_coa = FALSE;
        if ($id_m_apbdes) {

            $top_level_coa = $this->m_coa->getTopLevelCoa();

            if (!$top_level_coa) {
                return $grouped_apbdes_by_top_level_coa;
            }

            $grouped_apbdes_by_top_level_coa = array();

            if ($tahun_pelaksanaan) {
                $this->db->where($tahun_pelaksanaan);
            }

            foreach ($top_level_coa as $record_top_level_coa) {

                $select = 'node.kode_rekening, node.level, node.id_top_coa, node.deskripsi as group_coa, node.kode_rekening, CONCAT(node.kode_rekening, \' - \', node.deskripsi) as kode_rekening_deskripsi ';

                $this->__setSelect(array($select, FALSE));

                $this->_order_by_kode_rekening("node");

                $this->db->join("ref_rp_coa as parent", "parent.id_coa = node.id_parent_coa");
                $this->db->join($this->_table, $this->_table . ".id_coa = node.id_coa and " . $this->_table . ".id_m_apbdes = " . $id_m_apbdes . " and " . $this->_table . ".id_top_coa = '" . $record_top_level_coa->id_coa . "'", "left");

                $this->db->where('node.id_top_coa = ' . $record_top_level_coa->id_coa);

                $q = $this->db->get("ref_rp_coa as node");
                $rs = FALSE;
                if ($q) {
                    $rs = $q->result();

                    if ($rs) {
                        $grouped_apbdes_by_top_level_coa[$record_top_level_coa->id_coa] = $rs;
                    }
                    unset($rs, $q);
                }
            }
        }
        return $grouped_apbdes_by_top_level_coa;
    }

}
