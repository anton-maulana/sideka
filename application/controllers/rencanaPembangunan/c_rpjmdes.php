<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_rpjmdes extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->library('treeview_rpjmdes');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rpjmdes');
    }

    function index() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $this->lists();
        } else
            redirect('c_login', 'refresh');
    }

    function lists() {
        $colModel['id_rpjmdes'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir)'] = array('Periode', 100, TRUE, 'center', 2);
        $colModel['ref_rp_bidang.kode_bidang'] = array('Kode Bidang', 100, TRUE, 'center', 2);
        $colModel['tbl_rp_rpjmd.program'] = array('Program RPJMD', 170, TRUE, 'left', 2);
        $colModel['tbl_rp_rpjmdes.program'] = array('Program RPJMDes', 170, TRUE, 'left', 2);
        $colModel['tbl_rp_rpjmdes.indikator'] = array('Indikator', 100, TRUE, 'left', 2);
        $colModel['tbl_rp_rpjmdes.kondisi_awal'] = array('Kondisi Awal', 75, TRUE, 'left', 2);
        $colModel['tbl_rp_rpjmdes.target'] = array('Target', 75, TRUE, 'left', 2);
        $colModel['tbl_rp_rpjmdes.capaian'] = array('Capaian', 100, TRUE, 'left', 2);
        $colModel['aksi'] = array('AKSI', 115, FALSE, 'center', 0);

        //Populate flexigrid buttons..
        $buttons[] = array('Select All', 'check', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('DeSelect All', 'uncheck', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Add', 'add', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items', 'delete', 'btn');
        $buttons[] = array('separator');

        $gridParams = array(
            'height' => 300,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
        );

        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_rpjmdes/load_data'), $colModel, 'id_rpjmdes', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {
        $this->load->library('flexigrid');

        $valid_fields = array(
            'id_rpjmdes',
            'CONCAT(ref_rp_periode.periode_awal, " - ", ref_rp_periode.periode_akhir)',
            'ref_rp_bidang.kode_bidang',
            'tbl_rp_rpjmd.program',
            'tbl_rp_rpjmdes.program',
            'tbl_rp_rpjmdes.indikator',
            'tbl_rp_rpjmdes.kondisi_awal',
            'tbl_rp_rpjmdes.target',
            'tbl_rp_rpjmdes.capaian'
        );

        $this->flexigrid->validate_post('id_rpjmdes', 'ASC', $valid_fields);
        $records = $this->m_rpjmdes->get_rpjmdes_flexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_rpjmdes == null) {
                $record_items[] = array(
                    $row->id_rpjmdes,
                    $row->id_rpjmdes,
                    $row->periode,
                    $row->kode_bidang,
                    $row->program_rpjmd,
                    $row->program_rpjmdes,
                    $row->indikator,
                    $row->kondisi_awal,
                    $row->target,
                    $row->capaian,
                    '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="show_detail_program(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-plus"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detail Program" onclick="show_detail_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rpjmdes1(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-sitemap"></i></button>'
                );
            }
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function show_detail_program($id) {
        $colModel['id_rpjmdes'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['sub'] = array('Sub', 30, TRUE, 'left', 2);
        $colModel['periode'] = array('Periode', 100, TRUE, 'center', 2);
        $colModel['kode_bidang'] = array('Kode Bidang', 100, TRUE, 'center', 2);
        $colModel['program_rpjmd'] = array('Program RPJMD', 170, TRUE, 'left', 2);
        $colModel['program_rpjmdes'] = array('Program RPJMDes', 170, TRUE, 'left', 2);
        $colModel['indikator'] = array('Indikator', 100, TRUE, 'left', 2);
        $colModel['kondisi_awal'] = array('Kondisi Awal', 75, TRUE, 'left', 2);
        $colModel['target'] = array('Target', 75, TRUE, 'left', 2);
        $colModel['capaian'] = array('Capaian', 100, TRUE, 'left', 2);
        $colModel['aksi'] = array('AKSI', 90, FALSE, 'center', 0);

        //Populate flexigrid buttons..
        $buttons[] = array('Back', 'prev', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Select All', 'check', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('DeSelect All', 'uncheck', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items', 'delete', 'btn');
        $buttons[] = array('separator');

        $gridParams = array(
            'height' => 250,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
        );
        //$data['id_rpjmdes'] = $id;
        $data['id'] = $id;
        $data['program'] = $this->m_rpjmdes->getProgram_ByIdRpjmdes($id);
        $grid_js = build_grid_js('flex_program', site_url('rencanaPembangunan/c_rpjmdes/load_program/' . $id), $colModel, 'id_rpjmdes', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DETAIL PROGRAM RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tampil_detil_program', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_program($id) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_rpjmdes', 'program');

        $this->flexigrid->validate_post('id_rpjmdes', 'ASC', $valid_fields);
        $records = $this->m_rpjmdes->get_rpjmdes_flexigrid_byIdRpjmdes($id);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_rpjmdes == null) {
                $record_items[] = array(
                    $row->id_rpjmdes,
                    $row->id_rpjmdes,
                    '<input type="checkbox" onclick="return false" onkeydown="return false" />',
                    $row->periode,
                    $row->kode_bidang,
                    $row->program_rpjmd,
                    $row->program_rpjmdes,
                    $row->indikator,
                    $row->kondisi_awal,
                    $row->target,
                    $row->capaian,
                    '
				<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detail Program" onclick="show_detail_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-sitemap"></i></button>
				'
                );
            } else
                $record_items[] = array(
                    $row->id_rpjmdes,
                    $row->id_rpjmdes,
                    '<input type="checkbox" onclick="return false" onkeydown="return false" checked="checked"/>',
                    $row->periode,
                    $row->kode_bidang,
                    $row->program_rpjmd,
                    $row->program_rpjmdes,
                    $row->indikator,
                    $row->kondisi_awal,
                    $row->target,
                    $row->capaian,
                    '
				<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detail Program" onclick="show_detail_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmdes(\'' . $row->id_rpjmdes . '\')"/><i class="fa fa-pencil"></i></button>
				'
                );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function show_detail_rpjmdes($id) {
        $colModel['id_rpjmdes_detail'] = array('ID', 30, TRUE, 'center', 0);
        //$colModel['periode'] = array('Periode',100,TRUE,'center',2);
        $colModel['tahun'] = array('Tahun', 100, TRUE, 'center', 2);
        $colModel['tanggal'] = array('Tanggal', 100, TRUE, 'left', 2);
        //$colModel['program_rpjmdes'] = array('Program RPJMDes',200,TRUE,'center',2);
        $colModel['volume'] = array('Volume', 100, TRUE, 'center', 2);
        $colModel['satuan'] = array('Satuan', 100, TRUE, 'left', 2);
        $colModel['lokasi'] = array('Lokasi', 130, TRUE, 'left', 2);
        $colModel['nominal'] = array('Nominal', 150, TRUE, 'left', 2);
        $colModel['aksi'] = array('AKSI', 75, FALSE, 'center', 0);

        //Populate flexigrid buttons..
        $buttons[] = array('Back', 'prev', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Select All', 'check', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('DeSelect All', 'uncheck', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Add', 'add', 'btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items', 'delete', 'btn');
        $buttons[] = array('separator');

        $gridParams = array(
            'height' => 200,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
        );
        $data['id'] = $id;
        $data['program'] = $this->m_rpjmdes->getProgram_ByIdRpjmdes($id);
        $data['periode'] = $this->m_rpjmdes->getPeriode_ByIdRpjmdes($id);
        $data['rpjmdes'] = $this->m_rpjmdes->getRowRpjmdes_ByIdRpjmdes($id);
        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_rpjmdes/load_detail_rpjmdes/' . $id), $colModel, 'id_rpjmdes_detail', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA DETIL RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tampil_detil_rpjmdes', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_detail_rpjmdes($id) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_rpjmdes', 'program');

        $this->flexigrid->validate_post('id_rpjmdes_detail', 'ASC', $valid_fields);
        $records = $this->m_rpjmdes->get_detail_rpjmdes_flexigrid($id);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_rpjmdes_detail,
                $row->id_rpjmdes_detail,
                //		$row->periode,
                $row->tahun_anggaran,
                date('d-m-Y', strtotime($row->tanggal)),
                //		$row->program_rpjmdes,
                $row->volume,
                $row->satuan,
                $row->lokasi,
                'Rp ' . $this->rupiah($row->nominal) . ',-',
                '
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmdes(\'' . $row->id_rpjmdes_detail . '\')"/><i class="fa fa-pencil"></i></button>
				'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function rupiah($data) {
        $rupiah = "";
        $jml = strlen($data);
        while ($jml > 3) {
            $rupiah = "." . substr($data, -3) . $rupiah;
            $l = strlen($data) - 3;
            $data = substr($data, 0, $l);
            $jml = strlen($data);
        }
        $rupiah = $data . $rupiah;
        return $rupiah;
    }

    function add() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['page_title'] = 'TAMBAH DATA RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['json_array_bidang'] = $this->autocomplete_Bidang();
            $data['rpjmd'] = $this->m_rpjmdes->get_rpjmd();
            $data['periode'] = $this->m_rpjmdes->get_periode();
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tambah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_rpjmdes() {
        $program = $this->input->post('program', TRUE);
        $kode_bidang = $this->input->post('kode_bidang', TRUE);
        $indikator = $this->input->post('indikator', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $capaian = $this->input->post('capaian', TRUE);
        $id_rpjmd = $this->input->post('id_rpjmd', TRUE);
        $id_periode = $this->input->post('id_periode', TRUE);

        $id_bidang = $this->m_rpjmdes->get_IdBidangByKodeBidang($kode_bidang);

        $this->form_validation->set_rules('program', 'Nama Program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_rpjmdes->cekFIleExist($program);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'program' => $program,
                    'indikator' => $indikator,
                    'kondisi_awal' => $kondisi_awal,
                    'target' => $target,
                    'capaian' => $capaian,
                    'id_rpjmd' => $id_rpjmd,
                    'id_periode' => $id_periode,
                    'id_bidang' => $id_bidang
                );

                $this->m_rpjmdes->insertRpjmdes($data);
                redirect('rencanaPembangunan/c_rpjmdes', 'refresh');
            } else
                $this->add();
            /* Handle ketika program rpjmdes telah digunakan */
        } else
            $this->add();
    }

    function add_sub_program($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmdes'] = $id;
            $id_rpjmd = $this->m_rpjmdes->getIdRpjmd_ByIdRpjmdes($id);
            $id_bidang = $this->m_rpjmdes->getIdBidang_ByIdRpjmdes($id);
            $data['page_title'] = 'TAMBAH SUB PROGRAM RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['rpjmdes'] = $this->m_rpjmdes->getRowRpjmdes_ByIdRpjmdes($id);
            $data['program_rpjmd'] = $this->m_rpjmdes->getProgram_ByIdRpjmd($id_rpjmd);
            $data['json_array_bidang'] = $this->autocomplete_Bidang();
            $data['rpjmd'] = $this->m_rpjmdes->get_rpjmd();
            $data['kode_bidang'] = $this->m_rpjmdes->getRowBidang_ByIdBidang($id_bidang);
            $data['periode'] = $this->m_rpjmdes->get_periode();
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tambah_sub_program', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_sub_program() {
        $id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
        $sub_program = $this->input->post('sub_program', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $id_parent_rpjmdes = $this->input->post('id_parent_rpjmdes', TRUE);
        $id_top_rpjmdes = $this->input->post('id_top_rpjmdes', TRUE);
        $id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
        $id_rpjmd = $this->input->post('id_rpjmd', TRUE);
        $indikator = $this->input->post('indikator', TRUE);
        $capaian = $this->input->post('capaian', TRUE);
        $id_periode = $this->input->post('id_periode', TRUE);
        $id_bidang = $this->input->post('id_bidang', TRUE);

        if ($id_top_rpjmdes == null) {
            $id_top_rpjmdes = $id_rpjmdes;
        } else {
            $id_top_rpjmdes = $this->m_rpjmdes->getIdTopRpjmdes_ByIdRpjmdes($id_rpjmdes);
        }

        $this->form_validation->set_rules('sub_program', 'Nama Sub Program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_rpjmdes->cekFIleExist($sub_program);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'program' => $sub_program,
                    'kondisi_awal' => $kondisi_awal,
                    'target' => $target,
                    'capaian' => $capaian,
                    'indikator' => $indikator,
                    'id_parent_rpjmdes' => $id_rpjmdes,
                    'id_top_rpjmdes' => $id_top_rpjmdes,
                    'id_rpjmd' => $id_rpjmd,
                    'id_periode' => $id_periode,
                    'id_bidang' => $id_bidang
                );

                $this->m_rpjmdes->insertRpjmdes($data);
                if (!$id_top_rpjmdes == null) {
                    redirect('rencanaPembangunan/c_rpjmdes/show_detail_program/' . $id_top_rpjmdes, 'refresh');
                } else {
                    redirect('rencanaPembangunan/c_rpjmdes/show_detail_program/' . $id_rpjmdes, 'refresh');
                }
            } else
                $this->add_sub_program($id_rpjmdes);
            /* Handle ketika program rpjmdes telah digunakan */
        } else
            $this->add_sub_program($id_rpjmdes);
    }

    function add_detail_rpjmdes($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmdes'] = $id;
            $id_rpjmd = $this->m_rpjmdes->getIdRpjmd_ByIdRpjmdes($id);
            $id_bidang = $this->m_rpjmdes->getIdBidang_ByIdRpjmdes($id);
            $id_periode = $this->m_rpjmdes->getIdPeriode_ByIdRpjmdes($id);
            $data['page_title'] = 'TAMBAH DETIL RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['rpjmdes'] = $this->m_rpjmdes->getRowRpjmdes_ByIdRpjmdes($id);
            $data['kode_bidang'] = $this->m_rpjmdes->getRowBidang_ByIdBidang($id_bidang);
            $data['periode'] = $this->m_rpjmdes->get_periode();
            $data['year_now'] = date("Y");
            $data['tahun_anggaran'] = $this->m_rpjmdes->get_tahun_byIdPeriode($id_periode);


            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tambah_detil_rpjmdes', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_detail_rpjmdes() {
        $id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
        $id_parent_rpjmdes = $this->input->post('id_parent_rpjmdes', TRUE);
        $id_top_rpjmdes = $this->input->post('id_top_rpjmdes', TRUE);
        $tahun = $this->input->post('tahun', TRUE);
        $volume = $this->input->post('volume', TRUE);
        $satuan = $this->input->post('satuan', TRUE);
        $nominal = $this->input->post('nominal', TRUE);
        $lokasi = $this->input->post('lokasi', TRUE);
        $tanggal = $this->input->post('tanggal', TRUE);

        $id_tahun_anggaran = $this->m_rpjmdes->getIdTahunAnggaran_ByTahun($tahun);

        if ($id_top_rpjmdes == null) {
            $id_top_rpjmdes = $id_rpjmdes;
        } else {
            $id_top_rpjmdes = $this->m_rpjmdes->getIdTopRpjmdes_ByIdRpjmdes($id_rpjmdes);
        }

        $this->form_validation->set_rules('volume', 'Volume', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'id_rpjmdes' => $id_rpjmdes,
                'id_tahun_anggaran' => $id_tahun_anggaran,
                'volume' => $volume,
                'satuan' => $satuan,
                'nominal' => $nominal,
                'lokasi' => $lokasi,
                'tanggal' => date('Y-m-d', strtotime($tanggal))
            );

            $this->m_rpjmdes->insertDetailRpjmdes($data);

            redirect('rencanaPembangunan/c_rpjmdes/show_detail_rpjmdes/' . $id_rpjmdes, 'refresh');
        } else
            $this->add_detail_rpjmdes($id_rpjmdes);
    }

    function show_tree_rpjmdes() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $treeview = $this->m_rpjmdes->getTreeview();

            $data['program_list'] = $this->treeview_rpjmdes->buildTree($treeview);

            $data['page_title'] = 'RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_tampil_tree_program', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function edit($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmdes'] = $id;
            $id_bidang = $this->m_rpjmdes->get_IdBidangByIdRpjmdes($id);

            $data['rpjmdes'] = $this->m_rpjmdes->getRowRpjmdes_ByIdRpjmdes($id);
            $data['json_array_bidang'] = $this->autocomplete_Bidang();
            $data['rpjmd'] = $this->m_rpjmdes->get_rpjmd();
            $data['periode'] = $this->m_rpjmdes->get_periode();
            $data['bidang'] = $this->m_rpjmdes->get_BidangByIdBidang($id_bidang);
            $data['page_title'] = 'EDIT DATA RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes/v_ubah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function update_rpjmdes() {
        $id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
        $program = $this->input->post('program', TRUE);
        $indikator = $this->input->post('indikator', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $capaian = $this->input->post('capaian', TRUE);
        $id_parent_rpjmdes = $this->input->post('id_parent_rpjmdes', TRUE);
        $id_top_rpjmdes = $this->input->post('id_top_rpjmdes', TRUE);
        $id_rpjmd = $this->input->post('id_rpjmd', TRUE);
        $id_periode = $this->input->post('id_periode', TRUE);
        $id_bidang = $this->input->post('id_bidang', TRUE);


        if ($id_parent_rpjmdes == '' && $id_top_rpjmdes == '') {
            $id_parent_rpjmdes = null;
            $id_top_rpjmdes = null;
        } else
            $id_parent_rpjmdes = $id_parent_rpjmdes;
        $id_top_rpjmdes = $id_top_rpjmdes;

        $this->form_validation->set_rules('program', 'program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_rpjmdes' => $id_rpjmdes,
                'program' => $program,
                'indikator' => $indikator,
                'kondisi_awal' => $kondisi_awal,
                'target' => $target,
                'capaian' => $capaian,
                'id_parent_rpjmdes' => $id_parent_rpjmdes,
                'id_top_rpjmdes' => $id_top_rpjmdes,
                'id_rpjmd' => $id_rpjmd,
                'id_periode' => $id_periode,
                'id_bidang' => $id_bidang
            );

            $result = $this->m_rpjmdes->updateRpjmdes(array('id_rpjmdes' => $id_rpjmdes), $data);
            if ($id_top_rpjmdes == '') { //kondisi dimana berada pada program level 1
                redirect('rencanaPembangunan/c_rpjmdes', 'refresh');
            } else { //kondisi dimana berada pada detil sub program
                redirect('rencanaPembangunan/c_rpjmdes/show_detail_program/' . $id_top_rpjmdes, 'refresh');
            }
        } else
            $this->edit($id_rpjmdes);
    }

    function delete() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_rpjmdes->deleteRpjmdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rpjmdes', 'refresh');
    }

    function delete_sub() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_rpjmdes->deleteRpjmdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rpjmdes/show_detail_program/' . $id, 'refresh');
    }

    function delete_detail() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_rpjmdes->deleteDetailRpjmdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rpjmdes/show_detail_rpjmdes/' . $id, 'refresh');
    }

    public function autocomplete_Bidang() {
        $deskripsi_bidang = $this->input->post('deskripsi_bidang', TRUE);
        $kode_bidang = $this->input->post('kode_bidang', TRUE);
        $rows = $this->m_rpjmdes->get_Bidang($deskripsi_bidang);
        $json_array = array();
        foreach ($rows as $row) {
            $json_array[] = $row->kode_bidang . ' - ' . $row->deskripsi;
        }
        return json_encode($json_array);
    }

    function FirstParent() {
        $first_parent = $this->m_rpjmdes->get_FirstParent();
        echo $first_parent;
    }

}

?>