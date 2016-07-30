<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_rancangan_rpjm_desa extends CI_Model {

    private $ci;
    private $_table = 'tbl_rp_rancangan_rpjm_desa';
    private $_grouped = array();
    public $form_field_names = array(
        'id_bidang',
        'id_sub_bidang',
        'id_coa',
        'id_sumber_dana_desa',
        'id_m_rancangan_rpjm_desa',
//        'sub_bidang',
//        'jenis_kegiatan',
        'lokasi_rt_rw',
        'prakiraan_volume',
        'sasaran_manfaat',
        'tahun_pelaksanaan_1',
        'tahun_pelaksanaan_2',
        'tahun_pelaksanaan_3',
        'tahun_pelaksanaan_4',
        'tahun_pelaksanaan_5',
        'tahun_pelaksanaan_6',
        'jumlah_biaya',
        'sumber_dana',
        'swakelola',
        'kerjasama_antar_desa',
        'kerjasama_pihak_ketiga',
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

    function getDataRpjmTable($master_id){
      $this->_setSelectAndJoin();
      $this->db->from($this->_table);
      $this->db->where($this->_table . '.id_m_rancangan_rpjm_desa', $master_id);
      $query = $this->db->get();
      return $query->result();
    }

    public function calculateTahunPelaksanaan($tahun_awal) {
        for ($i = 1; $i <= 6; $i++) {
            $field_tahun_pelaksanaan = 'tahun_pelaksanaan_' . $i;

            if (array_key_exists($field_tahun_pelaksanaan, $this->post_data) && $this->post_data[$field_tahun_pelaksanaan] != '') {
                $this->post_data[$field_tahun_pelaksanaan] = $tahun_awal + ($i - 1);
            } else {
                $this->post_data[$field_tahun_pelaksanaan] = 0;
            }
        }
        unset($tahun_awal);
        return;
    }

    public function reCalculateSubTotal($id_m_rancangan_rpjm_desa = FALSE, $id_bidang = FALSE) {

        if ($id_bidang && $id_m_rancangan_rpjm_desa) {
            $this->db->select("sum(" . $this->_table . ".jumlah_biaya) as sub_total");
            $this->db->where($this->_table . ".id_m_rancangan_rpjm_desa = '" . $id_m_rancangan_rpjm_desa . "' and " . $this->_table . ".id_bidang = '" . $id_bidang . "'");
            $q = $this->db->get($this->_table);

            if ($q) {
                $res = $q->row();
                return $res->sub_total;
            }
        }
        return FALSE;
    }

    public function group_recordset_by_bidang($record, $group) {
        if ($record->id_bidang == $group) {
            $this->_grouped[$group][] = $record;
        }
    }

    private function _getByIdMasterRpjm($id_m_rancangan_rpjm_desa = FALSE, $tahun_pelaksanaan = FALSE) {
        if ($tahun_pelaksanaan) {
            $this->db->where($tahun_pelaksanaan);
        }

        $this->db->where($this->_table . '.id_m_rancangan_rpjm_desa = ' . $id_m_rancangan_rpjm_desa);

        $q = $this->db->get($this->_table);
        $rs = FALSE;
        if ($q) {
            $rs = $q->result();
        }

        return $rs;
    }

    public function getByIdMasterRpjm($id_m_rancangan_rpjm_desa = FALSE, $group_by_bidang = FALSE, $tahun_pelaksanaan = FALSE) {
        $this->_grouped = array();
        if ($id_m_rancangan_rpjm_desa) {


            if ($group_by_bidang) {

                $this->load->model('rencanaPembangunan/m_coa');

                $arr_id_bidang = $this->m_coa->getIdFromConfig();

                foreach ($arr_id_bidang as $id_bidang) {

                    $this->_setSelectAndJoin();
                    $this->db->where($this->_table . '.id_bidang = ' . $id_bidang);

                    if(!array_key_exists($id_bidang, $this->_grouped) || !is_array($this->_grouped[$id_bidang])){
                        $this->_grouped[$id_bidang] = array();
                    }

                    $this->_grouped[$id_bidang][] = $this->_getByIdMasterRpjm($id_m_rancangan_rpjm_desa, $tahun_pelaksanaan);

                }

                return $this->_grouped;
            }

            return $this->_getByIdMasterRpjm($id_m_rancangan_rpjm_desa, $tahun_pelaksanaan);
        }
        return FALSE;
    }

    public function getPostData($id_m_rancangan_rpjm_desa = FALSE) {
        if (!$id_m_rancangan_rpjm_desa) {
            $this->session->set_flashdata('id_master_not_found', TRUE);
            return FALSE;
        }

        $this->_resetPostData();

        $this->post_data['id_m_rancangan_rpjm_desa'] = $id_m_rancangan_rpjm_desa;

        foreach ($this->form_field_names as $key => $field_name) {
            if ($this->input->post($field_name)) {
                $this->post_data[$field_name] = addslashes($this->input->post($field_name));
            }
        }

        /* cek dan ambil id_coa untuk sub bidang dan bidang */
        if (array_key_exists('id_coa', $this->post_data) && $this->post_data['id_coa']) {
            $this->post_data['id_sub_bidang'] = $this->m_coa->getParentCoaByIdCoa($this->post_data['id_coa'], 3, TRUE);
            if ($this->post_data['id_sub_bidang']) {
                $this->post_data['id_bidang'] = $this->m_coa->getParentCoaByIdCoa($this->post_data['id_sub_bidang'], 2, TRUE);
            }else{
                return FALSE;
            }
        }

        return TRUE;
    }

    public function getDetail($id_rancangan_rpjm_desa = FALSE, $returnArray = FALSE) {
        if (!$id_rancangan_rpjm_desa) {
            return FALSE;
        }
        $this->_setSelectAndJoin();
        $query = $this->db->get_where($this->_table, array('id_rancangan_rpjm_desa' => $id_rancangan_rpjm_desa));

        $detail = FALSE;
        if ($returnArray) {
            $detail = $query->row_array();
        } else {
            $detail = $query->row();
        }
        return $detail;
    }

    public function save($id_rancangan_rpjm_desa = FALSE) {
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
            "inserted_id" => $id_rancangan_rpjm_desa,
            "error_number" => "0"
        );

        /**
         * @todo kasih validasi disini
         */
        if (count($this->post_data) > 0) {

            $this->db->trans_off();

            $this->db->trans_begin();
            $this->db->trans_strict(FALSE);

            if ($id_rancangan_rpjm_desa) {
                $response["error_message"] = "Perubahan ";
                $response["error_number"] = "1.2";

                if($this->post_data['swakelola']== null)$this->post_data['swakelola']=0;
                if($this->post_data['kerjasama_antar_desa']== null)$this->post_data['kerjasama_antar_desa']=0;
                if($this->post_data['kerjasama_pihak_ketiga']== null)$this->post_data['kerjasama_pihak_ketiga']=0;

                $this->db->where($this->_table . '.id_rancangan_rpjm_desa', $id_rancangan_rpjm_desa);
                $this->db->update($this->_table, $this->post_data);
            } else {
                $response["error_message"] = "Data baru ";
                $response["error_number"] = "1.1";

                $this->insert_data($this->post_data);

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

    public function _setSelectAndJoin() {

        $select = $this->_table . '.id_rancangan_rpjm_desa, ' .
                'ref_rp_coa_a.kode_rekening, ' .
                'ref_rp_coa_a.deskripsi as bidang, ' .
                'ref_rp_coa_b.deskripsi as sub_bidang, ' .
                'ref_rp_coa_c.deskripsi as jenis_kegiatan, ' .
                $this->_table . '.lokasi_rt_rw, ' .
                $this->_table . '.prakiraan_volume, ' .
                $this->_table . '.sasaran_manfaat, ' .
                $this->_table . '.tahun_pelaksanaan_1, ' .
                $this->_table . '.tahun_pelaksanaan_2, ' .
                $this->_table . '.tahun_pelaksanaan_3, ' .
                $this->_table . '.tahun_pelaksanaan_4, ' .
                $this->_table . '.tahun_pelaksanaan_5, ' .
                $this->_table . '.tahun_pelaksanaan_6, ' .
                $this->_table . '.jumlah_biaya, ' .
                $this->_table . '.swakelola, ' .
                $this->_table . '.kerjasama_antar_desa, ' .
                $this->_table . '.kerjasama_pihak_ketiga, ' .
                $this->_table . '.id_bidang, ' .
                $this->_table . '.id_coa, ' .
                'ref_rp_sumber_dana_desa.id_sumber_dana_desa, ' .
                'ref_rp_sumber_dana_desa.deskripsi as sumber_biaya, ' .
                'tbl_rp_m_rancangan_rpjm_desa.id_m_rancangan_rpjm_desa, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_awal, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_akhir, ' .
                'tbl_rp_m_rancangan_rpjm_desa.tahun_anggaran ';

        $this->db->select($select);
        $this->db->order_by("ref_rp_coa_a.kode_rekening", "asc");
        $this->db->order_by("ref_rp_coa_b.kode_rekening", "asc");
        $this->db->order_by("ref_rp_coa_c.kode_rekening", "asc");
        $this->setJoin();
    }

    public function setJoin() {
        /* ambil bidang */
        $this->db->join('ref_rp_coa ref_rp_coa_a', 'ref_rp_coa_a.id_coa = ' . $this->_table . '.id_bidang');
        /* ambil sub bidang */
        $this->db->join('ref_rp_coa ref_rp_coa_b', 'ref_rp_coa_b.id_coa = ' . $this->_table . '.id_sub_bidang');
        /* ambil jenis kegiatan */
        $this->db->join('ref_rp_coa ref_rp_coa_c', 'ref_rp_coa_c.id_coa = ' . $this->_table . '.id_coa');
        $this->db->join('tbl_rp_m_rancangan_rpjm_desa', 'tbl_rp_m_rancangan_rpjm_desa.id_m_rancangan_rpjm_desa = ' . $this->_table . '.id_m_rancangan_rpjm_desa');
        $this->db->join('ref_rp_sumber_dana_desa', 'ref_rp_sumber_dana_desa.id_sumber_dana_desa = ' . $this->_table . '.id_sumber_dana_desa');
    }

    public function getFlexigrid($master_id) {
        //Build contents query

        $this->_setSelectAndJoin();

        $this->db->from($this->_table);
        $this->db->where($this->_table . '.id_m_rancangan_rpjm_desa', $master_id);
        $this->ci->flexigrid->build_query(FALSE);

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(" . $this->_table . ".id_rancangan_rpjm_desa) as record_count")->from($this->_table);
        $this->db->where($this->_table . '.id_m_rancangan_rpjm_desa', $master_id);
        $this->setJoin();
//        $this->db->join('ref_rp_bidang', 'ref_rp_bidang.id_bidang = ' . $this->_table . '.id_bidang', 'left');
        $this->ci->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }

    public function insert_data($data = FALSE) {
        if ($data) {
            $this->db->insert($this->_table, $data);
        }
    }

}
