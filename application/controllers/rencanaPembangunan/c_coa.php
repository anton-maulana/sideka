<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_coa extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_coa');
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
        $colModel['id_coa'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['kode_rekening'] = array('Kode Rekening', 100, TRUE, 'left', 2);
        $colModel['deskripsi'] = array('Deskripsi', 220, TRUE, 'left', 2);
        //$colModel['id_parent_coa'] = array('Id Parent',100,TRUE,'left',2);
        //$colModel['id_top_coa'] = array('Id Top',100,TRUE,'left',2);
        //$colModel['level'] = array('Level',100,TRUE,'left',2);
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

        $grid_js = build_grid_js('flex1', site_url('rencanaPembangunan/c_coa/load_data'), $colModel, 'id_coa', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA KODE REKENING';
        $data['deskripsi_title'] = '';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/coa/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_coa', 'kode_rekening');

        $this->flexigrid->validate_post('id_coa', 'ASC', $valid_fields);
        $records = $this->m_coa->get_coa_flexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_coa == null) {
                $record_items[] = array(
                    $row->id_coa,
                    $row->id_coa,
                    $row->kode_rekening,
                    $row->deskripsi,
                    //		$row->id_parent_coa,
                    //		$row->id_top_coa,
                    //		$row->level,
                    '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil Kode Rekening" onclick="show_detail_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-eye"></i></button>
				'
                );
            } else
                $record_items[] = array(
                    $row->id_coa,
                    $row->id_coa,
                    $row->kode_rekening,
                    $row->deskripsi,
                    //		$row->id_parent_coa,
                    //		$row->id_top_coa,
                    //		$row->level,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Kode_rekening" onclick="add_sub_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-pencil"></i></button>'
                );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function show_detail_coa($id) {
        $colModel['id_coa'] = array('ID', 30, TRUE, 'center', 0);
        $colModel['kode_rekening'] = array('Kode Rekening', 100, TRUE, 'left', 2);
        $colModel['deskripsi'] = array('Deskripsi', 350, TRUE, 'left', 2);
        //	$colModel['id_parent_coa'] = array('Id Parent',100,TRUE,'left',2);
        //	$colModel['id_top_coa'] = array('Id Top',100,TRUE,'left',2);
        $colModel['level'] = array('Level', 50, TRUE, 'CENTER', 2);
        $colModel['aksi'] = array('AKSI', 115, FALSE, 'center', 0);

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
            'height' => 310,
            'rp' => 20,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
        );
        //$data['id_coa'] = $id;
        $data['id_coa'] = $id;
        $data['kode_rekening'] = $this->m_coa->getKodeRekening_ByIdCoa($id);
        $data['deskripsi'] = $this->m_coa->getDeskripsi_ByIdCoa($id);
        $grid_js = build_grid_js('flex_coa', site_url('rencanaPembangunan/c_coa/load_detail_coa/' . $id), $colModel, 'id_coa', 'asc', $gridParams, $buttons);

        $data['js_grid'] = $grid_js;

        $data['page_title'] = 'DETAIL KODE REKENING';
        $data['deskripsi_title'] = '';
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/coa/v_tampil_detil_coa', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_detail_coa($id) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_coa', 'kode_rekening');

        $this->flexigrid->validate_post('id_coa', 'ASC', $valid_fields);
        $records = $this->m_coa->get_coa_flexigrid_byIdCoa($id);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            if ($row->id_parent_coa == null) {
                $record_items[] = array(
                    $row->id_coa,
                    $row->id_coa,
                    $row->kode_rekening,
                    $row->deskripsi,
                    //		$row->id_parent_coa,
                    //		$row->id_top_coa,
                    $row->level,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Kode_rekening" onclick="add_sub_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-plus-square"></i></button>'
                );
            } 
            else if ($row->level > 6) {
                $record_items[] = array(
                    $row->id_coa,
                    $row->id_coa,
                    $row->kode_rekening,
                    $row->deskripsi,
                    //		$row->id_parent_coa,
                    //		$row->id_top_coa,
                    $row->level,
                    '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-pencil"></i></button>
				'
                );
            }
            else
                $record_items[] = array(
                    $row->id_coa,
                    $row->id_coa,
                    $row->kode_rekening,
                    $row->deskripsi,
                    //		$row->id_parent_coa,
                    //		$row->id_top_coa,
                    $row->level,
                    '<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Kode_rekening" onclick="add_sub_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_coa(\'' . $row->id_coa . '\')"/><i class="fa fa-pencil"></i></button>'
                );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    function add() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['page_title'] = 'TAMBAH DATA KODE REKENING';
            $data['deskripsi_title'] = '';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/coa/v_tambah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_coa() {
        $kode_rekening = $this->input->post('kode_rekening', TRUE);
        $deskripsi = $this->input->post('deskripsi', TRUE);
        $id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
        $id_coa = $this->input->post('id_coa', TRUE);

        $this->form_validation->set_rules('kode_rekening', 'Nama Kode_rekening', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_coa->cekFIleExist($kode_rekening);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'kode_rekening' => $kode_rekening,
                    'deskripsi' => $deskripsi,
                    'id_coa' => $id_coa,
                    'level' => '1'
                );

                $this->m_coa->insertCoa($data);
                redirect('rencanaPembangunan/c_coa', 'refresh');
            } else
                $this->add();
            /* Handle ketika kode_rekening coa telah digunakan */
        } else
            $this->add();
    }

    function add_sub_coa($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_coa'] = $id;
            $id_coa = $this->m_coa->getId_ByIdCoa($id);
            $data['page_title'] = 'TAMBAH SUB KODE REKENING';
            $data['deskripsi_title'] = '';
            $data['coa'] = $this->m_coa->getRowCoa_ByIdCoa($id);
            $data['deskripsi_coa'] = $this->m_coa->getDeskripsi_ByIdCoa($id_coa);
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/coa/v_tambah_sub_coa', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function simpan_sub_coa() {
        $kode_rekening = $this->input->post('kode_rekening', TRUE);
        $sub_kode_rekening = $this->input->post('sub_kode_rekening', TRUE);
        $sub_deskripsi = $this->input->post('sub_deskripsi', TRUE);
        $id_coa = $this->input->post('id_coa', TRUE);
        $id_parent_coa = $this->input->post('id_parent_coa', TRUE);
        $id_top_coa = $this->input->post('id_top_coa', TRUE);
        $level = $this->input->post('level', TRUE);

        if ($id_top_coa == null) {
            $id_top_coa = $id_coa;
        } else {
            $id_top_coa = $this->m_coa->getIdTopCoa_ByIdCoa($id_coa);
        }

        $this->form_validation->set_rules('sub_kode_rekening', 'Nama Sub Kode Rekening', 'required');

        if ($this->form_validation->run() == TRUE) {
            $result['hasil'] = $this->m_coa->cekFIleExist($sub_kode_rekening);

            if ($result['hasil'] == NULL) {
                $data = array(
                    'kode_rekening' => $sub_kode_rekening,
                    'id_parent_coa' => $id_coa,
                    'deskripsi' => $sub_deskripsi,
                    'id_top_coa' => $id_top_coa,
                    'level' => $level + 1
                );
                $this->m_coa->insertCoa($data);
                if (!$id_top_coa == null) {
                    redirect('rencanaPembangunan/c_coa/show_detail_coa/' . $id_top_coa, 'refresh');
                } else {
                    redirect('rencanaPembangunan/c_coa/show_detail_coa/' . $id_coa, 'refresh');
                }
            } else
                $this->add_sub_coa($id_coa);
            /* Handle ketika kode_rekening coa telah digunakan */
        } else
            $this->add_sub_coa($id_coa);
    }

    function show_tree_coa() {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            //$data['id_coa'] = $id;
            //$data['coa'] = $this->m_coa->getResultCoaByIdCoa($id);
            //$data['coa_tes'] = $this->m_coa->getResultCoaByIdCoa($id);
            //$data['coa_num_row'] = $this->m_coa->getNumRowCoaByIdCoa($id);

            $data['kode_rekening_list'] = $this->m_coa->get_kode_rekening();
            $data['subkode_rekening_list'] = $this->m_coa->get_subkode_rekening();

            $data['page_title'] = 'PROGRAM RPJMDes';
            $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/coa/v_tampil_tree_kode_rekening', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function edit($id) {
        $session['hasil'] = $this->session->userdata('logged_in');
        $role = $session['hasil']->role;
        if ($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan') {
            $data['id_coa'] = $id;
            $data['coa'] = $this->m_coa->getRowCoa_ByIdCoa($id);
            $data['page_title'] = 'EDIT DATA KODE REKENING';
            $data['deskripsi_title'] = '';
            $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
            $data['content'] = $this->load->view('rencanaPembangunan/coa/v_ubah', $data, TRUE);

            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

    function update_coa() {
        $id_coa = $this->input->post('id_coa', TRUE);
        $kode_rekening = $this->input->post('kode_rekening', TRUE);
        $deskripsi = $this->input->post('deskripsi', TRUE);
        $id_parent_coa = $this->input->post('id_parent_coa', TRUE);
        $id_top_coa = $this->input->post('id_top_coa', TRUE);
        $level = $this->input->post('level', TRUE);

        if ($id_parent_coa == '' && $id_top_coa == '') {
            $id_parent_coa = null;
            $id_top_coa = null;
        } else
            $id_parent_coa = $id_parent_coa;
        $id_top_coa = $id_top_coa;

        $this->form_validation->set_rules('kode_rekening', 'kode_rekening', 'required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_coa' => $id_coa,
                'kode_rekening' => $kode_rekening,
                'deskripsi' => $deskripsi,
                'id_top_coa' => $id_top_coa,
                'level' => $level
            );

            $result = $this->m_coa->updateCoa(array('id_coa' => $id_coa), $data);
            if ($id_top_coa == '') { //kondisi dimana berada pada kode_rekening level 1
                redirect('rencanaPembangunan/c_coa', 'refresh');
            } else { //kondisi dimana berada pada detil sub kode_rekening
                redirect('rencanaPembangunan/c_coa/show_detail_coa/' . $id_top_coa, 'refresh');
            }
        } else
            $this->edit($id_coa);
    }

    function delete() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_coa->deleteCoa($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_coa', 'refresh');
    }

    function delete_sub() {
        $post = explode(",", $this->input->post('items'));
        array_pop($post);
        $sucess = 0;
        foreach ($post as $id) {
            $this->m_coa->deleteCoa($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_coa/show_detail_coa/' . $id, 'refresh');
    }

}

?>