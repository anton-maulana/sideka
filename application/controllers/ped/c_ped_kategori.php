<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_ped_kategori extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('ped/m_ped_kategori');
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$this->list_ped_sub();
		}else
			redirect('c_login', 'refresh');
        	
    }
	
    function list_ped_sub() {
		$colModel['id_ped_kategori'] = array('ID',30,TRUE,'left',0);
        $colModel['deskripsi'] = array('Lahan',150,TRUE,'left',2); 
		$colModel['aksi'] = array('AKSI',50,FALSE,'center',0);
       
		
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

        $grid_js = build_grid_js('flex1',site_url('ped/c_ped_kategori/load_data'),$colModel,'id_ped_kategori','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA LAHAN POTENSI DESA';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('ped/ped_kategori/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_ped_kategori','deskripsi');
		
		$this->flexigrid->validate_post('id_ped_kategori','DESC',$valid_fields);
		$records = $this->m_ped_kategori->getPedKategoriFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_ped_kategori,
				$row->id_ped_kategori,
				$row->deskripsi,	
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_ped(\''.$row->id_ped_kategori.'\')"/><i class="fa fa-pencil"></i></button>'
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
			
			$data['page_title'] = 'TAMBAH LAHAN POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped_kategori/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_ped_kategori() {
		
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi
		);

		$this->m_ped_kategori->insertPedKategori($data);		
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('ped/c_ped_kategori','refresh');
       
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_kategori'] = $this->m_ped_kategori->getPedKategoriByIdPedKategori($id);
			
			$data['page_title'] = 'UBAH LAHAN POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped_kategori/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_ped_kategori() {	
	
		$id_ped_kategori = $this->input->post('id_ped_kategori', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi
		);

		$this->m_ped_kategori->updatePedKategori(array('id_ped_kategori' => $id_ped_kategori), $data);	
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('ped/c_ped_kategori','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_ped_kategori->deletePedKategori($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('ped/c_ped', 'refresh');
    }
		
}
?>