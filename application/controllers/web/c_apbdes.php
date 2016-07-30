<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_apbdes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        $this->load->model('sso/m_sso');

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

	function index()
    {
        $data['page_title'] = 'DATA APBDes';
        $data['deskripsi_title'] = 'Anggaran Pendapatan dan Belanja Desa';
        $data['result_apbdes'] = $this->m_master_apbdes->getDataMasterApbdesTable();
        $data['data_sso'] = $this->m_sso->getSso(1);
        $data['konten_logo'] = $this->m_logo->getLogo();

        $data['logo'] = $this->load->view('v_logo', $data, TRUE);
        $data['menu'] = $this->load->view('v_navbar', $data, TRUE);
        $temp['footer'] = $this->load->view('v_footer',$data,TRUE);
        $temp['content'] = $this->load->view('web/content/apbdes_master',$data,TRUE);
        $this->load->view('templateHome',$temp);


        //var_dump($grid_js);exit;
	}

  public function anggaran($id_m_apbdes = FALSE){
        $post_data = array();
        $data['page_title'] = 'Detail APBDes';
        $data['deskripsi_title'] = 'Anggaran Pembangunan Desa';

        $data['result_apbdes'] =$this->m_apbdes->getDataApbdesTable($id_m_apbdes);
        //var_dump($data['result']);exit;

        $data['data_sso'] = $this->m_sso->getSso(1);
        $data['konten_logo'] = $this->m_logo->getLogo();
        $data['logo'] = $this->load->view('v_logo', $data, TRUE);
        $data['menu'] = $this->load->view('v_navbar', $data, TRUE);
        $temp['footer'] = $this->load->view('v_footer',$data,TRUE);
        $temp['content'] = $this->load->view('web/content/apbdes',$data,TRUE);
        $this->load->view('templateHome',$temp);
  }

  public function detail($id) {
        $r_m_rpjm_desa_config = $this->config->item('content_rp_apb_desa');

        $colModelM = $r_m_rpjm_desa_config['colModel'];
        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_apbdes/load_data_detail/' . $id), $colModelM, 'id_coa', 'asc', $gridParams);

        $attention_message = $this->session->flashdata('attention_message');
        $data['id_m_rkp']= $id;
        $data['js_grid']= $grid_js;
        $data['page_title'] = 'Detail APBDes';
        $data['deskripsi_title'] = 'Anggaran Pendapatan dan Belanja Desa';

        $data['data_sso'] = $this->m_sso->getSso(1);
        $data['konten_logo'] = $this->m_logo->getLogo();
    		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
    		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
    		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
    		$temp['content'] = $this->load->view('web/content/apbdes',$data,TRUE);
    		$data['templateHome']=$this->load->view('templateHome',$temp);
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
                    $row->keterangan
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
                '<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil APB Desa" onclick="show_detail_program(\'' . $row->id_m_apbdes . '\')"/>' .
                '<i class="fa fa-list-alt"></i>' .
                '</button>&nbsp;' .
                '<a  title="Download Excel" href="' . base_url() . 'web/c_apbdes/export_excel/' . $row->id_m_apbdes . '" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
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
