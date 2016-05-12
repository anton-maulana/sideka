<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rkpdes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        $this->load->model('sso/m_sso');
        
        $this->load->helper(array('flexigrid_helper', 'common_helper'));
        $this->config->load('rp_rkp_desa');
        $this->load->model(array(
            'rencanaPembangunan/m_rancangan_rpjm_desa',
            'rencanaPembangunan/m_master_rkp',
            'rencanaPembangunan/m_rkp',
            'rencanaPembangunan/m_bidang',
            'rencanaPembangunan/m_master_rancangan_rpjm_desa'));
    }
	
	function index()
    {
        
        $r_m_rpjm_desa_config = $this->config->item('rp_master_rkp_desa');
        $colModelM = $r_m_rpjm_desa_config['colModel'];
        
        $buttons = $r_m_rpjm_desa_config['buttons'];
        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_rkpdes/load_data_master'), $colModelM, 'id_m_rkp', 'desc', $gridParams, $buttons);
        
        $data['js_grid'] = $grid_js;
        $data['page_title'] = 'DATA RKPDes';
        $data['deskripsi_title'] = 'Rencana Kerja Pembangunan  Desa';
        
		$data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
        
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/rkpdes',$data,TRUE);
		$this->load->view('templateHome',$temp);
        
         
        //var_dump($grid_js);exit;
	}
    public function detail($id) {
        $r_m_rpjm_desa_config = $this->config->item('content_rp_rkp_desa');

        $colModelM = $r_m_rpjm_desa_config['colModel'];
        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_rkpdes/load_data_detail/'.$id), $colModelM, 'id_rkp', 'desc', $gridParams);

        $attention_message = $this->session->flashdata('attention_message');
        $data['id_m_rkp']= $id;
        $data['js_grid']= $grid_js;
        $data['page_title'] = 'Detail RKPDes';
        $data['deskripsi_title'] = 'Rencana Kerja Pembangunan Desa';
        
        $data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/rkpdes',$data,TRUE);
		$data['templateHome']=$this->load->view('templateHome',$temp);
    }

    public function load_data_detail($id_m_rkp = FALSE) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_rkp');

        $this->flexigrid->validate_post('id_rkp', 'ASC', $valid_fields);
        $records = $this->m_rkp->getFlexigrid($id_m_rkp);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        if ($records['records']) {
            foreach ($records['records']->result() as $row) {
                $record_items[] = array(
                    $row->id_rkp,
                    $row->id_rkp,
                    $row->id_m_rancangan_rpjm_desa,
                    $row->rkp_tahun,
                    $row->bidang,
                    $row->jenis_kegiatan,
                    $row->lokasi,
                    $row->volume,
                    $row->sasaran_manfaat,
                    $row->waktu_pelaksanaan,
                    rupiah_display($row->jumlah_biaya),
                    ($row->swakelola != 0 ? '<i class="fa fa-check"></i>' : ' '),
                    ($row->kerjasama_antar_desa != 0 ? '<i class="fa fa-check"></i>' : ' '),
                    ($row->kerjasama_pihak_ketiga != 0 ? '<i class="fa fa-check"></i>' : ' '),
                    $row->rencana_pelaksanaan_kegiatan
                    //.'<a  title="Download Excel" href="' . base_url() . 'rencanaPembangunan/c_rkp/export_excel/' . $row->id_m_rkp . '" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
            }
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }
    public function load_data_master() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_m_rkp');

        $this->flexigrid->validate_post('id_m_rkp', 'ASC', $valid_fields);
        $records = $this->m_master_rkp->getFlexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_m_rkp,
                $row->id_m_rkp,
                $row->id_m_rancangan_rpjm_desa,
                $row->tahun_awal,
                $row->tahun_akhir,
                $row->tahun_anggaran,
                rupiah_display($row->total_bidang_1),
                rupiah_display($row->total_bidang_2),
                rupiah_display($row->total_bidang_3),
                rupiah_display($row->total_bidang_4),
                rupiah_display($row->total_keseluruhan),
                $row->rkp_tahun,
                $row->tanggal_disusun,
                $row->disusun_oleh,
                $row->kepala_desa,
                $row->id_desa,
                $row->nama_desa,
                $row->id_kecamatan,
                $row->nama_kecamatan,
                $row->id_kab_kota,
                $row->nama_kab_kota,
                $row->id_provinsi,
                $row->nama_provinsi,
                '<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil RKP" onclick="show_detail_program(\'' . $row->id_m_rkp . '\')"/>' .
                '<i class="fa fa-list-alt"></i>' .
                '</button>&nbsp;' .
                /**
                 * @todo Buat generate excel untuk rkp
                 */
                  '<a  title="Download Excel" href="' . base_url() . 'web/c_rkpdes/export_excel/' . $row->id_m_rkp . '" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }
    
        public function export_excel($id_m_rkp) {


//        var_dump(APPPATH.'views/rencanaPembangunan/rancangan_rpjm_desa/excel_template/rpjm_template.xls');exit;
        $detail_master_rkp = $this->m_master_rkp->getDetail($id_m_rkp);

        $rkp_grouped_by_bidang = $this->m_rkp->getByIdMasterRkp($id_m_rkp, TRUE);
//        var_dump($rkp_grouped_by_bidang);exit;
        
        if (!$rkp_grouped_by_bidang) {
            $this->session->set_flashdata('attention_message', 'Eksport Excel Gagal, data tidak ditemukan.');
            redirect('rencanaPembangunan/c_rkp', 'refresh');
        }

        if ($rkp_grouped_by_bidang && $rkp_grouped_by_bidang && !empty($rkp_grouped_by_bidang)) {
            $this->load->library('excel');
            $this->excel->load(APPPATH . 'views/rencanaPembangunan/rkp/excel_template/rkp_template.xls');

            /**
             * Isi tabel
             */
            $no = 1;
            $start_table_row = 13;
            $current_table_row = 13;
            $excel_active_sheet = $this->excel->getActiveSheet();
//            $current_active_sheet = $this->excel->setActiveSheetIndex(0);
//            var_dump($excel_active_sheet);exit;


            /**
             * set keterangan dokumen
             */
            $excel_active_sheet->setCellValue('A4', "Tahun : ".$detail_master_rkp->rkp_tahun);
            $excel_active_sheet->setCellValue('D5', $detail_master_rkp->nama_desa);
            $excel_active_sheet->setCellValue('D6', $detail_master_rkp->nama_kecamatan);
            $excel_active_sheet->setCellValue('D7', $detail_master_rkp->nama_kab_kota);
            $excel_active_sheet->setCellValue('D8', $detail_master_rkp->nama_provinsi);

            foreach ($rkp_grouped_by_bidang as $id_bidang => $array_bidang) {
			
			
                $current_bidang = !empty($array_bidang) ? current($array_bidang) : FALSE;
                $current_bidang_text = "";
                $current_sub_bidang_text = "";
                $current_no = "";
                if ($current_bidang) {


//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
                    foreach ($current_bidang as $arr_key_current_bidang => $row_current_bidang) {
                        if ($current_no != $no) {
                            $excel_active_sheet->setCellValue('A' . $current_table_row, $no);
                            $current_no = $no;
                        }

                        if ($current_bidang_text != $row_current_bidang->bidang) {
                            $excel_active_sheet->setCellValue('B' . $current_table_row, $row_current_bidang->bidang);
                        }
//                        if ($current_table_row > 12 && $current_bidang_text == $row_current_bidang->bidang) {
//                            $excel_active_sheet->mergetCells('B' . $current_table_row . ':B' . ($current_table_row - 1));
//                        }

//var_dump($row_current_bidang);exit;
                        $current_bidang_text = $row_current_bidang->bidang;

                        $excel_active_sheet->setCellValue('D' . $current_table_row, $row_current_bidang->jenis_kegiatan);

                        $excel_active_sheet->setCellValue('E' . $current_table_row, $row_current_bidang->lokasi);

                        $excel_active_sheet->setCellValue('F' . $current_table_row, $row_current_bidang->volume);

                        $excel_active_sheet->setCellValue('G' . $current_table_row, $row_current_bidang->sasaran_manfaat);

                        $excel_active_sheet->setCellValue('H' . $current_table_row, $row_current_bidang->waktu_pelaksanaan);
                        $excel_active_sheet->setCellValue('I' . $current_table_row, $row_current_bidang->jumlah_biaya);
                        $excel_active_sheet->setCellValue('J' . $current_table_row, $row_current_bidang->sumber_dana);
                        
                        $excel_active_sheet->setCellValue('K' . $current_table_row, ($row_current_bidang->swakelola ? '✓' : ''));
                        $excel_active_sheet->setCellValue('L' . $current_table_row, ($row_current_bidang->kerjasama_antar_desa ? '✓' : ''));
                        $excel_active_sheet->setCellValue('M' . $current_table_row, ($row_current_bidang->kerjasama_pihak_ketiga ? '✓' : ''));
                        
                        $excel_active_sheet->setCellValue('N' . $current_table_row, $row_current_bidang->rencana_pelaksanaan_kegiatan);
                    
                        $current_table_row++;
                        $excel_active_sheet->insertNewRowBefore($current_table_row, 1);
                        $excel_active_sheet->setCellValue('I' . ($current_table_row + 1), '=SUM(I' . $start_table_row . ':I' . ($current_table_row - 1) . ')');
                    }

                    $current_table_row+=2;
                    $start_table_row = $current_table_row;
                    $current_bidang_text = "";
                    $current_sub_bidang_text = "";
                    $current_no = "";
                }else{
                    $current_table_row+=2;
                }

                /**
                 * Jumlah Biaya
                 */
                $no++;
            }
            
            $current_table_row+=2;
            $excel_active_sheet->setCellValue('J'.$current_table_row, 'Desa '.$detail_master_rkp->nama_desa.', Tanggal, '.$detail_master_rkp->tanggal_disusun);
            $current_table_row+=6;
            $excel_active_sheet->setCellValue('D'.$current_table_row, '( '.strtoupper($detail_master_rkp->kepala_desa).' )');
            $excel_active_sheet->setCellValue('K'.$current_table_row, '( '.strtoupper($detail_master_rkp->disusun_oleh).' )');
            
            foreach($excel_active_sheet = $this->excel->getActiveSheet()->getRowDimensions() as $rd) { 
                $rd->setRowHeight(-1); 
            }

            $this->excel->stream('rkp_tahun_anggaran_'.  str_replace(' ', '', $detail_master_rkp->rkp_tahun).'.xls');
        }

        exit;
    }
   
}