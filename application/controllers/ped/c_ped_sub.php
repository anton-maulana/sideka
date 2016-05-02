<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_ped_sub extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('ped/m_ped_sub');
        $this->load->model('ped/m_ped');	
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }
	
    function lists() {
		$colModel['id_ped_sub'] = array('ID',30,TRUE,'left',0);
        $colModel['ref_ped_sub.deskripsi'] = array('Jenis Potensi',150,TRUE,'left',2); 
        $colModel['ref_ped_kategori.deskripsi'] = array('Lahan',150,TRUE,'center',2); 
        $colModel['monetize'] = array('Hasil',150,TRUE,'center',2);
		$colModel['satuan'] = array('Satuan', 50,TRUE,'center',2);
		$colModel['aksi'] = array('AKSI',70,FALSE,'center',0);
       
		
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
        'height' => 400,
            'rp' => 15,
            'rpOptions' => '[10,20,30,40,50]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('ped/c_ped_sub/load_data'),$colModel,'id_ped_sub','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA JENIS POTENSI DESA';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('ped/ped_sub/v_list', $data, TRUE);
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
                '<p style="text-align:right;">Rp. '.$this->rupiah($row->monetize).'</p>',				
				$row->satuan,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_ped_sub(\''.$row->id_ped_sub.'\')"/><i class="fa fa-pencil"></i></button>
<button type="submit" class="btn btn-success btn-xs" title="Tambah Detil Potensi Desa" onclick="tambah_detil_ped(\''.$row->id_ped_sub.'\')"/><i class="fa fa-plus-square"></i></button>
'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_kategori'] = $this->m_ped_sub->get_ped_kategori();
			
			$data['satuan'] = $this->m_ped_sub->get_satuan();
			
			
			$data['page_title'] = 'TAMBAH JENIS POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped_sub/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_ped_sub() {
		
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$monetize = $this->input->post('monetize', TRUE);
		$satuan = $this->input->post('satuan', TRUE);
		$id_ped_kategori = $this->input->post('id_ped_kategori', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi,
			'monetize' => $monetize,
			'satuan' => $satuan,
			'id_ped_kategori' => $id_ped_kategori
		);

		$this->m_ped_sub->insertPedSub($data);		
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('ped/c_ped_sub','refresh');
       
    }
	
	function tambah_detil_ped($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_sub'] = $this->m_ped_sub->getPedSubByIdPedSub($id);
			$data['id_ped_sub'] = $id;
			
			$data['page_title'] = 'TAMBAH DETIL POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped_sub/v_tambah_detil', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_detil_ped() {
		
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$luas = $this->input->post('luas', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$id_ped_sub = $this->input->post('id_ped_sub', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi,
			'luas' => $luas,
			'lokasi' => $lokasi,
			'id_ped_sub' => $id_ped_sub
		);

		$this->m_ped->insertPed($data);		
		
		redirect('ped/c_ped_sub','refresh');
       
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_kategori'] = $this->m_ped_sub->get_ped_kategori();			
			$data['satuan'] = $this->m_ped_sub->get_satuan();
			
			$data['ped_sub'] = $this->m_ped_sub->getPedSubByIdPedSub($id);
			
			$data['page_title'] = 'UBAH JENIS POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped_sub/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_ped_sub() {	
	
		$id_ped_sub = $this->input->post('id_ped_sub', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$monetize = $this->input->post('monetize', TRUE);
		$satuan = $this->input->post('satuan', TRUE);
		$id_ped_kategori = $this->input->post('id_ped_kategori', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi,
			'monetize' => $monetize,
			'satuan' => $satuan,
			'id_ped_kategori' => $id_ped_kategori
		);

		$this->m_ped_sub->updatePedSub(array('id_ped_sub' => $id_ped_sub), $data);	
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('ped/c_ped_sub','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_ped_sub->deletePedSub($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('ped/c_ped_sub', 'refresh');
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
    

	
}
?>