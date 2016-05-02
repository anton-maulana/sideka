<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_master_rkp extends CI_Model {

    private $ci;
    private $_table = 'tbl_rp_m_rkp';
    public $_primary_key = 'id_m_rkp';
    public $form_field_names = array(
        'id_m_rancangan_rpjm_desa',
        'rkp_tahun',
        'kepala_desa',
        'disusun_oleh',
        'tanggal_disusun',
    );
    public $post_data = array();
    public $array_total_bidang = array();

    function __construct() {
        parent::__construct();
        $this->ci = get_instance();

        $this->ci->config->load('rp_rancangan_rpjm_desa');
        $this->array_total_bidang = $this->ci->config->item('array_total_bidang');
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

    public function getDetail($id_m_rkp = FALSE, $returnArray = FALSE) {
        if (!$id_m_rkp) {
            return FALSE;
        }
        $this->_setSelectAndJoin();
        $query = $this->db->get_where($this->_table, array($this->_table . '.id_m_rkp' => $id_m_rkp));

        $detail = FALSE;
        if ($returnArray) {
            $detail = $query->row_array();

            if (!empty($detail)) {
                $detail["tanggal_disusun"] = sideka_format_date($detail["tanggal_disusun"], FALSE);
            }
        } else {
            $detail = $query->row();

            if ($detail) {
                $detail->tanggal_disusun = sideka_format_date($detail->tanggal_disusun, FALSE);
            }
        }
        return $detail;
    }

    public function isIdValid($id_m_rkp = FALSE) {
        $is_valid = FALSE;
        if ($id_m_rkp) {
            $detail = $this->getDetail($id_m_rkp);

            $is_valid = $detail != FALSE ? TRUE : FALSE;
            unset($detail);

            /**
             * ToDo : check wali data
             */
        }

        return $is_valid;
    }

    public function setSubTotal($id_m_rkp = FALSE, $id_bidang = FALSE, $sub_total = NULL) {
        if ($id_m_rkp) {

            $detail = $this->getDetail($id_m_rkp);
            $selected_field_name = NULL;
            if ($id_bidang) {
                $this->load->model('rencanaPembangunan/m_coa');
                $arr_id_bidang = $this->m_coa->getIdFromConfig();

                $this->array_total_bidang = array_combine($arr_id_bidang, array_values($this->array_total_bidang));
                unset($arr_id_bidang);

                $data = array(
                    $this->array_total_bidang[$id_bidang] => $sub_total
                );



                $selected_field_name = $this->array_total_bidang[$id_bidang];
            }

            if ($detail) {
                $data["total_keseluruhan"] = 0;


                foreach ($this->array_total_bidang as $key => $field_name) {
                    if (!$id_bidang || $selected_field_name != $field_name) {
                        $data["total_keseluruhan"] += intval($detail->{$field_name});
                    }
                }
                if ($id_bidang) {
                    $data["total_keseluruhan"] += $data[$selected_field_name];
                }
            }


            unset($detail);

            $this->update($data, $id_m_rkp);
            return TRUE;
        }

        return FALSE;
    }

    public function update($data, $id) {
        $this->db->where($this->_table . '.id_m_rkp', $id);
        $this->db->update($this->_table, $data);
    }

    public function save($id_m_rkp = FALSE) {
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
            "inserted_id" => $id_m_rkp,
            "error_number" => "0"
        );

        /**
         * @todo kasih validasi disini
         */
        if (count($this->post_data) > 0) {

            if (array_key_exists('tanggal_disusun', $this->post_data) && $this->post_data['tanggal_disusun'] && $this->post_data['tanggal_disusun'] != '') {
                $this->post_data['tanggal_disusun'] = sideka_format_date($this->post_data['tanggal_disusun']);
            }

            $this->db->trans_off();

            $this->db->trans_begin();
            $this->db->trans_strict(FALSE);
            if ($id_m_rkp) {
                $response["error_message"] = "Perubahan ";
                $response["error_number"] = "1.2";

                $this->update($this->post_data, $id_m_rkp);
            } else {
                $response["error_message"] = "Data baru ";
                $response["error_number"] = "1.1";

                $this->db->insert($this->_table, $this->post_data);
                $response["inserted_id"] = $this->db->insert_id();
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
        $select = $this->_table . '.id_m_rkp, ' .
                $this->_table . '.id_m_rancangan_rpjm_desa, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_awal, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_akhir, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_anggaran, ' .
                $this->_table . '.total_bidang_1, ' .
                $this->_table . '.total_bidang_2, ' .
                $this->_table . '.total_bidang_3, ' .
                $this->_table . '.total_bidang_4, ' .
                $this->_table . '.total_keseluruhan, ' .
                $this->_table . '.rkp_tahun, ' .
                $this->_table . '.tanggal_disusun, ' .
                $this->_table . '.disusun_oleh, ' .
                $this->_table . '.kepala_desa, ' .
                'tbl_rp_m_rancangan_rpjm_desa.id_desa, ' .
                'tbl_rp_m_rancangan_rpjm_desa.id_kecamatan, ' .
                'tbl_rp_m_rancangan_rpjm_desa.id_kab_kota, ' .
                'tbl_rp_m_rancangan_rpjm_desa.id_provinsi, ' .
                'ref_desa.nama_desa, ' .
                'ref_kecamatan.nama_kecamatan, ' .
                'ref_kab_kota.nama_kab_kota, ' .
                'ref_provinsi.nama_provinsi ';

        $this->db->select($select);

        $this->_join();
    }

    private function _join() {
        $this->db->join('tbl_rp_m_rancangan_rpjm_desa', 'tbl_rp_m_rancangan_rpjm_desa.id_m_rancangan_rpjm_desa = ' . $this->_table . '.id_m_rancangan_rpjm_desa');
        $this->db->join('ref_desa', 'ref_desa.id_desa = tbl_rp_m_rancangan_rpjm_desa.id_desa');
        $this->db->join('ref_kecamatan', 'ref_kecamatan.id_kecamatan = tbl_rp_m_rancangan_rpjm_desa.id_kecamatan');
        $this->db->join('ref_kab_kota', 'ref_kab_kota.id_kab_kota = tbl_rp_m_rancangan_rpjm_desa.id_kab_kota');
        $this->db->join('ref_provinsi', 'ref_provinsi.id_provinsi = tbl_rp_m_rancangan_rpjm_desa.id_provinsi');
    }

    function getArray($from_year = FALSE, $to_year = FALSE, $default_value = FALSE) {
        if (!$from_year) {
            $from_year = date('Y');
        }
        if (!$to_year) {
            $to_year = $from_year + 7;
        }

        $this->_setSelectAndJoin();

        $this->db->where($this->_table . '.rkp_tahun >= ' . $from_year);
        $this->db->where($this->_table . '.rkp_tahun <= ' . $to_year);

        $q = $this->db->get($this->_table);
        $rs = FALSE;
        if ($q) {
            $rs = $q->result_array();
        }

        $arr_result = $default_value;
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
        $this->db->select("count(" . $this->_table . "." . $this->_primary_key . ") as record_count")->from($this->_table);
        $this->_join();
        $this->ci->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

}
