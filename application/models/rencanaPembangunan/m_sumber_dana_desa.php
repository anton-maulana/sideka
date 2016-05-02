<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_sumber_dana_desa extends CI_Model {

    private $ci;
    private $_table = 'ref_rp_sumber_dana_desa';
    
    public $_primary_key = 'id_sumber_dana_desa';
    
    public $form_field_names = array(
        'deskripsi',
        'keyword'
    );
    public $post_data = array();

    function __construct() {
        parent::__construct();
        $this->ci = get_instance();

    }

    private function _resetPostData() {
        $this->post_data = array();
    }

    public function getPostData() {
        $this->_resetPostData();
        foreach ($this->form_field_names as $key => $field_name) {
            $this->post_data[$field_name] = addslashes($this->input->post($field_name));
        }
        return;
    }

    public function getDetail($id = FALSE, $returnArray = FALSE) {
        if (!$id) {
            return FALSE;
        }
        $this->_setSelectAndJoin();
        $query = $this->db->get_where($this->_table, array($this->_table.".".$this->_primary_key => $id));

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
        $this->db->where($this->_table . '.'.$this->_primary_key, $id);
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

    private function _setSelectAndJoin() {
        $select = $this->_table . '.'.$this->_primary_key.', ' .
                $this->_table . '.deskripsi, ' .
                $this->_table . '.keyword ';

        $this->db->select($select);
    }

    function getArray() {

        $this->_setSelectAndJoin();

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

    public function getFlexigrid() {
        //Build contents query

        $this->_setSelectAndJoin();

        $this->db->from($this->_table);
        //$this->db->where('tbl_rp_rpjmd.id_rpjmd !=', 0);
        //$this->db->join('tbl_rp_rpjmd as a1','a1.id_parent_rpjmd = tbl_rp_rpjmd.id_rpjmd', 'left');
        $this->ci->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(" . $this->_table . ".".$this->_primary_key.") as record_count")->from($this->_table);

        $this->ci->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
    
    function getForInputSelect($keyword = '') {

        $select = $this->_table . ".".$this->_primary_key." as id, " .
                $this->_table . ".keyword as slug, " .
                $this->_table . ".deskripsi as text";

        $this->db->select($select, FALSE);
        $where = "deskripsi LIKE '%" . addslashes($keyword) . "%' or keyword LIKE '%" . addslashes($keyword) . "%' ";

        $this->db->where($where);
        $query = $this->db->get($this->_table);

        if ($query) {
            return $query->result();
        }

        return array();
    }

}
