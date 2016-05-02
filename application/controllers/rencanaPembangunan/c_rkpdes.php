<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rkpdes extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->library('treeview_rkpdes');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rkpdes');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh'); 
        	
    }

    
    function lists() {

        $colModel['id_rkpdes'] = array('ID',30,TRUE,'center',0);	
		$colModel['ref_rp_tahun_anggaran.tahun'] = array('Tahun',45,TRUE,'center',2);
		$colModel['ref_rp_bidang.kode_bidang'] = array('Kode Bidang',75,TRUE,'center',2);
		$colModel['ref_rp_coa.kode_rekening'] = array('No Rekening',75,TRUE,'center',2);
		$colModel['tbl_rp_rpjmdes.program'] = array('Program RPJMD',175,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.program'] = array('Program RKPDes',175,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.indikator'] = array('Indikator',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.kondisi_awal'] = array('Kondisi Awal',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.target'] = array('Target',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.lokasi'] = array('Lokasi',100,TRUE,'left',2);
		//$colModel['nominal'] = array('Nominal',100,TRUE,'left',2);
		//$colModel['sumber_dana'] = array('Sumber Dana',150,TRUE,'center',2);
        $colModel['aksi'] = array('AKSI',96,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_rkpdes/load_data'),$colModel,'id_rkpdes','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA RKPDes';
        $data['deskripsi_title'] = 'Rencana Kerja Pemerintah Desa';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
		
        $valid_fields = array(
				'id_rkpdes',
				'ref_rp_tahun_anggaran.tahun',
				'ref_rp_bidang.kode_bidang',
				'ref_rp_coa.kode_rekening',
				'tbl_rp_rpjmdes.program',
				'tbl_rp_rkpdes.program',
				'tbl_rp_rkpdes.indikator',
				'tbl_rp_rkpdes.kondisi_awal',
				'tbl_rp_rkpdes.target',
				'tbl_rp_rkpdes.lokasi'
				);

		$this->flexigrid->validate_post('id_rkpdes','ASC',$valid_fields);
		$records = $this->m_rkpdes->get_rkpdes_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			if($row->id_parent_rkpdes == null)
			{
			$record_items[] = array(
				$row->id_rkpdes,
				$row->id_rkpdes,
				$row->tahun_anggaran,
				$row->kode_bidang,
				$row->kode_rekening,
				$row->program_rpjmdes,
				$row->program_rkpdes,
				$row->indikator,
				$row->kondisi_awal,
				$row->target,
				$row->lokasi,
			//	'Rp '.$this->rupiah($row->nominal).',-',
			//	$row->sumber_dana,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil Program" onclick="show_detail_program(\''.$row->id_rkpdes.'\')"/><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-sitemap"></i></button>'
			);  
			}
			else
				$record_items[] = array(
				$row->id_rkpdes,
				$row->id_rkpdes,
				$row->kode_bidang,
				$row->kode_rekening,
				$row->program_rpjmdes,
				$row->program_rkpdes,
				$row->tahun_anggaran,
				$row->indikator,
				$row->kondisi_awal,
				$row->target,
				$row->lokasi,
				'Rp '.$this->rupiah($row->nominal).',-',
				$row->sumber_dana,
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
 
	function show_detail_program($id) {
		$colModel['id_rkpdes'] = array('ID',30,TRUE,'center',0);	
		$colModel['sub'] = array('Sub',30,TRUE,'center',0);
		//$colModel['id_parent_rkpdes'] = array('ID Parent',80,TRUE,'left',2);
		//$colModel['id_top_rkpdes'] = array('ID Top Parent',80,TRUE,'left',2);
		$colModel['ref_rp_tahun_anggaran.tahun'] = array('Tahun',45,TRUE,'center',0);
		$colModel['ref_rp_bidang.kode_bidang'] = array('Kode Bidang',75,TRUE,'center',0);
		$colModel['ref_rp_coa.kode_rekening'] = array('No Rekening',75,TRUE,'center',0);
		$colModel['tbl_rp_rpjmdes.program'] = array('Program RPJMD',175,TRUE,'left',0);
		$colModel['tbl_rp_rkpdes.program'] = array('Program RKPDes',175,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.indikator'] = array('Indikator',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.kondisi_awal'] = array('Kondisi Awal',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.target'] = array('Target',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.lokasi'] = array('Lokasi',100,TRUE,'left',2);
		$colModel['tbl_rp_rkpdes.nominal'] = array('Nominal',100,TRUE,'left',2);
		$colModel['ref_rp_sumber_dana.sumber_dana'] = array('Sumber Dana',150,TRUE,'center',2);
        $colModel['aksi'] = array('AKSI',98,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Back','prev','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
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
		//$data['id_rkpdes'] = $id;
		$data['id'] = $id;
		$data['program'] = $this->m_rkpdes->getProgram_ByIdRkpdes($id);
        $grid_js = build_grid_js('flex_program',site_url('rencanaPembangunan/c_rkpdes/load_program/'.$id),$colModel,'id_rkpdes','asc',$gridParams,$buttons);
																						
		$data['js_grid'] = $grid_js;
		
        $data['page_title'] = 'DETAIL PROGRAM RKPDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_tampil_detil_program', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_program($id) {	
		$this->load->library('flexigrid');
        $valid_fields = array(
				'tbl_rp_rkpdes.id_rkpdes',
				'ref_rp_tahun_anggaran.tahun',
				'ref_rp_bidang.kode_bidang',
				'ref_rp_coa.kode_rekening',
				'tbl_rp_rpjmdes.program',
				'tbl_rp_rkpdes.program',
				'tbl_rp_rkpdes.indikator',
				'tbl_rp_rkpdes.kondisi_awal',
				'tbl_rp_rkpdes.target',
				'tbl_rp_rkpdes.lokasi',
				'tbl_rp_rkpdes.nominal',
				'ref_rp_sumber_dana.sumber_dana'
				);
		
		$this->flexigrid->validate_post('id_rkpdes','ASC',$valid_fields);
		$records = $this->m_rkpdes->get_rkpdes_flexigrid_byIdRkpdes($id);
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			if($row->id_parent_rkpdes == null)
			{
			$record_items[] = array(
				$row->id_rkpdes,
				$row->id_rkpdes,
				'<input type="checkbox" onclick="return false" onkeydown="return false" />',
				//$row->id_parent_rkpdes,
				//$row->id_top_rkpdes,
				$row->tahun_anggaran,
				$row->kode_bidang,
				$row->kode_rekening,
				$row->program_rpjmdes,
				$row->program_rkpdes,
				$row->indikator,
				$row->kondisi_awal,
				$row->target,
				$row->lokasi,
				'Rp '.$this->rupiah($row->nominal).',-',
				$row->sumber_dana,
				
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\''.$row->id_rkpdes.'\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-warning btn-xs" title="Tampil Sub Program" onclick="show_tree_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-sitemap"></i></button>'
			);  
			}
			else
				$record_items[] = array(
				$row->id_rkpdes,
				$row->id_rkpdes,
				'<input type="checkbox" onclick="return false" onkeydown="return false" checked="checked"/>',
				//$row->id_parent_rkpdes,
				//$row->id_top_rkpdes,
				$row->tahun_anggaran,
				$row->kode_bidang,
				$row->kode_rekening,
				$row->program_rpjmdes,
				$row->program_rkpdes,
				$row->indikator,
				$row->kondisi_awal,
				$row->target,
				$row->lokasi,
				'Rp '.$this->rupiah($row->nominal).',-',
				$row->sumber_dana,
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Program" onclick="add_sub_program(\''.$row->id_rkpdes.'\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rkpdes(\''.$row->id_rkpdes.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items)); 
    }
	
	function show_detail_rkpdes($id){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{	
			$data['id_rkpdes'] = $id;
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_tampil_detil_program', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
    function add(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['page_title'] = 'TAMBAH DATA RKPDes';		
			$data['deskripsi_title'] = 'Rencana Kerja Pemerintah Desa';
			$data['rpjmdes'] = $this->m_rkpdes->get_rpjmdes();
			$data['json_array_bidang'] = $this->autocomplete_Bidang();
			$data['coa'] = $this->m_rkpdes->get_coa();
			$data['sumber_dana'] = $this->m_rkpdes->get_sumber_dana();
			//$data['tahun_anggaran'] = $this->m_rkpdes->get_tahun_anggaran();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
        
    }
	
	function simpan_rkpdes() {
		$program = $this->input->post('program', TRUE);
		$indikator = $this->input->post('indikator', TRUE);
		$kondisi_awal = $this->input->post('kondisi_awal', TRUE);
		$target = $this->input->post('target', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$nominal = $this->input->post('nominal', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
		$id_coa = $this->input->post('id_coa', TRUE);
		$deskripsi_bidang = $this->input->post('deskripsi_bidang',TRUE);
        $kode_bidang = $this->input->post('kode_bidang',TRUE);
        $id_sumber_dana = $this->input->post('id_sumber_dana',TRUE);
		$sisa_sumber_dana = $this->input->post('sisa_sumber_dana', TRUE);
		
		$id_bidang = $this->m_rkpdes->getIdBidangByKodeBidang($kode_bidang);
		
		$this->form_validation->set_rules('program', 'Nama Program', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_rkpdes->cekFIleExist($program);				
			
			if ($result['hasil'] == NULL) {				
				$data = array(
					'program' => $program,
					'indikator' => $indikator,
					'kondisi_awal' => $kondisi_awal,
					'target' => $target,
					'lokasi' => $lokasi,
					'nominal' => $nominal,
					'id_tahun_anggaran' => $id_tahun_anggaran,
					'id_rpjmdes' => $id_rpjmdes,
					'id_coa' => $id_coa,
					'id_sumber_dana' => $id_sumber_dana,
					'id_bidang' => $id_bidang
				);
				$this->m_rkpdes->insertRkpdes($data);	
					
				$data1 = array(
						'id_sumber_dana' => $id_sumber_dana,
						'nominal' => $sisa_sumber_dana
					);
				$this->m_rkpdes->updateSumberDana(array('id_sumber_dana' => $id_sumber_dana), $data1);
				redirect('rencanaPembangunan/c_rkpdes','refresh');
			}
			else $this->add();
			/* Handle ketika program rkpdes telah digunakan */
        }
		else $this->add();
    }
	
	function add_sub_program($id){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{	
			$data['id_rkpdes'] = $id;
			$id_rpjmdes = $this->m_rkpdes->getIdRpjmdes_ByIdRkpdes($id);
			$id_bidang = $this->m_rkpdes->getIdBidang_ByIdRkpdes($id);
			$id_sumber_dana = $this->m_rkpdes->getIdSumberDana_ByIdRkpdes($id);
			$id_periode = $this->m_rkpdes->getIdPeriode_ByIdRpjmdes($id_rpjmdes);
			
			$data['rkpdes'] = $this->m_rkpdes->getRowRkpdes_ByIdRkpdes($id);
			$data['bidang'] = $this->m_rkpdes->getRowBidang_ByIdBidang($id_bidang);
			$data['sumber_dana1'] = $this->m_rkpdes->getRowSumberDana_ByIdSumberDana($id_sumber_dana);
			
			$data['rpjmdes'] = $this->m_rkpdes->get_rpjmdes();
			$data['page_title'] = 'TAMBAH DATA RKPDes';		
			$data['deskripsi_title'] = 'Rencana Kerja Pemerintah Desa';
			$data['json_array_bidang'] = $this->autocomplete_Bidang();
			$data['coa'] = $this->m_rkpdes->get_coa();
			$data['tahun_anggaran'] = $this->m_rkpdes->get_tahun_anggaran_dynamic($id_periode);
			$data['sumber_dana'] = $this->m_rkpdes->get_sumber_dana();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_tambah_sub_program', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_sub_program() {
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		$id_parent_rkpdes = $this->input->post('id_parent_rkpdes', TRUE);
		$id_top_rkpdes = $this->input->post('id_top_rkpdes', TRUE);
		$sub_program = $this->input->post('sub_program', TRUE);
		$indikator = $this->input->post('indikator', TRUE);
		$kondisi_awal = $this->input->post('kondisi_awal', TRUE);
		$target = $this->input->post('target', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$nominal = $this->input->post('nominal', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		
		$id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
		$id_coa = $this->input->post('id_coa', TRUE);
		$deskripsi_bidang = $this->input->post('deskripsi_bidang',TRUE);
        $kode_bidang = $this->input->post('kode_bidang',TRUE);
        $id_sumber_dana = $this->input->post('id_sumber_dana',TRUE);
		$sisa_sumber_dana = $this->input->post('sisa_sumber_dana', TRUE);
		$id_bidang = $this->m_rkpdes->getIdBidangByKodeBidang($kode_bidang);
		
		
		if($id_top_rkpdes == null)
		{
			$id_top_rkpdes = $id_rkpdes;
		}
		else
		{
			$id_top_rkpdes = $this->m_rkpdes->getIdTopRkpdes_ByIdRkpdes($id_rkpdes);
		}
		
		$this->form_validation->set_rules('sub_program', 'Nama Sub Program', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_rkpdes->cekFIleExist($sub_program);				
			
			if ($result['hasil'] == NULL) 
			{				
				$data = array(
					'id_parent_rkpdes' => $id_rkpdes,
					'id_top_rkpdes' => $id_top_rkpdes,
					'program' => $sub_program,
					'indikator' => $indikator,
					'kondisi_awal' => $kondisi_awal,
					'target' => $target,
					'lokasi' => $lokasi,
					'nominal' => $nominal,
					'id_tahun_anggaran' => $id_tahun_anggaran,
					'id_rpjmdes' => $id_rpjmdes,
					'id_coa' => $id_coa,
					'id_sumber_dana' => $id_sumber_dana,
					'id_bidang' => $id_bidang
					
				);
				$this->m_rkpdes->insertRkpdes($data);
				if(!$id_top_rkpdes == null)
				{
					redirect('rencanaPembangunan/c_rkpdes/show_detail_program/'.$id_top_rkpdes,'refresh');
				}
				else
				{
					redirect('rencanaPembangunan/c_rkpdes/show_detail_program/'.$id_rkpdes,'refresh');
				}
			}			
			else $this->add_sub_program($id_rkpdes);
			/* Handle ketika program rkpdes telah digunakan */
        }
		else $this->add_sub_program($id_rkpdes);
    }

	function show_tree_rkpdes(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{	
			$treeview = $this->m_rkpdes->getTreeview();
			
			$data['program_list'] = $this->treeview_rkpdes->buildTree($treeview);
			
			$data['page_title'] = 'PROGRAM RKPDes';
			$data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_tampil_tree_program', $data, TRUE);
		
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
    function edit($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_rkpdes'] = $id;
			$id_rpjmdes = $this->m_rkpdes->getIdRpjmdes_ByIdRkpdes($id);
			$id_bidang = $this->m_rkpdes->getIdBidang_ByIdRkpdes($id);
			$id_sumber_dana = $this->m_rkpdes->getIdSumberDana_ByIdRkpdes($id);
			$id_periode = $this->m_rkpdes->getIdPeriode_ByIdRpjmdes($id_rpjmdes);
			
			$data['rkpdes'] = $this->m_rkpdes->getRowRkpdes_ByIdRkpdes($id);
			$data['bidang'] = $this->m_rkpdes->getRowBidang_ByIdBidang($id_bidang);
			$data['sumber_dana1'] = $this->m_rkpdes->getRowSumberDana_ByIdSumberDana($id_sumber_dana);
			
			$data['rpjmdes'] = $this->m_rkpdes->get_rpjmdes();
			$data['page_title'] = 'TAMBAH DATA RKPDes';		
			$data['deskripsi_title'] = 'Rencana Kerja Pemerintah Desa';
			$data['json_array_bidang'] = $this->autocomplete_Bidang();
			$data['coa'] = $this->m_rkpdes->get_coa();
			$data['tahun_anggaran'] = $this->m_rkpdes->get_tahun_anggaran_dynamic($id_periode);
			$data['sumber_dana'] = $this->m_rkpdes->get_sumber_dana();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rkpdes/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_rkpdes() 
	{	
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		$id_parent_rkpdes = $this->input->post('id_parent_rkpdes', TRUE);
		$id_top_rkpdes = $this->input->post('id_top_rkpdes', TRUE);
		$program = $this->input->post('program', TRUE);
		$indikator = $this->input->post('indikator', TRUE);
		$kondisi_awal = $this->input->post('kondisi_awal', TRUE);
		$target = $this->input->post('target', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$nominal = $this->input->post('nominal', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$id_rpjmdes = $this->input->post('id_rpjmdes', TRUE);
		$id_coa = $this->input->post('id_coa', TRUE);
		$deskripsi_bidang = $this->input->post('deskripsi_bidang',TRUE);
        $kode_bidang = $this->input->post('kode_bidang',TRUE);
        $id_sumber_dana = $this->input->post('id_sumber_dana',TRUE);
		$sisa_sumber_dana = $this->input->post('sisa_sumber_dana', TRUE);
		
		$id_bidang = $this->m_rkpdes->getIdBidangByKodeBidang($kode_bidang);
		
		if($id_parent_rkpdes == '' && $id_top_rkpdes =='')
		{
			$id_parent_rkpdes = null;
			$id_top_rkpdes = null;
		}
		else
			$id_parent_rkpdes = $id_parent_rkpdes;
			$id_top_rkpdes = $id_top_rkpdes;
		
		$this->form_validation->set_rules('program', 'program', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		
			$data = array(
					'id_rkpdes' => $id_rkpdes,
					'id_parent_rkpdes' => $id_parent_rkpdes,
					'id_top_rkpdes' => $id_top_rkpdes,
					'program' => $program,
					'indikator' => $indikator,
					'kondisi_awal' => $kondisi_awal,
					'target' => $target,
					'lokasi' => $lokasi,
					'nominal' => $nominal,
					'id_tahun_anggaran' => $id_tahun_anggaran,
					'id_rpjmdes' => $id_rpjmdes,
					'id_coa' => $id_coa,
					'id_sumber_dana' => $id_sumber_dana,
					'id_bidang' => $id_bidang
				);
				$result = $this->m_rkpdes->updateRkpdes(array('id_rkpdes' => $id_rkpdes), $data);	
					
				$data1 = array(
						'id_sumber_dana' => $id_sumber_dana,
						'nominal' => $sisa_sumber_dana
					);
				$this->m_rkpdes->updateSumberDana(array('id_sumber_dana' => $id_sumber_dana), $data1);
				
			if($id_top_rkpdes == '') //kondisi dimana berada pada program level 1
			{
				redirect('rencanaPembangunan/c_rkpdes','refresh');
			}
			else //kondisi dimana berada pada detil sub program
			{
				redirect('rencanaPembangunan/c_rkpdes/show_detail_program/'.$id_top_rkpdes,'refresh');
			}
		}
		else $this->edit($id_rkpdes);
    }
	
	function delete()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_rkpdes->deleteRkpdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rkpdes', 'refresh');
    }
	
	function delete_sub()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_rkpdes->deleteRkpdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rkpdes/show_detail_program/'.$id,'refresh');
    }
	function rupiah($data) 
	{  
		$rupiah = "";  
		$jml = strlen($data);  
		while ($jml > 3) 
		{  
			$rupiah = "." . substr($data, -3) . $rupiah; 
			$l = strlen($data) - 3;  
			$data = substr($data, 0, $l);  
			$jml = strlen($data);  
		}  
		$rupiah = $data . $rupiah;  
		return $rupiah;  
    }
		
	function getTahunAnggaran(){	
		$id_rpjmdes = $this->input->post('id_rpjmdes');
		$id_periode = $this->m_rkpdes->getIdPeriode_ByIdRpjmdes($id_rpjmdes);
		$data['tahun_anggaran'] = $this->m_rkpdes->get_tahun_anggaran_dynamic($id_periode);
		$this->load->view('rencanaPembangunan/rkpdes/tahun',$data);
	}
	
	function GetNominalSumberDana(){	
		$id_sumber_dana = $this->input->post('id_sumber_dana');
		$id_rkpdes = $this->m_rkpdes->getIdRkpdes_ByIdSumberDana($id_sumber_dana);
		$nominal = $this->m_rkpdes->getNominal_ByIdRkpdes($id_rkpdes);
		$nominal_sumber_dana =  $this->m_rkpdes->get_nominal_sumber_dana($id_sumber_dana);
		if(!$nominal == $nominal)
		{
			$data['nominal_sumber_dana'] = $nominal_sumber_dana + $nominal;
		}
		else
		{
			$data['nominal_sumber_dana'] = $this->m_rkpdes->get_nominal_sumber_dana($id_sumber_dana);
		}
		$this->load->view('rencanaPembangunan/rkpdes/nominal_sumber_dana',$data);
	}
	
	
	public function autocomplete_Bidang()
    {
        $deskripsi_bidang = $this->input->post('deskripsi_bidang',TRUE);
        $kode_bidang = $this->input->post('kode_bidang',TRUE);
        $rows = $this->m_rkpdes->get_Bidang($deskripsi_bidang);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->kode_bidang.' - '.$row->deskripsi;
		}
        return json_encode($json_array);
    }
	
	
	function FirstParent()
	{
		$first_parent = $this->m_rkpdes->get_FirstParent();
		echo $first_parent;
	}
	
	
}
?>