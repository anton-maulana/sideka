<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_master_apbdes extends CI_Model {

    private $ci;
    private $_table = 'tbl_rp_m_apbdes';
    public $_primary_key = 'id_m_apbdes';
    public $array_total_bidang = array();
    public $form_field_names = array(
        'id_m_rkp',
        'tanggal_disetujui',
        'disetujui_oleh'
    );
    public $post_data = array();

    function __construct() {
        parent::__construct();
        $this->ci = get_instance();

        $this->ci->config->load('rp_apb_desa');
        $this->array_total_bidang = $this->ci->config->item('array_total_top_coa');
    }

    public function getDataMasterApbdesTable(){
      $this->_setSelectAndJoin();
      $this->db->from($this->_table);
      $query = $this->db->get();
      return $query->result();
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
        $query = $this->db->get_where($this->_table, array($this->_table . "." . $this->_primary_key => $id));

//        echo $this->db->last_query();exit;
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
            if (array_key_exists('tanggal_disetujui', $this->post_data) && $this->post_data['tanggal_disetujui'] && $this->post_data['tanggal_disetujui'] != '') {
                $this->post_data['tanggal_disetujui'] = sideka_format_date($this->post_data['tanggal_disetujui']);
            }

            $this->db->trans_off();

            $this->db->trans_begin();
            $this->db->trans_strict(FALSE);

            $id = $id;
            if ($id) {

//                var_dump($this->post_data);exit;
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
        $select = $this->_table . '.' . $this->_primary_key . ', ' .
                $this->_table . '.id_m_rkp, ' .
                'tbl_rp_m_rkp.rkp_tahun, ' .
                $this->_table . '.total_pendapatan, ' .
                $this->_table . '.total_belanja, ' .
                $this->_table . '.total_pembiayaan, ' .
                $this->_table . '.tanggal_disetujui, ' .
                $this->_table . '.disetujui_oleh, ' .
                'ref_desa.nama_desa, ' .
                'ref_kecamatan.nama_kecamatan, ' .
                'ref_kab_kota.nama_kab_kota, ' .
                'ref_provinsi.nama_provinsi ';

        $this->db->select($select);

        $this->db->join('tbl_rp_m_rkp', 'tbl_rp_m_rkp.id_m_rkp = ' . $this->_table . '.' . $this->_primary_key);
        $this->db->join('tbl_rp_m_rancangan_rpjm_desa', 'tbl_rp_m_rancangan_rpjm_desa.id_m_rancangan_rpjm_desa = tbl_rp_m_rkp.id_m_rancangan_rpjm_desa');
        $this->db->join('ref_desa', 'ref_desa.id_desa = tbl_rp_m_rancangan_rpjm_desa.id_desa');
        $this->db->join('ref_kecamatan', 'ref_kecamatan.id_kecamatan = tbl_rp_m_rancangan_rpjm_desa.id_kecamatan');
        $this->db->join('ref_kab_kota', 'ref_kab_kota.id_kab_kota = tbl_rp_m_rancangan_rpjm_desa.id_kab_kota');
        $this->db->join('ref_provinsi', 'ref_provinsi.id_provinsi = tbl_rp_m_rancangan_rpjm_desa.id_provinsi');
    }

    public function setSubTotal($id_m_apbdes = FALSE, $id_top_coa = FALSE, $sub_total = NULL) {
        if ($id_m_apbdes) {

            $selected_field_name = NULL;
            if ($id_top_coa) {

                $this->load->model('rencanaPembangunan/m_coa');
                $arr_id_top_coa = $this->m_coa->getIdFromConfig('rp_apb_desa', 'array_total_top_coa');

                $this->array_total_bidang = array_combine($arr_id_top_coa, array_values($this->array_total_bidang));
//                unset($arr_id_top_coa);

                $data = array(
                    $this->array_total_bidang[$id_top_coa] => $sub_total
                );

                $selected_field_name = $this->array_total_bidang[$id_top_coa];
            }

            $this->update($data, $id_m_apbdes);
            return TRUE;
        }

        return FALSE;
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
        $this->db->join('tbl_rp_m_rkp', 'tbl_rp_m_rkp.id_m_rkp = ' . $this->_table . '.' . $this->_primary_key);
        $this->db->select("count(" . $this->_table . "." . $this->_primary_key . ") as record_count")->from($this->_table);

        $this->ci->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

}
