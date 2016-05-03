<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . 'controllers/rencanaPembangunan/c_baseRencanaPembangunan.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class C_apbdes extends C_baseRencanaPembangunan {

    function __construct() {
        parent::__construct('APBDesa', 'v_rencanaPembangunan');
        $this->load->helper(array('flexigrid_helper', 'common_helper'));
        $this->config->load('rp_apb_desa');
        $this->load->model(array(
            'rencanaPembangunan/m_rancangan_rpjm_desa',
            'rencanaPembangunan/m_master_rkp',
            'rencanaPembangunan/m_apbdes',
            'rencanaPembangunan/m_master_apbdes',
            'rencanaPembangunan/m_rkp',
            'rencanaPembangunan/m_coa',
            'rencanaPembangunan/m_master_rancangan_rpjm_desa'));
    }

    function index() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;

        if ($role != 'Perencana Pembangunan') {
            redirect('c_login', 'refresh');
        }

        $r_m_apb_desa_config = $this->config->item('rp_master_apb_desa');

        $colModelM = $r_m_apb_desa_config['colModel'];
        $buttons = $r_m_apb_desa_config['buttons'];
        $gridParams = $r_m_apb_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_apbdes/load_data_master'), $colModelM, 'id_m_apbdes', 'desc', $gridParams, $buttons);

        $attention_message = $this->session->flashdata('attention_message');
        $this->set('attention_message', $attention_message);
        $this->set('js_grid', $grid_js);
        $this->set('deskripsi_title', '');
    }

    public function detail($id) {

        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;

        if ($role != 'Perencana Pembangunan') {
            redirect('c_login', 'refresh');
        }

        $r_m_rpjm_desa_config = $this->config->item('rp_apb_desa');

        $colModelM = $r_m_rpjm_desa_config['colModel'];
        $buttons = $r_m_rpjm_desa_config['buttons'];
        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_apbdes/load_data_detail/' . $id), $colModelM, 'id_coa', 'asc', $gridParams, $buttons);

        $attention_message = $this->session->flashdata('attention_message');
        $this->set('attention_message', $attention_message);
        $this->set('id_m_apbdes', $id);
        $this->set('js_grid', $grid_js);
        $this->set('deskripsi_title', 'Detail APBDesa');
    }

    public function load_data_detail($id_m_apbdes = FALSE) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_apbdes');

        $this->flexigrid->validate_post('id_apbdes', 'ASC', $valid_fields);
        $records = $this->m_apbdes->getFlexigrid($id_m_apbdes);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        if ($records['records']) {
            foreach ($records['records']->result() as $row) {
                $record_items[] = array(
                    $row->id_apbdes,
                    $row->id_apbdes,
                    $row->id_m_apbdes,
                    $row->id_coa,
                    $row->kode_rekening,
                    rupiah_display($row->anggaran),
                    $row->keterangan,
                    '<a  title="Ubah Data" href="' . base_url() . 'rencanaPembangunan/c_apbdes/add_detail/' . $id_m_apbdes . '/' . $row->id_apbdes . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>&nbsp;'
                );
            }
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    public function load_data_master() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_m_apbdes');

        $this->flexigrid->validate_post('id_m_apbdes', 'ASC', $valid_fields);
        $records = $this->m_master_apbdes->getFlexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_m_apbdes,
                $row->id_m_apbdes,
                $row->id_m_rkp,
                $row->rkp_tahun,
                rupiah_display($row->total_pendapatan),
                rupiah_display($row->total_belanja),
                rupiah_display($row->total_pembiayaan),
                $row->tanggal_disetujui,
                $row->disetujui_oleh,
                '<button id="anchor_detail_' . $row->id_m_apbdes . '" type="button" class="btn btn-primary btn-xs btn_add_detail" onclick="add_detail(this);" title="Tambah Detail APB Desa" />' .
                '<i class="fa fa-plus"></i>' .
                '</button>&nbsp;' .
                '<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil APB Desa" onclick="show_detail_program(\'' . $row->id_m_apbdes . '\')"/>' .
                '<i class="fa fa-list-alt"></i>' .
                '</button>&nbsp;' .
                '<a  title="Ubah Data" href="' . base_url() . 'rencanaPembangunan/c_apbdes/add/' . $row->id_m_apbdes . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>&nbsp;' .
                '<a  title="Download Excel" href="' . base_url() . 'rencanaPembangunan/c_apbdes/export_excel/' . $row->id_m_apbdes . '" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function add($id_m_apbdes = FALSE) {
        $master_rkp = $this->m_master_rkp->getArray(2016, 2089, array());
//        $master_rkp = $this->m_master_rkp->getArray(date('Y') - 2, FALSE, array());
        
        $post_data = array();
        $attention_message = "";
        if (count($_POST) > 0) {
            $this->m_master_apbdes->getPostData();
            $response = $this->m_master_apbdes->save($id_m_apbdes);
            $attention_message = $response["message_error"];
            if ($response["error_number"] != '0' && $id_m_apbdes) {
                redirect('rencanaPembangunan/c_apbdes');
            } elseif ($response["error_number"] != '0' && !$id_m_apbdes) {
                redirect('rencanaPembangunan/c_apbdes/add_detail');
            }
            $post_data = $response["post_data"];
        } elseif (count($_POST) == 0 && $id_m_apbdes) {
            $post_data = $this->m_master_apbdes->getDetail($id_m_apbdes, TRUE);

            if (!$post_data || empty($post_data)) {
                $this->session->set_flashdata('attention_message', 'Maaf, Data tidak ditemukan.');
                redirect('rencanaPembangunan/c_apbdes', 'refresh');
            }
        }

        $this->set('post_data', $post_data);
        $this->set('attention_message', $attention_message);
        $this->set('id_m_apbdes', $id_m_apbdes);
        $this->set('deskripsi_title', 'Tambah APBDES');

        $this->set('js_general_helper', $this->load->view('rencanaPembangunan/rancangan_rpjm_desa/js/general_helper', array(), TRUE));
        $this->set('master_rkp', $master_rkp);
    }

    function get_cost() {
        $id_bidang = $this->input->post('id_bidang');
        $id_rancangan_rpjm_desa = $this->input->post('id_rancangan_rpjm_desa');
//var_dump($id_bidang, $id_rancangan_rpjm_desa);exit;
        $rs = $this->m_rkp->sum_cost_by_id_bidang_and_id_rancangan_rpjm_desa($id_bidang, $id_rancangan_rpjm_desa);
        if ($rs) {
            echo $rs->total_jumlah_biaya;
        } else {
            echo '0';
        }
        exit;
    }

    function add_detail($id_m_apbdes = FALSE, $id_apbdes = FALSE) {
        $top_level_coa = $this->m_coa->getTopLevelCoa();
        $post_data = array();
        $attention_message = "";
        
        //fvar_dump($id_m_apbdes);exit;

        if (!$id_m_apbdes || !$this->m_master_apbdes->isIdValid($id_m_apbdes)) {
            $this->session->set_flashdata('attention_message', 'Maaf, APBDES tidak ditemukan.');
            redirect('rencanaPembangunan/c_apbdes', 'refresh');
        }

        $detail_master_rkp = $this->m_master_rkp->getDetail($id_m_apbdes);
        if (count($_POST) > 0 && $this->m_apbdes->getPostData($id_m_apbdes)) {

            $response = $this->m_apbdes->save($id_apbdes);

//            $this->m_master_apbdes->setSubTotal($id_m_apbdes);

            if ($response["error_number"] != '0') {
                $sub_total = $this->m_apbdes->reCalculateSubTotal($id_m_apbdes, $response["post_data"]["id_top_coa"]);
                if ($sub_total) {
                    $this->m_master_apbdes->setSubTotal($id_m_apbdes, $response["post_data"]["id_top_coa"], $sub_total);
                }
            }

            $attention_message = $response["message_error"];
            if ($response["error_number"] != '0' && $id_apbdes) {
                redirect('rencanaPembangunan/c_apbdes');
            } elseif ($response["error_number"] != '0' && !$id_apbdes) {
                redirect('rencanaPembangunan/c_apbdes/add_detail');
            }
            $post_data = $response["post_data"];
        } elseif (count($_POST) == 0 && $id_apbdes) {
            $post_data = $this->m_apbdes->getDetail($id_apbdes, TRUE);

            if (!$post_data || empty($post_data)) {
                $this->session->set_flashdata('attention_message', 'Maaf, Data tidak ditemukan.');
                redirect('rencanaPembangunan/c_apbdes', 'refresh');
            }
        }

        $id_master_not_found = $this->session->flashdata('id_master_not_found');
        if (empty($post_data) && $id_master_not_found) {
            $this->session->set_flashdata('attention_message', 'Maaf, Data tidak ditemukan.');
            redirect('rencanaPembangunan/c_apbdes', 'refresh');
        }

        $master_rpjm_desa = $this->m_master_rancangan_rpjm_desa->getDetail($detail_master_rkp->id_m_rancangan_rpjm_desa);
        $and_tahun_pelaksanaan = FALSE;
        if ($master_rpjm_desa) {
            $tahun_ke = (intval($detail_master_rkp->rkp_tahun) - intval($master_rpjm_desa->tahun_awal)) + 1;
            $tahun_pelaksanaan = "tahun_pelaksanaan_" . $tahun_ke;

            $and_tahun_pelaksanaan = array($tahun_pelaksanaan => $detail_master_rkp->rkp_tahun);
        }

        unset($master_rpjm_desa);

        $rpjm_grouped_by_bidang = $this->m_rancangan_rpjm_desa->getByIdMasterRpjm($detail_master_rkp->id_m_rancangan_rpjm_desa, TRUE, $and_tahun_pelaksanaan);

        $this->set('js_rkp_add_detail', $this->load->view('rencanaPembangunan/rkp/js/rkp_detail', array("rpjm_grouped_by_bidang" => json_encode($rpjm_grouped_by_bidang)), TRUE));
        $this->set('js_general_helper', $this->load->view('rencanaPembangunan/rancangan_rpjm_desa/js/general_helper', array(), TRUE));
        $this->set('deskripsi_title', 'Formulir Detail RPJM Desa');
        $this->set('attention_message', $attention_message);
        $this->set('id_m_apbdes', $id_m_apbdes);
        $this->set('id_apbdes', $id_apbdes);
        $this->set('post_data', $post_data);

        $this->set('top_level_coa', $top_level_coa);
        $this->set('deskripsi_title', 'Detail RKP Desa');

        $this->set('js_general_helper', $this->load->view('rencanaPembangunan/rancangan_rpjm_desa/js/general_helper', array(), TRUE));
    }

    public function export_excel($id_m_apbdes) {


//        var_dump(APPPATH.'views/rencanaPembangunan/rancangan_rpjm_desa/excel_template/rpjm_template.xls');exit;
        $detail_master_apbdes = $this->m_master_apbdes->getDetail($id_m_apbdes);

        $apbdes_grouped_by_top_level_coa = $this->m_apbdes->getExcelRecordByIdMasterApbdes($id_m_apbdes);

        if (!$apbdes_grouped_by_top_level_coa) {
            $this->session->set_flashdata('attention_message', 'Eksport Excel Gagal, data tidak ditemukan.');
            redirect('rencanaPembangunan/c_apbdes', 'refresh');
        }

        if ($apbdes_grouped_by_top_level_coa && !empty($apbdes_grouped_by_top_level_coa)) {

//            var_dump($apbdes_grouped_by_top_level_coa);exit;
            $this->load->library('excel');
            $this->excel->load(APPPATH . 'views/rencanaPembangunan/apbdes/excel_template/apbdesa_template.xls');

            /**
             * Isi tabel
             */
            $no = 1;
            $start_table_row = 10;
            $current_table_row = 10;
            $excel_active_sheet = $this->excel->getActiveSheet();
//            $current_active_sheet = $this->excel->setActiveSheetIndex(0);
//            var_dump($excel_active_sheet);exit;

            /**
             * set keterangan dokumen
             */
            $excel_active_sheet->setCellValue('B4', "PEMERINTAH DESA " . strtoupper($detail_master_apbdes->nama_desa));
            $excel_active_sheet->setCellValue('B5', "TAHUN ANGGARAN " . $detail_master_apbdes->rkp_tahun);

            $array_sub_total = array();

            /**
             * asumsi bahwa top coa ada 3 sesuai dengan contoh APBDES
             */
            $current_top_coa = 1;

            $sub_total_top_coa_row_location = array();

            foreach ($apbdes_grouped_by_top_level_coa as $id_top_level_coa => $apbdes) {
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
                foreach ($apbdes as $key_apbdes => $row_apbdes) {

                    $array_kode_rekening = explode(".", $row_apbdes->kode_rekening);

                    if ($row_apbdes->level == 2) {
                        $array_sub_total[$array_kode_rekening[0]][$array_kode_rekening[1]] = (object) array(
                                    "row_location" => $current_table_row,
                                    "third_level" => array()
                        );
                    } elseif ($row_apbdes->level == 3) {
                        $array_sub_total[$array_kode_rekening[0]][$array_kode_rekening[1]]->third_level[$array_kode_rekening[2]] = (object) array(
                                    "row_location" => $current_table_row,
                                    "next_level" => array()
                        );
                    } else {
                        $array_sub_total[$array_kode_rekening[0]][$array_kode_rekening[1]]
                                ->third_level[$array_kode_rekening[2]]
                                ->next_level[] = $current_table_row;
                    }

                    if (count($array_kode_rekening) < 4) {
                        $excel_active_sheet->setCellValue('B' . $current_table_row, $array_kode_rekening[0]);
                        $excel_active_sheet->setCellValue('C' . $current_table_row, $array_kode_rekening[1]);
                        if (array_key_exists(2, $array_kode_rekening)) {
                            $excel_active_sheet->setCellValue('D' . $current_table_row, $array_kode_rekening[2]);
                        }
                        if (array_key_exists(3, $array_kode_rekening)) {
                            $excel_active_sheet->setCellValue('E' . $current_table_row, $array_kode_rekening[3]);
                        }
                    }

                    $excel_active_sheet->setCellValue('F' . $current_table_row, $row_apbdes->group_coa);

                    if (!is_null($row_apbdes->anggaran)) {
                        $excel_active_sheet->setCellValue('G' . $current_table_row, $row_apbdes->anggaran);
                    }

                    if (!is_null($row_apbdes->keterangan)) {
                        $excel_active_sheet->setCellValue('H' . $current_table_row, $row_apbdes->keterangan);
                    }

                    if ($row_apbdes->level == 2) {
                        /**
                         * @todo Set background Color
                         */
                    }

                    $current_table_row++;
                    $excel_active_sheet->insertNewRowBefore($current_table_row, 1);
//                    $excel_active_sheet->setCellValue('I' . ($current_table_row + 1), '=SUM(I' . $start_table_row . ':I' . ($current_table_row - 1) . ')');
                }

                $sub_total_top_coa_row_location[$current_top_coa] = $current_table_row + 2;

                $current_top_coa++;

                $current_table_row+=5;
                if ($current_top_coa == 3) {
                    $current_table_row+=2;
                }
                /**
                 * Jumlah Biaya
                 */
                $no++;
            }
        }

//        $excel_active_sheet
//                ->setCellValue('I' . ($current_table_row + 1), '=SUM(I' . $start_table_row . ':I' . ($current_table_row - 1) . ')');
//        var_dump($array_sub_total);
//        exit;

        /**
         * hitung sub total
         */
        foreach ($array_sub_total as $top_level_coa => $second_levels_coa) {
            if (is_array($second_levels_coa) && !empty($second_levels_coa)) {
                $array_second_level_rows_location = array();
                foreach ($second_levels_coa as $second_level_key => $second_level_coa) {
                    if (is_array($second_level_coa->third_level) && !empty($second_level_coa->third_level)) {
                        $array_third_level_rows_location = array();
                        if ($top_level_coa != 3) {
                            foreach ($second_level_coa->third_level as $third_level_key => $third_level_coa) {
                                if (is_array($third_level_coa->next_level) && !empty($third_level_coa->next_level)) {
                                    $row_start_count_next_level = current($third_level_coa->next_level);
                                    $row_end_count_next_level = end($third_level_coa->next_level);

                                    $excel_active_sheet->setCellValue('G' . $third_level_coa->row_location, '=SUM(G' . $row_start_count_next_level . ':G' . ($row_end_count_next_level) . ')');
                                }
                                $array_third_level_rows_location[] = 'G' . $third_level_coa->row_location;
                            }
                            $excel_active_sheet->setCellValue('G' . $second_level_coa->row_location, '=' . implode("+", $array_third_level_rows_location));
                        } else {
                            $first_third_level = current($second_level_coa->third_level);
                            $last_third_level = end($second_level_coa->third_level);
                            $excel_active_sheet->insertNewRowBefore(($last_third_level->row_location+1), 1);
                            
                            $current_table_row++;
                            
                            $excel_active_sheet->setCellValue('F' . ($last_third_level->row_location+1), 'JUMLAH ( RP )');
                            $excel_active_sheet->setCellValue('G' . ($last_third_level->row_location+1), '=SUM(G' . $first_third_level->row_location.':G'.$last_third_level->row_location.')');
                        }
                    }
                    $array_second_level_rows_location[] = 'G' . $second_level_coa->row_location;
                }
                if ($top_level_coa != 3) {
                    $excel_active_sheet->setCellValue('G' . $sub_total_top_coa_row_location[$top_level_coa], '=' . implode("+", $array_second_level_rows_location));
                }
            }
        }

        /**
         * hitung surplus / defisit
         */
        $excel_active_sheet->setCellValue('G' . ($sub_total_top_coa_row_location[2] + 2), '=G' . $sub_total_top_coa_row_location[1] . '-G' . $sub_total_top_coa_row_location[2]);
        $current_table_row--;
        
        $excel_active_sheet->setCellValue('H' . $current_table_row, 'Kepala Desa '.strtoupper($detail_master_apbdes->nama_desa));
        $current_table_row+=3;
        $excel_active_sheet->setCellValue('H' . $current_table_row, '( '.strtoupper($detail_master_apbdes->disetujui_oleh).' )');

        $this->excel->stream('apbdes_tahun_anggaran_' . str_replace(' ', '', $detail_master_apbdes->rkp_tahun) . '.xls');


        exit;
    }

}
