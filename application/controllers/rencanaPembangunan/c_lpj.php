<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_lpj extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rabdes');
        $this->load->model('rencanaPembangunan/m_spp');
        $this->load->model('rencanaPembangunan/m_lpj');
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
        $colModel['id_lpj'] = array('ID',40,TRUE,'center',0);
        $colModel['id_spp'] = array('ID',40,TRUE,'center',0);
        $colModel['kegiatan'] = array('Kegiatan',200,TRUE,'left',0);
		$colModel['penerima'] = array('Penerima',275,TRUE,'left',2);
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_lpj/load_data'),$colModel,'id_lpj','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA LPJ';
        $data['deskripsi_title'] = 'Laporan Penanggungjawaban';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/lpj/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	
	function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_lpj','penerima');

		$this->flexigrid->validate_post('id_lpj','ASC',$valid_fields);
		$records = $this->m_lpj->get_lpj_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_lpj,
				$row->id_lpj,
				$row->id_spp,
				$row->kegiatan,
				$row->penerima,
				'
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_lpj(\''.$row->id_lpj.'\')"/><i class="fa fa-pencil"></i></button>
				<button data-toggle="modal" href="#dialog-print" class="btn btn-primary btn-xs" title="Cetak LPJ" onclick="cetak_lpj(\''.$row->id_lpj.'\')"/><i class="fa fa-print"></i></button>
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
			$data['page_title'] = 'TAMBAH LPJ';
			$data['deskripsi_title'] = 'Laporan Penanggungjawaban';
			$data['spp'] = $this->m_lpj->get_spp();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/lpj/v_tambah', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_lpj() 
	{
		$id_spp = $this->input->post('id_spp', TRUE);
		$penerima = $this->input->post('penerima', TRUE);
		
		
		$session['login'] = $this->session->userdata('logged_in');		
		$data = array(
			'id_spp' => $id_spp,
			'penerima' => $penerima
		);
		$this->m_lpj->insertLpj($data);	
			
		redirect('rencanaPembangunan/c_lpj','refresh');
    }
	
	function edit($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_lpj'] = $id;
			$data['page_title'] = 'EDIT SPP';
			$data['deskripsi_title'] = 'Surat Permintaan Pembayaran';
			$id_spp = $this->m_lpj->getIdSpp_ByIdLpj($id);
			$data['spp1'] = $this->m_spp->getRowSpp_ByIdSpp($id_spp);
			$data['lpj'] = $this->m_lpj->getRowLpj_ByIdLpj($id);
			$data['spp'] = $this->m_lpj->get_spp();

			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/lpj/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
	function update_lpj() 
	{	
		$id_lpj = $this->input->post('id_lpj', TRUE);
		$id_spp = $this->input->post('id_spp', TRUE);
		$penerima = $this->input->post('penerima', TRUE);

		$session['login'] = $this->session->userdata('logged_in');
	
			$data = array(
					'id_lpj' => $id_lpj,
					'id_spp' => $id_spp,
					'penerima' => $penerima
					
				);
				$result = $this->m_lpj->updateLpj(array('id_lpj' => $id_lpj), $data);	
					
			
				redirect('rencanaPembangunan/c_lpj','refresh');

    }
	
	function delete()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_lpj->deleteLpj($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_lpj', 'refresh');
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
		$this->fpdf->Cell(0,15,'LAPORAN PENANGGUNGJAWABAN',0,0,'C');
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
			
			$this->fpdf->SetFont('Arial','',12);
			$this->fpdf->Ln(10);
			$this->fpdf->Cell(0,0,'1. BIDANG : '.$bidang,0,0,'L');
			// --- Pindah Baris --- //
			$this->fpdf->Ln(7);
			$this->fpdf->Cell(0,0,'2. KEGIATAN : '.$kegiatan,0,0,'L');
			// --- Pindah Baris --- //
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
		$this->fpdf->SetFont('Arial','B',10);
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(7,5,'No','LTR',0,'C',0); 						//1
		$this->fpdf->Cell(50,5,'PENERIMA','LTR',0,'C',0);				//2
		$this->fpdf->Cell(75,5,'URAIAN','LTR',0,'C',0);					//3
		$this->fpdf->Cell(45,5,'JUMLAH','LTR',0,'C',0);					//4
			
		$this->fpdf->Ln();
		$this->fpdf->Cell(7,5,' ','LRB',0,'C',0); 
		$this->fpdf->Cell(50,5,' ','LRB',0,'C',0);
		$this->fpdf->Cell(75,5,'','LRB',0,'C',0);
		$this->fpdf->Cell(45,5,'(Rp)','LRB',0,'C',0);
		// ----- End Content Header ----- //	
		
		// ----- Content Body ----- //
		$this->fpdf->SetFont('Arial','',10);
		$i=0;
		foreach($data['lpj'] as $rows)
		{
			$i++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(7,5,$i,'LRB',0,'C',0);//Nomor
			$this->fpdf->Cell(50,5,' '.$rows->penerima,'LRB',0,'J',0);//Uraian
			$this->fpdf->Cell(75,5,' '.$rows->kegiatan,'LRB',0,'J',0);//Uraian	
			$this->fpdf->Cell(5,5,' Rp','LB',0,'L',0);
			$this->fpdf->Cell(40,5,''.$this->rupiah($rows->total).',-','RB',0,'R',0);//Uraian
		}
		// ----- End Content Body ----- //	

		// ----- Content Footer ----- //
		$this->fpdf->SetFont('Arial','B',10);
		$j=0;
		foreach($data['lpj'] as $rows) 	
		{
			$j++;
			$this->fpdf->Ln();
			$this->fpdf->Cell(132,5,'Jumlah','LTRB',0,'L',0);
			$this->fpdf->Cell(5,5,' Rp','LB',0,'L',0);
			$this->fpdf->Cell(40,5,''.$this->rupiah($rows->total).',-','RB',0,'R',0);//Uraian
		} 
		// ----- End Content Footer ----- //
	}
	// ------------------------------------------------- END PAGE PRINT CONTENT ---------------------------------------------- //
	
	// --------------------------------------------------- PAGE PRINT FOOTER ------------------------------------------------- //
	function Footer($data)
	{
		// ----------------------- FOOTER LINE 1 ------------------------- //
		$this->fpdf->SetFont('Arial','',12);
		$this->fpdf->Ln(10);
		$this->fpdf->Cell(1,5,'Bukti-bukti pengeluaran atau belanja tersebut diatas sebagai terlampir, untuk ',0,0,'L');
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(1,5,'kelengkapan administrasi dan pemerikasaan sesuai peraturan perundang-undangan. ',0,0,'L');
		$this->fpdf->Ln(7);
		$this->fpdf->Cell(1,5,'Demikian surat pernyataan ini dibuat dengan sebenarnya. ',0,0,'L');
		
		$tanggal = date("d/m/Y");
		$desa = $this->m_surat->getDesa();
		$kecamatan = strtoupper($this->m_surat->getKecamatan());
		$this->fpdf->SetFont('Arial','',12);
		$this->fpdf->Ln(15);
		$this->fpdf->Cell(0,0,$desa.', Tanggal '.$tanggal,0,0,'C');
		
		$this->fpdf->Ln(5);
		$this->fpdf->Cell(0,0,'Pelaksana Kegiatan',0,0,'C');
		
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,0,'',0,0,'C');
		
		foreach($data['spp'] as $rows)
		{
			$nama_sekdes = $this->m_spp->getPerangkatDesa_ByJabatan('Sekretaris Desa');
			$nip_sekdes = $this->m_spp->getNipPerangkatDesa_ByJabatan('Sekretaris Desa');
			$id_rabdes = $rows->id_rabdes;
			$nik = $this->m_spp->getNik_ByIdRabdes($id_rabdes);
			$nama_pengguna = $this->m_spp->getNamaPengguna_ByNik($nik);
			
			$this->fpdf->SetFont('Arial','U',12);
			$this->fpdf->Ln(20);
			$this->fpdf->Cell(0,0,$nama_pengguna,0,0,'C');
			
			$this->fpdf->SetFont('Arial','B',12);
			$this->fpdf->Ln(5);
			$this->fpdf->Cell(0,0,'NIK. '.$nik,0,0,'C');
		}
		// ----------------------- END FOOTER LINE 1 ------------------------- //
		
		
	}
	// ---------------------------------------------/- END PAGE PRINT FOOTER ------------------------------------------------- //
	function cetak_lpj($id) 
	{
		$id_spp = $this->m_lpj->getIdSpp_ByIdLpj($id);
		$data['lpj'] = $this->m_lpj->getLpj_ByIdSpp($id_spp);
		$data['spp'] = $this->m_spp->getSpp_ByIdSpp($id_spp);
		$data['spp_detail'] = $this->m_spp->getSppDetail_ByIdSpp($id_spp);
		$data['sum_spp_detail'] = $this->m_spp->getSppDetail_SUM_ByIdSpp($id_spp);
		
		$this->Header($data);
		$this->Content($data);
		$this->Footer($data);
	
		foreach($data['spp'] as $rows)
		{
			$this->fpdf->Output();
		}
    }
}
?>