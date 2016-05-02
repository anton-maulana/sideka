<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_rpjmd extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->library('treeview_rpjmd');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rpjmd');
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
        $colModel['id_rpjmd'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['program'] = array('Program Kegiatan', 220, TRUE, 'left', 2);
        $colModel['kondisi_awal'] = array('Kondisi Awal', 220, TRUE, 'left', 2);
        $colModel['target'] = array('Target', 220, TRUE, 'left', 2);
        $colModel['id_tahun_anggaran'] = array('Tahun Anggaran', 120, TRUE, 'center', 2);
        $colModel['aksi'] = array('AKSI', 120, FALSE, 'center', 0);

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

        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_rpjmd/load_data'), $colModel, 'id_rpjmd', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA RPJMD';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_rpjmd', 'program');

        $this->flexigrid->validate_post('id_rpjmd', 'ASC', $valid_fields);
        $records = $this->m_rpjmd->getRpjmdFlexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_rpjmd == null) {
                $record_items[] = array(
                    $row->id_rpjmd,
                    $row->id_rpjmd,
                    $row->program,
                    $row->kondisi_awal,
                    $row->target,
                    $row->deskripsi,
                    '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmd(\'' . $row->id_rpjmd . '\')"/>
				<i class="fa fa-pencil"></i>
				</button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil Program" onclick="show_detail_program(\'' . $row->id_rpjmd . '\')"/>
				<i class="fa fa-eye"></i>
				</button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rpjmd(\'' . $row->id_rpjmd . '\')"/>
				<i class="fa fa-sitemap"></i>
				</button>'
                );
            } else
                $record_items[] = array(
                    $row->id_rpjmd,
                    $row->id_rpjmd,
                    $row->program,
                    $row->kondisi_awal,
                    $row->target,
                    $row->deskripsi,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\'' . $row->id_rpjmd . '\')"/>
				<i class="fa fa-plus-square"></i>
				</button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmd(\'' . $row->id_rpjmd . '\')"/>
				<i class="fa fa-pencil"></i>
				</button>'
                );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function show_detail_program($id) {
        $colModel['id_rpjmd'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['program'] = array('Program Kegiatan', 220, TRUE, 'left', 2);
        $colModel['kondisi_awal'] = array('Kondisi Awal', 220, TRUE, 'left', 2);
        $colModel['target'] = array('Target', 220, TRUE, 'left', 2);
        $colModel['id_parent_rpjmd'] = array('ID Parent', 80, TRUE, 'left', 2);
        //$colModel['id_top_rpjmd'] = array('ID Top Parent',80,TRUE,'left',2);
        $colModel['id_tahun_anggaran'] = array('Tahun Anggaran', 120, TRUE, 'center', 2);
        $colModel['aksi'] = array('AKSI', 70, FALSE, 'center', 0);

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
        //$data['id_rpjmd'] = $id;
        $data['id'] = $id;
        $data['program'] = $this->m_rpjmd->getProgram_ByIdRpjmd($id);
        $grid_js = build_grid_js('flex_program', site_url('rencanaPembangunan/c_rpjmd/load_program/' . $id), $colModel, 'id_rpjmd', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DETAIL PROGRAM RPJMD';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_tampil_detil_program', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_program($id) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_rpjmd', 'program');

        $this->flexigrid->validate_post('id_rpjmd', 'ASC', $valid_fields);
        $records = $this->m_rpjmd->getRpjmdFlexigridByIdRpjmd($id);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_rpjmd == null) {
                $record_items[] = array(
                    $row->id_rpjmd,
                    $row->id_rpjmd,
                    $row->program,
                    $row->kondisi_awal,
                    $row->target,
                    $row->id_parent_rpjmd,
                    //$row->id_top_rpjmd,
                    $row->deskripsi,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\'' . $row->id_rpjmd . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rpjmd(\'' . $row->id_rpjmd . '\')"/><i class="fa fa-sitemap"></i></button>'
                );
            } else
                $record_items[] = array(
                    $row->id_rpjmd,
                    $row->id_rpjmd,
                    $row->program,
                    $row->kondisi_awal,
                    $row->target,
                    $row->id_parent_rpjmd,
                    //$row->id_top_rpjmd,
                    $row->deskripsi,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\'' . $row->id_rpjmd . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rpjmd(\'' . $row->id_rpjmd . '\')"/><i class="fa fa-pencil"></i></button>'
                );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function show_detail_rpjmd($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmd'] = $id;
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_tampil_detil_program', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function add() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['page_title'] = 'TAMBAH DATA RPJMD';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
            $data['tahun_anggaran'] = $this->m_rpjmd->get_tahun_anggaran();
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_tambah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_rpjmd() {
        $program = $this->input->post('program', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);

        $this->form_validation->set_rules('program', 'Nama Program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_rpjmd->cekFIleExist($program);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'program' => $program,
                    'kondisi_awal' => $kondisi_awal,
                    'target' => $target,
                    'id_tahun_anggaran' => $id_tahun_anggaran
                );

                $this->m_rpjmd->insertRpjmd($data);
                redirect('rencanaPembangunan/c_rpjmd', 'refresh');
            } else
                $this->add();
            /* Handle ketika program rpjmd telah digunakan */
        } else
            $this->add();
    }

    function add_sub_program($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmd'] = $id;
            $data['page_title'] = 'TAMBAH SUB PROGRAM RPJMD';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
            $data['tahun_anggaran'] = $this->m_rpjmd->get_tahun_anggaran();
            $data['rpjmd'] = $this->m_rpjmd->getRowRpjmd_ByIdRpjmd($id);
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_tambah_sub_program', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_sub_program() {
        $id_rpjmd = $this->input->post('id_rpjmd', TRUE);
        $program = $this->input->post('program', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $id_parent_rpjmd = $this->input->post('id_parent_rpjmd', TRUE);
        $id_top_rpjmd = $this->input->post('id_top_rpjmd', TRUE);
        $id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);

        if ($id_top_rpjmd == null) {
            $id_top_rpjmd = $id_rpjmd;
        } else {
            $id_top_rpjmd = $this->m_rpjmd->getIdTopRpjmd_ByIdRpjmd($id_rpjmd);
        }

        $this->form_validation->set_rules('program', 'Nama Sub Program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_rpjmd->cekFIleExist($program);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'program' => $program,
                    'kondisi_awal' => $kondisi_awal,
                    'target' => $target,
                    'id_parent_rpjmd' => $id_rpjmd,
                    'id_top_rpjmd' => $id_top_rpjmd,
                    'id_tahun_anggaran' => $id_tahun_anggaran
                );
                $this->m_rpjmd->insertRpjmd($data);
                if (!$id_top_rpjmd == null) {
                    redirect('rencanaPembangunan/c_rpjmd/show_detail_program/' . $id_top_rpjmd, 'refresh');
                } else {
                    redirect('rencanaPembangunan/c_rpjmd/show_detail_program/' . $id_rpjmd, 'refresh');
                }
            } else
                $this->add_sub_program($id_rpjmd);
            /* Handle ketika program rpjmd telah digunakan */
        } else
            $this->add_sub_program($id_rpjmd);
    }

    function show_tree_rpjmd() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $treeview = $this->m_rpjmd->getTreeview();

            $data['program_list'] = $this->treeview_rpjmd->buildTree($treeview);

            $data['page_title'] = 'RPJMD';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_tampil_tree_program', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function edit($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_rpjmd'] = $id;
            $data['rpjmd'] = $this->m_rpjmd->getRowRpjmd_ByIdRpjmd($id);
            //$data['hasil'] = $this->m_rpjmd->getRpjmdByIdRpjmd($id);
            $data['page_title'] = 'EDIT DATA RPJMD';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Daerah';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/rpjmd/v_ubah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function update_rpjmd() {
        $id_rpjmd = $this->input->post('id_rpjmd', TRUE);
        $program = $this->input->post('program', TRUE);
        $kondisi_awal = $this->input->post('kondisi_awal', TRUE);
        $target = $this->input->post('target', TRUE);
        $id_parent_rpjmd = $this->input->post('id_parent_rpjmd', TRUE);
        $id_top_rpjmd = $this->input->post('id_top_rpjmd', TRUE);

        if ($id_parent_rpjmd == '' && $id_top_rpjmd == '') {
            $id_parent_rpjmd = null;
            $id_top_rpjmd = null;
        } else
            $id_parent_rpjmd = $id_parent_rpjmd;
        $id_top_rpjmd = $id_top_rpjmd;

        $this->form_validation->set_rules('program', 'program', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_rpjmd' => $id_rpjmd,
                'program' => $program,
                'kondisi_awal' => $kondisi_awal,
                'target' => $target,
                'id_parent_rpjmd' => $id_parent_rpjmd,
                'id_top_rpjmd' => $id_top_rpjmd
            );

            $result = $this->m_rpjmd->updateRpjmd(array('id_rpjmd' => $id_rpjmd), $data);
            if ($id_top_rpjmd == '') { //kondisi dimana berada pada program level 1
                redirect('rencanaPembangunan/c_rpjmd', 'refresh');
            } else { //kondisi dimana berada pada detil sub program
                redirect('rencanaPembangunan/c_rpjmd/show_detail_program/' . $id_top_rpjmd, 'refresh');
            }
        } else
            $this->edit($id_rpjmd);
    }

    function delete() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_rpjmd->deleteRpjmd($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rpjmd', 'refresh');
    }

    function delete_sub() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_rpjmd->deleteRpjmd($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rpjmd/show_detail_program/' . $id, 'refresh');
    }

    function FirstParent() {
        $first_parent = $this->m_rpjmd->get_FirstParent();
        echo $first_parent;
    }

}

?>