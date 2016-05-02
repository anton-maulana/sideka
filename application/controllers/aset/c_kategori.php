<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_kategori extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_kategori');
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }
	
    function lists() {
		$colModel['id_kategori_aset'] = array('ID',30,TRUE,'left',0);
        $colModel['deskripsi'] = array('Deskripsi',250,TRUE,'left',2); 
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_kategori/load_data'),$colModel,'id_kategori_aset','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA PUSTAKA KATEGORI ASET';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/kategori/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_kategori_aset','deskripsi');
		$this->flexigrid->validate_post('id_kategori_aset','DESC',$valid_fields);
		$records = $this->m_kategori->getKategoriFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_kategori_aset,
				$row->id_kategori_aset,
				$row->deskripsi,		
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_kategori(\''.$row->id_kategori_aset.'\')"/><i class="fa fa-pencil"></i></button>'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			
			$data['page_title'] = 'TAMBAH PUSTAKA KATEGORI ASET';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/kategori/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_kategori() {
		
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi
		);

		$this->m_kategori->insertKategori($data);		
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('aset/c_kategori','refresh');
       
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['kategori'] = $this->m_kategori->getKategoriByIdKategori($id);
			
			$data['page_title'] = 'UBAH PUSTAKA KATEGORI ASET';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/kategori/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_kategori() {	
	
		$id_kategori_aset = $this->input->post('id_kategori_aset', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$data = array(
			'deskripsi' => $deskripsi
		);

		$this->m_kategori->updateKategori(array('id_kategori_aset' => $id_kategori_aset), $data);	
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('aset/c_kategori','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_kategori->deleteKategori($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_kategori', 'refresh');
    }
		
}
?>