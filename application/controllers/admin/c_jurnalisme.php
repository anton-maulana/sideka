<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_jurnalisme extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('text');
        $this->load->model('m_berita');
        $this->load->model('m_jurnalisme');
		$this->load->model('m_user');
		$this->load->model('m_pages');
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
	
	//$colModel['No'] = array('No',35,TRUE,'center',0);	
	$colModel['waktu'] = array('Waktu Berita',110,TRUE,'center',2);
    $colModel['judul_berita'] = array('Judul Berita',400,TRUE,'center',2);	
    $colModel['isi_berita'] = array('Isi Berita',120,TRUE,'center',2);	
    $colModel['penulis'] = array('Penulis',120,TRUE,'center',2);	
	$colModel['is_publish'] = array('Publish',50,TRUE,'center',2);
	$colModel['aksi'] = array('AKSI',50,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		//$buttons[] = array('Add','add','btn');
        //$buttons[] = array('separator');
		$buttons[] = array('Delete Selected Items','delete','btn');
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 400,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('admin/c_jurnalisme/load_data'),$colModel,'waktu','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'JURNALISME WARGA';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('jurnalisme/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {

        $this->load->library('flexigrid');
        $valid_fields = array('id_berita','waktu','judul_berita','isi_berita','penulis','is_publish');

		$this->flexigrid->validate_post('id_berita','DESC',$valid_fields);
		$records = $this->m_jurnalisme->get_berita_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		//$counter=0;
		foreach ($records['records']->result() as $row)
		{
			//$counter++;
			$record_items[] = array(
				$row->id_berita,
				//$row->nomor,
				date('j-m-Y / h:m',strtotime($row->waktu)),
                $row->judul_berita,
				substr($row->isi_berita,0,10).'...',
                $row->penulis,
                $row->is_publish,
//				'<input type="button" value="Edit" class="ubah" onclick="edit_berita(\''.$row->id_berita.'\')"/>'
				'<button type="submit" class="btn btn-success btn-xs" title="Ubah Status Publish" onclick="edit_publish(\''.$row->id_berita.'\')"/><i class="fa fa-exchange"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
	
    function delete(){
	$url='web/c_home/get_detail_berita/';
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $urlx=$url.$id;
            $this->m_pages->deletePages($urlx);
			$gambar = $this->m_berita->getGambarByIdBerita($id);
            $this->m_berita->deleteBerita($id,$gambar);
	    		
            $sucess++;
        }
		
        redirect('admin/c_jurnalisme', 'refresh');
    }
	
    function update_publish(){
	
        $id = $this->input->post('items');
        $sucess=0;
		$publish = $this->m_jurnalisme->getPublishByIdBerita($id);
        $this->m_jurnalisme->updatePublish($id,$publish);
	    $sucess++;
        
		
        redirect('admin/c_jurnalisme', 'refresh');
    }
	
}
?>