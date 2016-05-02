<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rabdes extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rabdes');
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
        $colModel['id_rabdes'] = array('ID',30,TRUE,'center',0);
		$colModel['tbl_rp_rkpdes.program'] = array('Program RKPDes',200,TRUE,'left',2);
		//$colModel['id_rkpdes'] = array('Program RKPDes',170,TRUE,'left',2);
		$colModel['kegiatan'] = array('Kegiatan',244,TRUE,'left',2);
		$colModel['ref_rp_tahun_anggaran.tahun'] = array('Tahun Anggaran',100,TRUE,'center',2);
		$colModel['waktu_pelaksanaan_awal'] = array('Pelaksanaan Awal',130,TRUE,'center',2);
		$colModel['waktu_pelaksanaan_akhir'] = array('Pelaksanaan Akhir',130,TRUE,'center',2);
		$colModel['total'] = array('Total',100,TRUE,'left',2);
		//$colModel['id_tahun_anggaran'] = array('Tahun Anggaran',100,TRUE,'left',2);
		//-- just cek
		/* $colModel['id_pengguna'] = array('ID_User',100,TRUE,'left',2);
		$colModel['nik'] = array('NIK',100,TRUE,'left',2);
		$colModel['id_perangkat'] = array('ID_perangkat',100,TRUE,'left',2);
		$colModel['nip'] = array('nip',100,TRUE,'left',2);
		$colModel['tgl_entry'] = array('tgl_entry',100,TRUE,'left',2); */
		//--
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_rabdes/load_data'),$colModel,'id_rabdes','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA RABDes';
        $data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_rabdes','tbl_rp_rkpdes.program','kegiatan','ref_rp_tahun_anggaran.tahun','waktu_pelaksanaan_awal','waktu_pelaksanaan_akhir','total');

		$this->flexigrid->validate_post('id_rabdes','ASC',$valid_fields);
		$records = $this->m_rabdes->getRabdesFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_rabdes,
				$row->id_rabdes,
				$row->program_rkpdes,
				$row->kegiatan,
				$row->tahun_anggaran,
				date('d-m-Y',strtotime($row->waktu_pelaksanaan_awal)),
				date('d-m-Y',strtotime($row->waktu_pelaksanaan_akhir)),
				'Rp '.$this->rupiah($row->total).',-',
				//-- just cek
				/* $row->id_pengguna,
				$row->nik,
				$row->id_perangkat,
				$row->nip,
				$row->tgl_entry, */
				//--
				'
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rabdes(\''.$row->id_rabdes.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detail RABDes" onclick="show_rabdes_anggaran(\''.$row->id_rabdes.'\')"/><i class="fa fa-eye"></i></button>
				<button data-toggle="modal" href="#dialog-print" class="btn btn-primary btn-xs" title="Cetak RABDes" onclick="cetak_rabdes(\''.$row->id_rabdes.'\')"/><i class="fa fa-print"></i></button>
				'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function show_rabdes_anggaran($id) {
        $colModel['id_rabdes_anggaran'] = array('ID',30,TRUE,'center',0);
		$colModel['uraian'] = array('Uraian Kegiatan',170,TRUE,'center',2);
		$colModel['volume'] = array('Volume',100,TRUE,'center',2);
		$colModel['harga_satuan'] = array('Harga Satuan',130,TRUE,'center',2);
		$colModel['jumlah'] = array('Jumlah',130,TRUE,'center',2);
		
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
		
		$data['kegiatan'] = $this->m_rabdes->getKegiatan_ByIdRabdes($id);
		$total = $this->m_rabdes->getTotal_ByIdRabdes($id);
		$data['total'] = $this->rupiah($total);
		$data['rabdes'] = $this->m_rabdes->getRowRabdes_ByIdRabdes($id);
		$data['rabdes_anggaran'] = $this->m_rabdes->getRowRabdesAnggaran_ByIdRabdes($id);
        $grid_js = build_grid_js('flex_rabdes',site_url('rencanaPembangunan/c_rabdes/load_rabdes_anggaran/'.$id),$colModel,'id_rabdes_anggaran','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'RINCIAN RABDes';
        $data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_tampil_rabdes_anggaran', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	function load_rabdes_anggaran($id) {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_rabdes_anggaran','uraian','volume','harga_satuan','jumlah');

		$this->flexigrid->validate_post('id_rabdes','ASC',$valid_fields);
		$records = $this->m_rabdes->getRabdesAnggaranFlexigridByIdRabdes($id);
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_rabdes_anggaran,
				$row->id_rabdes_anggaran,
				//$row->kegiatan,
				$row->uraian,
				$row->volume,
				'Rp '.$this->rupiah($row->harga_satuan).',-',
				'Rp '.$this->rupiah($row->jumlah).',-',
				//$row->tgl_entry,
				'
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_rabdes_anggaran(\''.$row->id_rabdes_anggaran.'\')"/><i class="fa fa-pencil"></i></button>
				'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function add(){		
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		$id_pengguna 		= $session['hasil']->id_pengguna;
		$nik 				= $session['hasil']->nik;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			//$data['hasil'] = $nik;
			$data['page_title'] = 'TAMBAH RABDes';
			$data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';
			$data['rkpdes'] = $this->m_rabdes->get_rkpdes();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_rabdes() {
		$kegiatan = $this->input->post('kegiatan', TRUE);
		$waktu_pelaksanaan_awal = $this->input->post('waktu_pelaksanaan_awal', TRUE);
		$waktu_pelaksanaan_akhir = $this->input->post('waktu_pelaksanaan_akhir', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		
		$id_tahun_anggaran = $this->m_rabdes->get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes);
		
		$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_rabdes->cekFIleExist($kegiatan);				
			$session['login'] = $this->session->userdata('logged_in');
			$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
			if ($result['hasil'] == NULL) {				
				$data = array(
					'kegiatan' => $kegiatan,
					'waktu_pelaksanaan_awal' => date('Y-m-d', strtotime($waktu_pelaksanaan_awal)),
					'waktu_pelaksanaan_akhir' => date('Y-m-d', strtotime($waktu_pelaksanaan_akhir)),
					'id_tahun_anggaran' => $id_tahun_anggaran,
					'id_rkpdes' => $id_rkpdes,
					'id_pengguna' => $session['login']->id_pengguna,
					'nik' =>$session['login']->nik,
					'id_perangkat' =>$data['kepalaDesa']->id_perangkat,
					'nip' =>$data['kepalaDesa']->nip
					
				);
				$this->m_rabdes->insertRabdes($data);	
				
				redirect('rencanaPembangunan/c_rabdes','refresh');
			}
			else $this->add();
			/* Handle ketika program rkpdes telah digunakan */
        }
		else $this->add();
    }
	
	function edit($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_rabdes'] = $id;
			$data['page_title'] = 'TAMBAH RABDes';
			$data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';
			$data['rkpdes'] = $this->m_rabdes->get_rkpdes();
			$data['rabdes'] = $this->m_rabdes->getRowRabdes_ByIdRabdes($id);
			$data['tahun'] = $this->m_rabdes->get_tahun_anggaran();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function update_rabdes() 
	{	
		$id_rabdes = $this->input->post('id_rabdes', TRUE);
		$kegiatan = $this->input->post('kegiatan', TRUE);
		$waktu_pelaksanaan_awal = $this->input->post('waktu_pelaksanaan_awal', TRUE);
		$waktu_pelaksanaan_akhir = $this->input->post('waktu_pelaksanaan_akhir', TRUE);
		//$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$id_rkpdes = $this->input->post('id_rkpdes', TRUE);
		$id_tahun_anggaran = $this->m_rabdes->get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes);
		$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('waktu_pelaksanaan_awal', 'Pelaksanaan Awal', 'required');
		$this->form_validation->set_rules('waktu_pelaksanaan_akhir', 'Pelaksanaan Akhir', 'required');

		$session['login'] = $this->session->userdata('logged_in');
		$data['kepalaDesa'] = $this->m_rabdes->getRow_KepalaDesa();
		if ($this->form_validation->run() == TRUE)
		{
		
			$data = array(
					'id_rabdes' => $id_rabdes,
					'kegiatan' => $kegiatan,
					'waktu_pelaksanaan_awal' => date('Y-m-d', strtotime($waktu_pelaksanaan_awal)),
					'waktu_pelaksanaan_akhir' => date('Y-m-d', strtotime($waktu_pelaksanaan_akhir)),
					'id_tahun_anggaran' => $id_tahun_anggaran,
					'id_rkpdes' => $id_rkpdes,
					'id_pengguna' => $session['login']->id_pengguna,
					'nik' => $session['login']->nik,
					'id_perangkat' => $data['kepalaDesa']->id_perangkat,
					'nip' => $data['kepalaDesa']->nip
				);
				$result = $this->m_rabdes->updateRabdes(array('id_rabdes' => $id_rabdes), $data);	
					
			
				redirect('rencanaPembangunan/c_rabdes','refresh');
		}
		else $this->edit($id_rabdes);
    }
	
	function delete()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_rabdes->deleteRabdes($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rabdes', 'refresh');
    }
	
	function add_rabdes_anggaran($id){
		$session['hasil'] 	= $this->session->userdata('logged_in');
		$role 				= $session['hasil']->role;
		
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			//$data['hasil'] = $nik;
			$data['id_rabdes'] = $id;
			$data['page_title'] = 'TAMBAH RABDes ANGGARAN';
			$data['deskripsi_title'] = 'Rencana Anggaran Belanja Desa';
			$data['rabdes'] = $this->m_rabdes->getRowRabdes_ByIdRabdes($id);
			$data['rabdes_anggaran'] = $this->m_rabdes->getRowRabdesAnggaran_ByIdRabdes($id);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/rabdes/v_tambah_rabdes_anggaran', $data, TRUE);
		
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_rabdes_anggaran() {
		$id_rabdes = $this->input->post('id_rabdes', TRUE);
		$uraian = $this->input->post('uraian', TRUE);
		$volume = $this->input->post('volume', TRUE);
		$harga_satuan = $this->input->post('harga_satuan', TRUE);
		$jumlah = $this->input->post('jumlah', TRUE);
		$id_rabdes = $this->input->post('id_rabdes');

		$jumlah = $harga_satuan * $volume;
		$this->form_validation->set_rules('uraian', 'Uraian Kegiatan', 'required');
		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_rabdes->cekFIleExist($uraian);				
			$session['login'] = $this->session->userdata('logged_in');
			if ($result['hasil'] == NULL) {				
				$data = array(
					'uraian' => $uraian,
					'volume' => $volume,
					'harga_satuan' => $harga_satuan,
					'jumlah' => $jumlah,
					'id_rabdes' => $id_rabdes,
					'id_pengguna' => $session['login']->id_pengguna
					
				);
				$this->m_rabdes->insertRabdesAnggaran($data);	
				
				$total = $this->m_rabdes->getTotal_ByIdRabdes($id_rabdes);
				$temp_total = $jumlah + $total;
				
				$data1 = array(
					'id_rabdes' => $id_rabdes,
					'total' => $temp_total
				);
				$result = $this->m_rabdes->updateRabdes(array('id_rabdes' => $id_rabdes), $data1);	
				
				redirect('rencanaPembangunan/c_rabdes/show_rabdes_anggaran/'.$id_rabdes,'refresh');
			}
			else $this->add_rabdes_anggaran();
        }
		else $this->add_rabdes_anggaran();
    }
	
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
	
	function delete_rabdes_anggaran($id)    
	{
		
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=1;
        foreach($post as $id){
            $this->m_rabdes->deleteRabdesAnggaran($id);		
				
            $sucess++;
        }
        redirect('rencanaPembangunan/c_rabdes/show_rabdes_anggaran/'.$id, 'refresh');
    }
	
	function getTahunAnggaran(){	
		$id_rkpdes = $this->input->post('id_rkpdes');
		$id_tahun_anggaran = $this->m_rabdes->get_IdTahunAnggaran_ByIdRkpdes($id_rkpdes);
		$data['tahun_anggaran'] = $this->m_rabdes->get_tahun_anggaran_dynamic($id_tahun_anggaran);
		$this->load->view('rencanaPembangunan/rabdes/tahun',$data);
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
	
	// -------------------------------------------------------- PRINT RABDes ------------------------------------------------- //
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
		$this->fpdf->SetMargins(20,20,20,20);
		$this->fpdf->SetAutoPageBreak(false);
		$this->fpdf->AddPage();
		
		// ------------------------------------------------------ Logo ------------------------------------------------------- //
		//$image = base_url().'uploads/web/logo_kk.jpg';
		//$this->fpdf->Image($image,15,10); 
		// ---------------------------------------------------- End Logo ----------------------------------------------------- //
		
		// -------------------------------------------------- Judul Center --------------------------------------------------- //
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Cell(0,15,'RENCANA ANGGARAN BIAYA',0,0,'C');
		// --- Pindah Baris --- //
		$desa = strtoupper($this->m_surat->getDesa());
		$kecamatan = strtoupper($this->m_surat->getKecamatan());
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(0,0,'DESA '.$desa.' KECAMATAN '.$kecamatan,0,0,'C');
		// --- Pindah Baris --- //
		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Ln(6);
		foreach($data['rabdes'] as $rows)
		{
			$tahun_anggaran = $this->m_rabdes->getTahunAnggaran_ByIdTahunAnggaran($rows->id_tahun_anggaran);
			$this->fpdf->Cell(0,0,'TAHUN ANGGARAN '.$tahun_anggaran,0,0,'C');
		}
		// ----------------------------------------------- End Judul Center -------------------------------------------------- //
		
		// -------------------------------------------------- Judul Left ----------------------------------------------------- //
		foreach($data['rabdes'] as $rows)
		{
			$id_rkpdes = $rows->id_rkpdes;
			$id_bidang = $this->m_rabdes->getIdBidang_byIdRkpdes($id_rkpdes);
			$bidang = strtoupper($this->m_rabdes->getBidang_byIdBidang($id_bidang));
			$kegiatan = strtoupper($this->m_rabdes->getKegiatan_byIdBidang($id_bidang));
			$waktu_pelaksanaan_awal = date('d/m/Y', strtotime($rows->waktu_pelaksanaan_awal));
			$waktu_pelaksanaan_akhir = date('d/m/Y', strtotime($rows->waktu_pelaksanaan_akhir));
			
			$this->fpdf->SetFont('Arial','',10);
			$this->fpdf->Ln(10);
			$this->fpdf->Cell(0,0,'1. BIDANG : '.$bidang,0,0,'L');
			// --- Pindah Baris --- //
			$this->fpdf->Ln(7);
			$this->fpdf->Cell(0,0,'2. KEGIATAN : '.$kegiatan,0,0,'L');
			// --- Pindah Baris --- //
			$this->fpdf->Ln(7);
			$this->fpdf->Cell(0,0,'3. WAKTU PELAKSANAAN : '.$waktu_pelaksanaan_awal.' - '.$waktu_pelaksanaan_akhir,0,0,'L');
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
		$this->fpdf->Cell(10,5,'No','LTR',0,'C',0);
		$this->fpdf->Cell(80,5,'Uraian','LTR',0,'C',0);
		$this->fpdf->Cell(15,5,'Volume','LTR',0,'C',0);
		$this->fpdf->Cell(30,5,'Harga Satuan','LTR',0,'C',0);
		$this->fpdf->Cell(35,5,'Jumlah','LTR',0,'C',0);
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(10,5,' ','LRB',0,'C',0); 
		$this->fpdf->Cell(80,5,' ','LRB',0,'C',0);
		$this->fpdf->Cell(15,5,' ','LRB',0,'C',0);
		$this->fpdf->Cell(30,5,'(Rp.)','LRB',0,'C',0);
		$this->fpdf->Cell(35,5,'(Rp.)','LRB',0,'C',0);
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(10,5,'1','LRB',0,'C',0);
		$this->fpdf->Cell(80,5,'2','LRB',0,'C',0);
		$this->fpdf->Cell(15,5,'3','LRB',0,'C',0);
		$this->fpdf->Cell(30,5,'4','LRB',0,'C',0);
		$this->fpdf->Cell(35,5,'5','LRB',0,'C',0);
		// ----- End Content Header ----- //
		
		// ----- Content Body ----- //
		$this->fpdf->SetFont('Arial','',9);
		$i=0;
		foreach($data['rabdes_anggaran'] as $rows)
		{
			$i++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(10,5,$i,'LRB',0,'C',0);//Nomor
			$this->fpdf->Cell(80,5,' '.$rows->uraian,'LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(15,5,$rows->volume,'LRB',0,'J',0);//Uraian	
			$this->fpdf->Cell(30,5,' Rp '.$this->rupiah($rows->harga_satuan).',-','LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(35,5,' Rp '.$this->rupiah($rows->jumlah).',-','LRB',0,'J',0);//Uraian
		}
		// ----- End Content Body ----- //	

		// ----- Content Footer ----- //
		$this->fpdf->SetFont('Arial','B',9);
		$j=0;
		foreach($data['rabdes'] as $rows)
		{
			$j++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(135,5,'Jumlah','LTRB',0,'L',0);
			$this->fpdf->Cell(35,5,' Rp '.$this->rupiah($rows->total).',-','LTRB',0,'J',0);//Uraian
		}
		// ----- End Content Footer ----- //
	}
	// ------------------------------------------------- END PAGE PRINT CONTENT ---------------------------------------------- //
	
	// --------------------------------------------------- PAGE PRINT FOOTER ------------------------------------------------- //
	function Footer($data)
	{
		$tanggal = date("d/m/Y");
		$desa = $this->m_surat->getDesa();
		$kecamatan = strtoupper($this->m_surat->getKecamatan());
		$this->fpdf->SetFont('Arial','',10);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(0,0,$desa.', Tanggal '.$tanggal,0,0,'C');
		
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Disetujui / mengesahkan',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'Pelaksana Kegiatan',0,0,'C');
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(30);
		$this->fpdf->Cell(1,5,'Kepala Desa',0,0,'C');
		$this->fpdf->Cell(110);
		$this->fpdf->Cell(1,5,'',0,0,'C');
		
		foreach($data['rabdes'] as $rows)
		{
			$id_perangkat = $rows->id_perangkat;
			$id_penduduk = $this->m_rabdes->getIdPenduduk_ByIdPerangkat($id_perangkat);
			$nama_kades = $this->m_rabdes->getNamaKades_ByIdPenduduk($id_penduduk);
			$nip = $rows->nip;
			
			$id_pengguna = $rows->id_pengguna;
			$nik = $rows->nik;
			$nama_pengguna = $this->m_rabdes->getNamaPengguna_ByNik($nik);
			
			
			$this->fpdf->SetFont('Arial','U',9);
			$this->fpdf->Ln(25);
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,$nama_kades,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,$nama_pengguna,0,0,'C');
			
			$this->fpdf->SetFont('Arial','B',9);
			$this->fpdf->Ln();
			$this->fpdf->Cell(30);
			$this->fpdf->Cell(1,5,'NIP. '.$nip,0,0,'C');
			$this->fpdf->Cell(110);
			$this->fpdf->Cell(1,5,'NIK. '.$nik,0,0,'C');
		}
	}
	// ---------------------------------------------/- END PAGE PRINT FOOTER ------------------------------------------------- //
	function cetak_rabdes($id) 
	{
		$data['rabdes'] = $this->m_rabdes->getDataRabdesByIdRabdes($id);
		$data['rabdes_anggaran'] = $this->m_rabdes->getDataRabdesAnggaranByIdRabdes($id);
		
		$this->Header($data);
		$this->Content($data);
		$this->Footer($data);
	
		foreach($data['rabdes'] as $rows)
		{
			$this->fpdf->Output();
		}
    }
}
?>