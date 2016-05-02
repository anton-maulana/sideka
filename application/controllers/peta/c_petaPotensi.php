<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_petaPotensi extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('ped/m_ped_sub');
		$this->load->model('ped/m_ped');
        $this->load->model('m_peta');
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }    

	
    function lists() {
		$colModel['id_ped_sub'] = array('ID',30,TRUE,'left',0);
        $colModel['ref_ped_sub.deskripsi'] = array('Jenis Potensi',150,TRUE,'left',2); 
        $colModel['ref_ped_kategori.deskripsi'] = array('Lahan',150,TRUE,'center',2); 
        $colModel['monetize'] = array('Hasil (Rp.)',200,TRUE,'center',2);
		$colModel['satuan'] = array('Satuan', 50,TRUE,'center',2);
		$colModel['warna_peta'] = array('Warna Peta', 80,TRUE,'center',2);
		$colModel['aksi'] = array('AKSI',100,FALSE,'center',0);
       
		
		//Populate flexigrid buttons..
       /*  $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
		$buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn'); */
        $buttons[] = array('separator');
       		
        $gridParams = array(
        'height' => 400,
            'rp' => 15,
            'rpOptions' => '[10,20,30,40,50]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('peta/c_petaPotensi/load_data'),$colModel,'id_ped_sub','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA POTENSI EKONOMI DESA';		
		$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
        $data['content'] = $this->load->view('peta/potensi/v_listPetaPotensi', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_ped_sub','ref_ped_sub.deskripsi','ref_ped_kategori.deskripsi','monetize','satuan');
		
		$this->flexigrid->validate_post('id_ped_sub','DESC',$valid_fields);
		$records = $this->m_ped_sub->getPedSubFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_ped_sub,
				$row->id_ped_sub,
				$row->deskripsi,
				$row->lahan,
                $this->rupiah($row->monetize),				
				$row->satuan,	
'<input type="color" title="Pilih Warna Peta" id="colorpicker'.$row->id_ped_sub.'" onchange="colorpick(\''.$row->id_ped_sub.'\')" name="color" value="'.$row->warna_peta.'">',
'<button type="submit" class="btn btn-success btn-xs" title="Pengaturan Peta" onclick="detail_potensi(\''.$row->id_ped_sub.'\')"/><i class="fa fa-map-marker"></i></button>'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
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
	function lists_ped($id_ped_sub) {
	
	$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
		{
			$colModel['id_ped'] = array('ID',30,TRUE,'left',0);
			$colModel['tbl_ped.deskripsi'] = array('Detil Potensi',150,TRUE,'left',2); 
			$colModel['ref_ped_sub.deskripsi'] = array('Jenis Potensi',150,TRUE,'left',2); 
			$colModel['ref_ped_kategori.deskripsi'] = array('Lahan',150,TRUE,'center',2); 
			$colModel['luas'] = array('Luas',80,TRUE,'center',2);
			$colModel['lokasi'] = array('Lokasi',110,TRUE,'center',2);
			$colModel['aksi'] = array('AKSI',50,FALSE,'center',0);
		   
			
			//Populate flexigrid buttons..
			$buttons[] = array('Back','prev','btn');
			$buttons[] = array('separator');
				
			$gridParams = array(
			'height' => 400,
				'rp' => 15,
				'rpOptions' => '[10,20,30,40,50]',
				'pagestat' => 'Displaying: {from} to {to} of {total} items.',
				'blockOpacity' => 0.5,
				'title' => '',
				'showTableToggleBtn' => false
		);

			$grid_js = build_grid_js('flex1',site_url('peta/c_petaPotensi/load_data_ped/'.$id_ped_sub.''),$colModel,'id_ped','desc',$gridParams,$buttons);

			$data['js_grid'] = $grid_js;

			$data['page_title'] = 'DATA POTENSI EKONOMI DESA';		
			$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
			$data['content'] = $this->load->view('peta/potensi/v_listPetaPotensi', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
		
    }
	
	function load_data_ped($id_ped_sub) {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_ped','tbl_ped.deskripsi','ref_ped_sub.deskripsi','ref_ped_kategori.deskripsi','monetize','satuan');
		
		$this->flexigrid->validate_post('id_ped','DESC',$valid_fields);
		$records = $this->m_ped->getPedFlexigridById($id_ped_sub);
		//$records = $this->m_ped->get_ped_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_ped,
				$row->id_ped,
				$row->deskripsi,
				$row->jenis,
                $row->lahan,				
				'<p style="text-align:right;">'.$row->luas.' '.$row->satuan.'</p>',			
				$this->cek_lokasi($row->lokasi),			
'<button type="submit" class="btn btn-success btn-xs" title="Pengaturan Peta" onclick="pengaturan_peta(\''.$row->id_ped.'\')"/><i class="fa fa-map-marker"></i></button>'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
    function cek_lokasi($lokasi)
	{
		if(!empty($lokasi)){ return 'Ada';}
		else { return '';}
	}
	function pengaturan_peta($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			$data['ped'] = $this->m_ped->getPedByIdPed($id);
			$data['peta'] = $this->m_peta->getPeta();
			
			$data['ped_sub'] = $this->m_ped_sub->getPedSubByIdPedSub($data['ped']->id_ped_sub);
			$data['lokasi_null'] = $this->m_ped->cekLokasiNull($id);
			$data['page_title'] = 'PENGATURAN PETA POTENSI EKONOMI DESA';
			$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
			$data['content'] = $this->load->view('peta/potensi/v_tambahPetaPotensi', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function simpan_peta() {	
	
		$lokasi = $this->input->post('lokasi', TRUE);
		$id_ped = $this->input->post('id_ped', TRUE);
		$id_ped_sub = $this->input->post('id_ped_sub', TRUE);
		
		$data = array(
			'lokasi' => $lokasi
		);

		$this->m_ped->updatePed(array('id_ped' => $id_ped), $data);	
		
		redirect('peta/c_petaPotensi/lists_ped/'.$id_ped_sub,'refresh');
    }
	
	
	
	function update_warna()
    {
        $id_ped_sub = $this->input->post('id_ped_sub');
        $warna_peta = $this->input->post('warna_peta');
        
        $data = array(
			'warna_peta' => $warna_peta
		);

		$this->m_ped_sub->updatePedSub(array('id_ped_sub' => $id_ped_sub), $data);
       
        redirect('peta/c_petaPotensi', 'refresh');
    }
		
}
?>