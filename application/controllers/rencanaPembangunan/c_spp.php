<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_spp extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rabdes');
        $this->load->model('rencanaPembangunan/m_spp');
        $this->load->model('m_surat');
		
		//Load library print to pdf
		$this->load->helper('url');
		$this->load->config('pdf_config');
        $this->load->library('fpdf');
		$this->load->helper('date');
		$this->load->helper('text');
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		
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
        $colModel['id_spp'] = array('ID',30,TRUE,'center',0);
		$colModel['kegiatan'] = array('Kegiatan RABDes',275	,TRUE,'left',2);
		$colModel['tgl_ambil'] = array('Tanggal Ambil',170,TRUE,'left',2);
		//$colModel['id_rabdes'] = array('ID RABDes',170,TRUE,'left',2);
		
		$colModel['total'] = array('Total',100,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',110,FALSE,'center',0);
		
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_spp/load_data'),$colModel,'id_spp','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA SPP';
        $data['deskripsi_title'] = 'Surat Permintaan Pembayaran';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/spp/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	
	function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_rabdes','kegiatan');

		$this->flexigrid->validate_post('id_spp','ASC',$valid_fields);
		$records = $this->m_spp->get_spp_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_spp,
				$row->id_spp,
				$row->kegiatan,
				date('d-m-Y',strtotime($row->tgl_ambil)),
				'Rp '.$this->rupiah($row->total).',-',
				'
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_spp(\''.$row->id_spp.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detail SPP" onclick="show_spp_detail(\''.$row->id_spp.'\')"/><i class="fa fa-eye"></i></button>
				<button data-toggle="modal" href="#dialog-print" class="btn btn-primary btn-xs" title="Cetak SPP" onclick="cetak_spp(\''.$row->id_spp.'\')"/><i class="fa fa-print"></i></button>
				'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function show_spp_detail($id) {
        $colModel['id_spp_detail'] = array('ID',30,TRUE,'center',0);
		$colModel['tbl_rp_rabdes_anggaran.uraian'] = array('Uraian RABDes Anggaran',195,TRUE,'left',2);
		//$colModel['id_rabdes_anggaran'] = array('ID RABDes Anggaran',170,TRUE,'center',2);
		$colModel['pagu_anggaran'] = array('Pagu Anggaran',150,TRUE,'center',2);
		$colModel['pencairan_yg_lalu'] = array('Pencairan Yang Lalu',150,TRUE,'center',2);
		$colModel['permintaan_sekarang'] = array('Permintaan Sekarang',150,TRUE,'center',2);
		$colModel['jumlah_saat_ini'] = array('Jumlah Saat Ini',150,TRUE,'center',2);
		$colModel['sisa_dana'] = array('Sisa Dana',150,TRUE,'center',2);
		
		//$colModel['tgl_entry'] = array('tgl_entry',100,TRUE,'left',2);
		
        $colModel['aksi'] = array('AKSI',50,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Back','prev','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 213,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
		);
		$data['id'] = $id;
		$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id);
		$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id);
		$data['kegiatan'] = $this->m_rabdes->getKegiatan_ByIdRabdes($id_rabdes);
		$total = $this->m_spp->getTotal_ByIdSpp($id);
		$data['total'] = $this->rupiah($total);
		$data['rabdes'] = $this->m_rabdes->getRowRabdes_ByIdRabdes($id_rabdes);
		$data['rabdes_anggaran'] = $this->m_rabdes->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
        $grid_js = build_grid_js('flex_spp',site_url('rencanaPembangunan/c_spp/load_spp_detail/'.$id),$colModel,'id_spp_detail','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'SPP DETAIL';
        $data['deskripsi_title'] = 'Surat Permintaan Pembayaran';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/spp/v_tampil_spp_detail', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	function load_spp_detail($id) {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_spp_detail','pagu_anggaran','pencairan_yg_lalu','permintaan_sekarang','jumlah_saat_ini','sisa_dana','id_spp','tbl_rp_rabdes_anggaran.uraian');

		$this->flexigrid->validate_post('id_spp_detail','ASC',$valid_fields);
		
		$records = $this->m_spp->getSPP_detail_flexigrid_ById($id);
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
		
			$record_items[] = array(
				$row->id_spp_detail,
				$row->id_spp_detail,
				//$row->id_rabdes_anggaran,
				$row->uraian,
				'Rp '.$this->rupiah($row->pagu_anggaran).',-', 
				'Rp '.$this->rupiah($row->pencairan_yg_lalu).',-',
				'Rp '.$this->rupiah($row->permintaan_sekarang).',-',
				'Rp '.$this->rupiah($row->jumlah_saat_ini).',-',
				'Rp '.$this->rupiah($row->sisa_dana).',-',
				'
				<button data-toggle="modal" href="#dialog-print_edit" class="btn btn-default btn-xs" title="Edit" onclick="edit_spp_detail(\''.$row->id_spp_detail.'\')"/><i class="fa fa-pencil"></i></button>
				'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function add()
	{		
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		$id_pengguna 		= $session['hasil']->id_pengguna;
		$nik 				= $session['hasil']->nik;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			//$data['hasil'] = $nik;
			$data['page_title'] = 'TAMBAH SPP';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['rkpdes'] = $this->m_spp->get_rkpdes();
			$data['rabdes'] = $this->m_spp->get_rabdes();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_tambah', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_spp() 
	{
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		$id_rabdes = $this->input->post('id_rabdes', TRUE);
		//$kegiatan = $this->input->post('kegiatan', TRUE);
		$tgl_ambil = $this->input->post('tgl_ambil', TRUE);
		$total = $this->input->post('total', TRUE);
		
		$this->form_validation->set_rules('tgl_ambil', 'Tanggal Pengambilan', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{			
			$session['login'] = $this->session->userdata('logged_in');		
				$data = array(
					'tgl_ambil' => date('Y-m-d', strtotime($tgl_ambil)),
					'id_rabdes' => $id_rabdes
				);
				$this->m_spp->insertSpp($data);	
				
				redirect('rencanaPembangunan/c_spp','refresh');
			
        }
		else $this->add();
    }
	
	function json_a()
	{
		return '';
	}
	
	function edit($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_spp'] = $id;
			$data['page_title'] = 'EDIT SPP';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id);
			//$data['rkpdes'] = $this->m_spp->get_rkpdes();
			$data['rabdes'] = $this->m_spp->get_rabdes();
			
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id);
			$id_rkpdes = $this->m_spp->getIdRkpdes_ByIdRabdes($id_rabdes);
			$data['rkpdes'] = $this->m_spp->getRkpdes_ByIdRkpdes_dynamic($id_rkpdes);
			$id_tahun_anggaran = $this->m_spp->get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes);
			$data['tahun_anggaran'] = $this->m_spp->get_tahun_anggaran_dynamic($id_tahun_anggaran);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function update_spp() 
	{	
		$id_spp = $this->input->post('id_spp', TRUE);
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		$id_rabdes = $this->input->post('id_rabdes', TRUE);
		//$kegiatan = $this->input->post('kegiatan', TRUE);
		$tgl_ambil = $this->input->post('tgl_ambil', TRUE);
		$total = $this->input->post('total', TRUE);
		
		$this->form_validation->set_rules('tgl_ambil', 'Tanggal Pengambilan', 'required');

		$session['login'] = $this->session->userdata('logged_in');
		$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'id_spp' => $id_spp,
					'tgl_ambil' => date('Y-m-d', strtotime($tgl_ambil)),
					'id_rabdes' => $id_rabdes
					
				);
				$result = $this->m_spp->updateSpp(array('id_spp' => $id_spp), $data);	
					
			
				redirect('rencanaPembangunan/c_spp','refresh');
		}
		else $this->edit($id_spp);
    }
	
	function delete()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_spp->deleteSpp($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_spp', 'refresh');
    }
	
	function add_spp_detail($id){
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['id_spp'] = $id;
			$data['page_title'] = 'TAMBAH SPP DETAIL';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id);
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id);
			$id_rabdes_anggaran = $this->m_spp->getIdRabdesAnggaran_ByIdSpp($id);
			$data['rabdes_anggaran'] = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
			
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_tambah_spp_detail', $data, TRUE);
		
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_spp_detail() {
		$id_spp = $this->input->post('id_spp', TRUE);
		$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id_spp);
		$rabdes_anggaran = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
		
			foreach($rabdes_anggaran as $row)
			{
				$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran'.$row->id_rabdes_anggaran, TRUE);
				$permintaan_sekarang = $this->input->post('permintaan_sekarang'.$row->id_rabdes_anggaran, TRUE);
				$sisa_dana = $this->input->post('sisa_dana'.$row->id_rabdes_anggaran, TRUE);
				$cekbox = $this->input->post('cekbox'.$row->id_rabdes_anggaran);
				$pencairan_yg_lalu = $this->m_spp->getPencairanYangLalu_ByIdSpp($id_spp);
				/* if($pencairan_yg_lalu == '' or $pencairan_yg_lalu == null)
				{
					$pencairan_yg_lalu = 0;
				}
				else if ($pencairan_yg_lalu != '' or $pencairan_yg_lalu != null)
				{
					$permintaan_sekarang = $this->
					$pencairan_yg_lalu = $permintaan_sekarang;
				} */
				
				$pagu_anggaran = $this->m_spp->getJumlah_ByIdRabdesAnggaran($row->id_rabdes_anggaran);
				if($cekbox == true)
				{
					//$temp_sisa_dana = $this->m_spp->getSisaDana_ByIdRabdesAnggaran($row->id_rabdes_anggaran);
					//$temp_jumlah_saat_ini = $this->m_spp->getJumlahSaatIni_ByIdRabdesAnggaran($row->id_rabdes_anggaran);
					//$temp_sisa_dana = $this->m_spp->getSisaDana_ByIdRabdesAnggaran($row->id_rabdes_anggaran);
					//$temp_jumlah_saat_ini = $row->jumlah_saat_ini;
					//$temp_sisa_dana = $row->sisa_dana;
					//$jumlah_saat_ini = $temp_jumlah_saat_ini + ($pencairan_yg_lalu + $permintaan_sekarang);
					//$sisa_dana = ($pagu_anggaran - $permintaan_sekarang) - $temp_sisa_dana; */
					$data = array(
							'id_spp' => $id_spp,
							'id_rabdes_anggaran' => $id_rabdes_anggaran,
							'pagu_anggaran' => $pagu_anggaran,
							//'pencairan_yg_lalu' => $pencairan_yg_lalu,
							'permintaan_sekarang' => $permintaan_sekarang,
							//'jumlah_saat_ini' => $jumlah_saat_ini,
							//'sisa_dana' => $sisa_dana
						);
					$this->m_spp->insertSppDetail($data);
					
					$temp_total = $this->m_spp->getTotal_ByIdSpp($id_spp);
					$total = $permintaan_sekarang + $temp_total;
					$data1 = array(
							'id_spp' => $id_spp,
							'total' => $total
						);
					$result = $this->m_spp->updateSpp(array('id_spp' => $id_spp), $data1);
				}
			}
			
		redirect('rencanaPembangunan/c_spp/show_spp_detail/'.$id_spp,'refresh'); 
		
    }
	
	/* function add_spp_detail($id){
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['id_spp'] = $id;
			$data['page_title'] = 'TAMBAH SPP DETAIL (1)';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id);
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id);
			$data['rabdes_anggaran'] = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_tambah_spp_detail', $data, TRUE);
		
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    } */
	
	/* function simpan_spp_detail() {
		$id_spp = $this->input->post('id_spp', TRUE);
		//$jumlah = $this->input->post('jumlah', TRUE);
		$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran', TRUE);
		$id_rabdes_anggaran = json_decode($id_rabdes_anggaran);
		$array_uraian = array();
		foreach($id_rabdes_anggaran as $row)
		{
			$array_uraian[] = $row.' - '.$this->m_spp->getUraian_ByIdRabdesAnggaran($row);
		}

		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['id_spp'] = $id_spp;
			
			$id_spp = $this->input->post('id_spp', TRUE);
			//$jumlah = $this->input->post('jumlah', TRUE);
			//$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran', TRUE);
			//$id_rabdes_anggaran = json_decode($id_rabdes_anggaran);
			$data['id_rabdes_anggaran'] = $id_rabdes_anggaran;
			$data['uraian_rabdes_anggaran'] = $array_uraian;
			
			$data['page_title'] = 'TAMBAH SPP DETAIL (2)';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id_spp);
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id_spp);
			$data['rabdes_anggaran'] = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_tambah_lg_spp_detail', $data, TRUE);
		
			$this->load->view('utama', $data);
		}		
    } */
	
	/* function add2_spp_detail(){
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		
		
		/* if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['id_spp'] = $id;
			
			$id_spp = $this->input->post('id_spp', TRUE);
			//$jumlah = $this->input->post('jumlah', TRUE);
			//$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran', TRUE);
			$id_rabdes_anggaran = json_decode($id_rabdes_anggaran);
			$data['id_rabdes_anggaran'] = $id_rabdes_anggaran;
			
			$data['page_title'] = 'TAMBAH SPP DETAIL (2)';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id);
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id);
			$data['rabdes_anggaran'] = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_tambah_lg_spp_detail', $data, TRUE);
		
			$this->load->view('utama', $data);
		} 
		else
			redirect('c_login', 'refresh'); 
		*/
		
		/* foreach($id_rabdes_anggaran as $id)
		{
			$id;
			$pagu_anggaran = $this->m_spp->getJumlah_ByIdRabdesAnggaran($id);
			$data = array(
					'id_spp' => $id_spp,
					'id_rabdes_anggaran' => $id,
					'pagu_anggaran' => $pagu_anggaran
				);
			$this->m_spp->insertSppDetail($data);	
		}
		redirect('rencanaPembangunan/c_spp/show_spp_detail/'.$id_spp,'refresh'); 
    } */
	
	/* function simpan2_spp_detail() {
		$id_spp = $this->input->post('id_spp', TRUE);
		$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran', TRUE);
		$id_rabdes_anggaran = json_decode($id_rabdes_anggaran);
		$permintaan_sekarang = $this->input->post('permintaan_sekarang', TRUE);
		
		
		foreach($id_rabdes_anggaran as $id)
		{
			$id; 
			$pagu_anggaran = $this->m_spp->getJumlah_ByIdRabdesAnggaran($id_rabdes_anggaran);
			$data = array(
					'id_spp' => $id_spp,
					'id_rabdes_anggaran' => $id_rabdes_anggaran,
					'pagu_anggaran' => $pagu_anggaran,
					'permintaan_sekarang' => $permintaan_sekarang
				);
			$this->m_spp->insertSppDetail($data);	
		}
		redirect('rencanaPembangunan/c_spp/show_spp_detail/'.$id_spp,'refresh');
		
		//redirect('rencanaPembangunan/c_spp/show_spp_detail/'.$id_spp,'refresh');
    } */
	
	
	function edit_spp_detail($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_spp_detail'] = $id;
			$data['page_title'] = 'EDIT SPP';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$id_spp = $this->m_spp->getIdSpp_ByIdSppDetail($id);
			$data['spp_detail'] = $this->m_spp->getRowSppDetail_ByIdSppDetail($id);
			$data['spp'] = $this->m_spp->getRowSpp_ByIdSpp($id_spp);
			$id_rabdes = $this->m_spp->getIdRabdes_ByIdSpp($id_spp);
			$data['rabdes_anggaran'] = $this->m_spp->getRowRabdesAnggaran_ByIdRabdes($id_rabdes);
			$data['content'] = $this->load->view('rencanaPembangunan/spp/v_ubah_spp_detail', $data, TRUE);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function update_spp_detail() 
	{	
		$id_spp_detail = $this->input->post('id_spp_detail', TRUE);
		$id_spp = $this->input->post('id_spp', TRUE);
		$pagu_anggaran = $this->input->post('pagu_anggaran', TRUE);
		$permintaan_sekarang = $this->input->post('permintaan_sekarang', TRUE);
		$permintaan_sekarang1 = $this->m_spp->getPermintaanSekarang_ByIdSppDetail($id_spp_detail);
		$this->form_validation->set_rules('permintaan_sekarang', 'Permintaan Sekarang', 'required');

		$session['login'] = $this->session->userdata('logged_in');
		$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
		if ($this->form_validation->run() == TRUE)
		{
			$pagu_anggaran = $this->m_spp->getPaguAnggaran_ByIdSppDetail($id_spp_detail);
			$jumlah_saat_ini = $pagu_anggaran - $permintaan_sekarang;
			$sisa_dana = $pagu_anggaran - $permintaan_sekarang;
			$data = array(
					'id_spp_detail' => $id_spp_detail,
					'id_spp' => $id_spp,
					'permintaan_sekarang' => $permintaan_sekarang,
					'jumlah_saat_ini' => $jumlah_saat_ini,
					'sisa_dana' => $sisa_dana
				);
			$result = $this->m_spp->updateSppDetail(array('id_spp_detail' => $id_spp_detail), $data);	
			
			$temp_total = $this->m_spp->getTotal_ByIdSpp($id_spp);
			
			$total = ($temp_total - $permintaan_sekarang1) + $permintaan_sekarang;
			$data1 = array(
					'id_spp' => $id_spp,
					'total' => $total
				);
			$result = $this->m_spp->updateSpp(array('id_spp' => $id_spp), $data1);	
					
			
				redirect('rencanaPembangunan/c_spp/show_spp_detail/'.$id_spp,'refresh');
		}
		else $this->edit_spp_detail($id_spp);
    }
	
	function delete_spp_detail()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_spp->deleteSppDetail($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_spp', 'refresh');
    }
	
	// convert to view rupiah //
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
	
	
	function getRkpdesDynamic(){
		$id_rabdes = $this->input->post('id_rabdes');
		$id_rkpdes = $this->m_spp->getIdRkpdes_ByIdRabdes($id_rabdes);
		$data['rkpdes'] = $this->m_spp->getRkpdes_ByIdRkpdes_dynamic($id_rkpdes);
		$id_tahun_anggaran = $this->m_spp->get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes);
		$data['tahun_anggaran'] = $this->m_spp->get_tahun_anggaran_dynamic($id_tahun_anggaran);
		
		$this->load->view('rencanaPembangunan/spp/rkpdes_dynamic',$data);
	}
	
	// -------------------------------------------------------- PRINT SPP ------------------------------------------------- //
	// ------------------------------------------------------ PAGE PRINT HEADER ---------------------------------------------- //
	function Header($data)
	{
		$this->fpdf->Open();
		$this->fpdf->FPDF('P','mm','A4');
		//margin
		//first left
		//second up
		//third right
		//fourth bottom
		$this->fpdf->SetMargins(15,20,20,20);
		$this->fpdf->SetAutoPageBreak(false);
		$this->fpdf->AddPage();
		
		// ------------------------------------------------------ Logo ------------------------------------------------------- //
		//$image = base_url().'uploads/web/logo_kk.jpg';
		//$this->fpdf->Image($image,15,10); 
		// ---------------------------------------------------- End Logo ----------------------------------------------------- //
		
		// -------------------------------------------------- Judul Center --------------------------------------------------- //
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Cell(0,15,'SURAT PERMINTAAN PEMBAYARAN',0,0,'C');
		// --- Pindah Baris --- //
		$desa = strtoupper($this->m_surat->getDesa());
		$kecamatan = strtoupper($this->m_surat->getKecamatan());
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(0,0,'DESA '.$desa.' KECAMATAN '.$kecamatan,0,0,'C');
		// --- Pindah Baris --- //
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Ln(6);
		foreach($data['spp'] as $rows)
		{
			$id_spp = $rows->id_spp;
			$id_rabdes = $rows->id_rabdes;
			$id_tahun_anggaran = $this->m_spp->getIdTahunAnggaran_ByIdRabdes($id_rabdes);
			$tahun_anggaran = $this->m_rabdes->getTahunAnggaran_ByIdTahunAnggaran($id_tahun_anggaran);
			$this->fpdf->Cell(0,0,'TAHUN ANGGARAN '.$tahun_anggaran,0,0,'C');
		}
		// ----------------------------------------------- End Judul Center -------------------------------------------------- //
		
		// -------------------------------------------------- Judul Left ----------------------------------------------------- //
		foreach($data['spp'] as $rows)
		{
			$id_spp = $rows->id_spp;
			$id_rabdes = $rows->id_rabdes;
			
			$id_rkpdes = $this->m_spp->getIdRkpdes_ByIdRabdes($id_rabdes);
			$id_bidang = $this->m_spp->getIdBidang_byIdRkpdes($id_rkpdes);
			$bidang = strtoupper($this->m_spp->getBidang_byIdBidang($id_bidang));
			$kegiatan = strtoupper($this->m_spp->getKegiatan_byIdBidang($id_bidang));
			$tgl_ambil = date('d/m/Y', strtotime($rows->tgl_ambil));
			
			$this->fpdf->SetFont('Arial','',10);
			$this->fpdf->Ln(10);
			$this->fpdf->Cell(0,0,'1. BIDANG : '.$bidang,0,0,'L');
			// --- Pindah Baris --- //
			$this->fpdf->Ln(7);
			$this->fpdf->Cell(0,0,'2. KEGIATAN : '.$kegiatan,0,0,'L');
			// --- Pindah Baris --- //
			$this->fpdf->Ln(7);
			$this->fpdf->Cell(0,0,'3. WAKTU PELAKSANAAN : '.$tgl_ambil,0,0,'L');
		}
		// ------------------------------------------------- End Judul Left -------------------------------------------------- //
		
		$this->fpdf->Ln(10);
		$this->fpdf->Cell(0,0,'Rincian Pendanaan : ',0,0,'L');
		
	}
	// ------------------------------------------------- END PAGE PRINT HEADER ----------------------------------------------- //
	
	// --------------------------------------------------- PAGE PRINT CONTENT ------------------------------------------------ //
	function Content($data)
	{
		// ----- Content Header ----- //
		$this->fpdf->SetFont('Arial','B',9);
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(7,5,'No','LTR',0,'C',0); 						//1
		$this->fpdf->Cell(45,5,'URAIAN','LTR',0,'C',0);						//2
		$this->fpdf->Cell(27,5,'PAGU','LTR',0,'C',0);						//3
		$this->fpdf->Cell(27,5,'PENCAIRAN','LTR',0,'C',0);		//4
		$this->fpdf->Cell(27,5,'PERMINTAAN','LTR',0,'C',0);		//5
		$this->fpdf->Cell(27,5,'JUMLAH','LTR',0,'C',0);			//6
		$this->fpdf->Cell(27,5,'SISA','LTR',0,'C',0);					//7
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(7,5,' ','LRB',0,'C',0); 
		$this->fpdf->Cell(45,5,' ','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'ANGGARAN','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'S.D. YG LALU','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'SEKARANG','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'SAAT INI','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'DANA','LRB',0,'C',0);
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(7,5,' ','LRB',0,'C',0); 
		$this->fpdf->Cell(45,5,' ','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'(Rp.)','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'(Rp.)','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'(Rp.)','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'(Rp.)','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'(Rp.)','LRB',0,'C',0);
		/* 
		$this->fpdf->Ln();
		$this->fpdf->Cell(7,5,'1','LRB',0,'C',0);
		$this->fpdf->Cell(45,5,'2','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'3','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'4','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'5','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'6','LRB',0,'C',0);
		$this->fpdf->Cell(27,5,'7','LRB',0,'C',0);  */
		
		// ----- Content Body ----- //
		$this->fpdf->SetFont('Arial','',9);
		$i=0;
		foreach($data['spp_detail'] as $rows)
		{
			$i++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(7,5,$i,'LRB',0,'C',0);//Nomor
			$this->fpdf->Cell(45,5,' '.$rows->uraian,'LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->pagu_anggaran).',-','LRB',0,'J',0);//Uraian	
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->pencairan_yg_lalu).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->permintaan_sekarang).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->jumlah_saat_ini).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sisa_dana).',-','LRB',0,'J',0);//Uraian
		}
		// ----- End Content Body ----- //	

		// ----- Content Footer ----- //
		$this->fpdf->SetFont('Arial','B',9);
		$j=0;
		foreach($data['sum_spp_detail'] as $rows)
		{
			$j++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(52,5,'Jumlah','LTRB',0,'L',0);
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sum_pagu_anggaran).',-','LRB',0,'J',0);//Uraian	
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sum_pencarian_yg_lalu).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sum_permintaan_sekarang).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sum_jumlah_saat_ini).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(27,5,' Rp '.$this->rupiah($rows->sum_sisa_dana).',-','LRB',0,'J',0);//Uraian
		}
		// ----- End Content Footer ----- //
	}
	// ------------------------------------------------- END PAGE PRINT CONTENT ---------------------------------------------- //
	
	// --------------------------------------------------- PAGE PRINT FOOTER ------------------------------------------------- //
	function Footer($data)
	{
		// ----------------------- FOOTER LINE 1 ------------------------- //
		$tanggal = date("d/m/Y");
		$desa = $this->m_surat->getDesa();
		$kecamatan = strtoupper($this->m_surat->getKecamatan());
		$this->fpdf->SetFont('Arial','',10);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(0,0,$desa.', Tanggal '.$tanggal,0,0,'C');
		
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Telah Dilakukan Verifikasi',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'Pelaksana Kegiatan',0,0,'C');
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Sekretaris Desa',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'',0,0,'C');
		
		foreach($data['spp'] as $rows)
		{
			$nama_sekdes = $this->m_spp->getPerangkatDesa_ByJabatan('Sekretaris Desa');
			$nip_sekdes = $this->m_spp->getNipPerangkatDesa_ByJabatan('Sekretaris Desa');
			$id_rabdes = $rows->id_rabdes;
			$nik = $this->m_spp->getNik_ByIdRabdes($id_rabdes);
			$nama_pengguna = $this->m_spp->getNamaPengguna_ByNik($nik);
			
			$this->fpdf->SetFont('Arial','U',9);
			$this->fpdf->Ln(20);
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,$nama_sekdes,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,$nama_pengguna,0,0,'C');
			
			$this->fpdf->SetFont('Arial','B',9);
			$this->fpdf->Ln();
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,'NIP. '.$nip_sekdes,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,'NIK. '.$nik,0,0,'C');
		}
		// ----------------------- END FOOTER LINE 1 ------------------------- //
		
		// ----------------------- FOOTER LINE 2 ------------------------- //
		$this->fpdf->SetFont('Arial','',10);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Setuju Untuk Dibayarakan',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'Telah Dibayar Lunas',0,0,'C');
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Kepala Desa',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'Bendahara Desa',0,0,'C');
		
		foreach($data['spp'] as $rows)
		{
			$id_rabdes = $rows->id_rabdes;
			$id_perangkat = $this->m_spp->getIdPerangkat_ByIdRabdes($id_rabdes);
			$id_penduduk = $this->m_spp->getIdPenduduk_ByIdPerangkat($id_perangkat);
			
			$nama_kades = $this->m_spp->getNamaKades_ByIdPenduduk($id_penduduk);
			$nip = $this->m_spp->getNip_ByIdRabdes($id_rabdes);
			
			$nama_bendes = $this->m_spp->getPerangkatDesa_ByJabatan('Bendahara Desa');
			$nip_bendes = $this->m_spp->getNipPerangkatDesa_ByJabatan('Bendahara Desa');
			
			
			$this->fpdf->SetFont('Arial','U',9);
			$this->fpdf->Ln(20);
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,$nama_kades,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,$nama_bendes,0,0,'C');
			
			$this->fpdf->SetFont('Arial','B',9);
			$this->fpdf->Ln();
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,'NIP. '.$nip,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,'NIP. '.$nip_bendes,0,0,'C');
		}
		// ----------------------- END FOOTER LINE 2 ------------------------- //
	}
	// ---------------------------------------------/- END PAGE PRINT FOOTER ------------------------------------------------- //
	function cetak_spp($id) 
	{
		//$data['spp'] = $this->m_rabdes->getRabdes_ByIdRabdes($id);
		//$data['spp_detail'] = $this->m_rabdes->getRabdesAnggaran_ByIdRabdes($id);
		$data['spp'] = $this->m_spp->getSpp_ByIdSpp($id);
		$data['spp_detail'] = $this->m_spp->getSppDetail_ByIdSpp($id);
		$data['sum_spp_detail'] = $this->m_spp->getSppDetail_SUM_ByIdSpp($id);
		
		$this->Header($data);
		$this->Content($data);
		$this->Footer($data);
	
		foreach($data['spp'] as $rows)
		{
			$this->fpdf->Output();
		}
    }
	/*	
	
	
	
	*/
	/*
	
	
	
	
	
	
	
	
	function edit_rabdes_anggaran($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_rabdes_anggaran'] = $id;
			$id_rabdes = $this->m_rabdes->getIdRabdes_ByIdRabdesAnggaran($id);
			$data['page_title'] = 'EDIT RABDes ANGGARAN';
			$data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';
			$data['rabdes'] = $this->m_rabdes->getRowRabdes_ByIdRabdes($id_rabdes);
			$data['rabdes_anggaran'] = $this->m_rabdes->getRowRabdesAnggaran_ByIdRabdesAnggaran($id);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_ubah_rabdes_anggaran', $data, TRUE);
       
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function update_rabdes_anggaran() 
	{	
		$id_rabdes_anggaran = $this->input->post('id_rabdes_anggaran', TRUE);
		$id_rabdes = $this->input->post('id_rabdes', TRUE);
		$uraian = $this->input->post('uraian', TRUE);
		$volume = $this->input->post('volume', TRUE);
		$harga_satuan = $this->input->post('harga_satuan', TRUE);
		$jumlah = $this->input->post('jumlah', TRUE);
		$this->form_validation->set_rules('uraian', 'Uraian Kegiatan', 'required');
		
		$temp_jumlah = $this->m_rabdes->getJumlah_ByIdRabdesAnggaran($id_rabdes_anggaran);
		
		$session['login'] = $this->session->userdata('logged_in');
		$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
		if ($this->form_validation->run() == TRUE)
		{
		
			$data = array(
					'id_rabdes_anggaran' => $id_rabdes_anggaran,
					'id_rabdes' => $id_rabdes,
					'uraian' => $uraian,
					'volume' => $volume,
					'harga_satuan' => $harga_satuan,
					'jumlah' => $jumlah,
					'id_rabdes' => $id_rabdes,
					'id_pengguna' => $session['login']->id_pengguna
				);
			$result = $this->m_rabdes->updateRabdesAnggaran(array('id_rabdes_anggaran' => $id_rabdes_anggaran), $data);	
					
			$total = $this->m_rabdes->getTotal_ByIdRabdes($id_rabdes);
			$temp_total = ($total - $temp_jumlah) + $jumlah ;
			
			$data1 = array(
				'id_rabdes' => $id_rabdes,
				'total' => $temp_total
			);
			$result = $this->m_rabdes->updateRabdes(array('id_rabdes' => $id_rabdes), $data1);	
				
			
				redirect('rencanaPembangunan/c_rabdes/show_rabdes_anggaran/'.$id_rabdes,'refresh');
		}
		else $this->edit_rabdes_anggaran($id_rabdes_anggaran);
    }
	
	function deleteRabdesAnggaran($id)    
	{
		
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=1;
        foreach($post as $id){
            $this->m_rabdes->deleteRabdesAnggaran($id);		
				
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rabdes/show_rabdes_anggaran/'.$id, 'refresh');
    }
	
	
	
	function getKepalaDesa(){
		$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
		$id_perangkat = $data['kepalaDesa']->id_perangkat;
		$deskrispi = $data['kepalaDesa']->deskripsi;
		$nip = $data['kepalaDesa']->nip;
		$id_penduduk = $data['kepalaDesa']->id_penduduk;
		$nik = $data['kepalaDesa']->nip;
		echo $id_perangkat.' - '.$deskrispi.' - '.$nip.' - '.$id_penduduk.' - '.$nik;
	}
	
	
	
	*/
	
}
?>