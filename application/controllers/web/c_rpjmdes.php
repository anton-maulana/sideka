<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rpjmdes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        $this->load->model('sso/m_sso');

        $this->load->library('flexigrid');
        $this->load->helper(array('flexigrid_helper', 'common_helper'));
        $this->config->load('rp_rancangan_rpjm_desa');

        $this->load->model(array(
            'rencanaPembangunan/m_rancangan_rpjm_desa',
            'rencanaPembangunan/m_master_rancangan_rpjm_desa',
            'rencanaPembangunan/m_sumber_dana_desa',
            'rencanaPembangunan/m_bidang'));

    }


	function index()
    {
        $post_data = array();
        $data['page_title'] = 'DATA RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
        $data['master_rpjm'] =$this->m_master_rancangan_rpjm_desa->getDataMasterRpjmTable();
        $post_data=$this->m_master_rancangan_rpjm_desa->getDataMasterRpjmTable();
        $data['post_data']= $post_data;
        $data['result'] ="";


    		$data['data_sso'] = $this->m_sso->getSso(1);
        $data['konten_logo'] = $this->m_logo->getLogo();
    		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
    		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
    		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
    		$temp['content'] = $this->load->view('web/content/rpjmdes',$data,TRUE);
    		$this->load->view('templateHome',$temp);
	}

  public function changeAnggaran($id_m_rancangan_rpjm_desa = FALSE){
        $post_data = array();        
        $data['page_title'] = 'DATA RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';

        $data['result'] =$this->m_rancangan_rpjm_desa->getDataRpjmTable($_POST['tahunAnggaran']);
        $data['master_rpjm'] =$this->m_master_rancangan_rpjm_desa->getDataMasterRpjmTable();

        $data['data_sso'] = $this->m_sso->getSso(1);
        $data['konten_logo'] = $this->m_logo->getLogo();
        $data['logo'] = $this->load->view('v_logo', $data, TRUE);
        $data['menu'] = $this->load->view('v_navbar', $data, TRUE);
        $temp['footer'] = $this->load->view('v_footer',$data,TRUE);
        $temp['content'] = $this->load->view('web/content/rpjmdes',$data,TRUE);
        $this->load->view('templateHome',$temp);

  }

  public function export_excel($id_m_rancangan_rpjm_desa) {


//        var_dump(APPPATH.'views/rencanaPembangunan/rancangan_rpjm_desa/excel_template/rpjm_template.xls');exit;
        $detail_master_rpjm = $this->m_master_rancangan_rpjm_desa->getDetail($id_m_rancangan_rpjm_desa);
        $rpjm_grouped_by_bidang = $this->m_rancangan_rpjm_desa->getByIdMasterRpjm($id_m_rancangan_rpjm_desa, TRUE);

        if (!$rpjm_grouped_by_bidang) {
            $this->session->set_flashdata('attention_message', 'Eksport Excel Gagal, data tidak ditemukan.');
            redirect('rencanaPembangunan/c_rancangan_rpjm_desa', 'refresh');
        }

        if ($rpjm_grouped_by_bidang && $rpjm_grouped_by_bidang && !empty($rpjm_grouped_by_bidang)) {
            $this->load->library('excel');
            $this->excel->load(APPPATH . 'views/rencanaPembangunan/rancangan_rpjm_desa/excel_template/rpjm_template.xls');

            /**
             * Isi tabel
             */
            $no = 1;
            $start_table_row = 12;
            $current_table_row = 12;
            $excel_active_sheet = $this->excel->getActiveSheet();
//            $current_active_sheet = $this->excel->setActiveSheetIndex(0);
//            var_dump($excel_active_sheet);exit;
            /**
             * ascii bro..
             */
            $column_start = 65;
            $column_end = 84;


            /**
             * set keterangan dokumen
             */
            $excel_active_sheet->setCellValue('I2', $detail_master_rpjm->tahun_anggaran);
            $excel_active_sheet->setCellValue('D3', $detail_master_rpjm->nama_desa);
            $excel_active_sheet->setCellValue('D4', $detail_master_rpjm->nama_kecamatan);
            $excel_active_sheet->setCellValue('D5', $detail_master_rpjm->nama_kab_kota);
            $excel_active_sheet->setCellValue('D6', $detail_master_rpjm->nama_provinsi);

            $tahun_awal = intval($detail_master_rpjm->tahun_awal)-1;
            for ($tahun = 73; $tahun <= 78; $tahun ++) {
                $tahun_awal++;
                $excel_active_sheet->setCellValue(CHR($tahun).'8', 'thn '.$tahun_awal);
            }



            foreach ($rpjm_grouped_by_bidang as $id_bidang => $array_bidang) {
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
                            $subject=$row_current_bidang->bidang;
                            $search = "Bidang";
                            $trimmed = str_replace($search, '', $subject);
                            $excel_active_sheet->setCellValue('B' . $current_table_row, $trimmed);
                        }
//                        if ($current_table_row > 12 && $current_bidang_text == $row_current_bidang->bidang) {
//                            $excel_active_sheet->mergetCells('B' . $current_table_row . ':B' . ($current_table_row - 1));
//                        }
                        $current_bidang_text = $row_current_bidang->bidang;

                        if ($current_sub_bidang_text != $row_current_bidang->sub_bidang) {
                            $excel_active_sheet->setCellValue('D' . $current_table_row, $row_current_bidang->sub_bidang);
                        }
                        $current_sub_bidang_text = $row_current_bidang->sub_bidang;

                        $excel_active_sheet->setCellValue('E' . $current_table_row, $row_current_bidang->jenis_kegiatan);

                        $excel_active_sheet->setCellValue('F' . $current_table_row, $row_current_bidang->lokasi_rt_rw);

                        $excel_active_sheet->setCellValue('G' . $current_table_row, $row_current_bidang->prakiraan_volume);

                        $excel_active_sheet->setCellValue('H' . $current_table_row, $row_current_bidang->sasaran_manfaat);

                        $excel_active_sheet->setCellValue('I' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_1 ? '✓' : ''));
                        $excel_active_sheet->setCellValue('J' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_2 ? '✓' : ''));
                        $excel_active_sheet->setCellValue('K' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_3 ? '✓' : ''));
                        $excel_active_sheet->setCellValue('L' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_4 ? '✓' : ''));
                        $excel_active_sheet->setCellValue('M' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_5 ? '✓' : ''));
                        $excel_active_sheet->setCellValue('N' . $current_table_row, ($row_current_bidang->tahun_pelaksanaan_6 ? '✓' : ''));

                        $excel_active_sheet->setCellValue('O' . $current_table_row, $row_current_bidang->jumlah_biaya);

                        $excel_active_sheet->setCellValue('P' . $current_table_row, $row_current_bidang->sumber_biaya);

                        $excel_active_sheet->setCellValue('Q' . $current_table_row, ($row_current_bidang->swakelola ? '✓' : ''));
                        $excel_active_sheet->setCellValue('R' . $current_table_row, ($row_current_bidang->kerjasama_antar_desa ? '✓' : ''));
                        $excel_active_sheet->setCellValue('S' . $current_table_row, ($row_current_bidang->kerjasama_pihak_ketiga ? '✓' : ''));

                        $current_table_row++;
                        $excel_active_sheet->insertNewRowBefore($current_table_row, 1);
                        $excel_active_sheet->setCellValue('O' . ($current_table_row + 1), '=SUM(O' . $start_table_row . ':O' . ($current_table_row - 1) . ')');
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
            $excel_active_sheet->setCellValue('Q'.$current_table_row, 'Desa '.$detail_master_rpjm->nama_desa.', Tanggal, '.$detail_master_rpjm->tanggal_disusun);
            $current_table_row+=7;
            $excel_active_sheet->setCellValue('B'.$current_table_row, '( '.strtoupper($detail_master_rpjm->kepala_desa).' )');
            $excel_active_sheet->setCellValue('Q'.$current_table_row, '( '.strtoupper($detail_master_rpjm->disusun_oleh).' )');

            //exit;
            foreach($excel_active_sheet = $this->excel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            $this->excel->stream('rpjm_tahun_anggaran_'.  str_replace(' ', '', $detail_master_rpjm->tahun_anggaran).'.xls');
        }

        exit;
    }



}
