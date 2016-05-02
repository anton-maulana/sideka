<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_realisasi extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('m_realisasi');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Data')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }

    function lists() {
        $colModel['id_realisasi'] = array('ID',20,TRUE,'center',0);	
        $colModel['id_anggaran'] = array('Nomor Anggaran',20,TRUE,'center',0);
		//$colModel['tahun_anggaran'] = array('Tahun Anggaran',220,TRUE,'left',2);
		//$colModel['deskripsi'] = array('Deskripsi',220,TRUE,'left',2);
		$colModel['tanggal'] = array('Tahun',220,TRUE,'left',2);
		$colModel['jumlah'] = array('Perubahan?',220,TRUE,'left',2);
        $colModel['aksi'] = array('Aksi',60,FALSE,'center',0);
		
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

        $grid_js = build_grid_js('flex1',site_url('apbdes/c_realisasi/load_data'),$colModel,'id_realisasi','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'Realisasi';		
		$data['menu'] = $this->load->view('menu/v_pengelolaData', $data, TRUE);
        $data['content'] = $this->load->view('realisasi/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_realisasi','id_anggaran','tanggal','jumlah', );

		$this->flexigrid->validate_post('id_realisasi','ASC',$valid_fields);
		$records = $this->m_realisasi->get_flexigrid();

		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_realisasi,
				$row->id_realisasi,
				$row->id_anggaran,
				$row->tanggal,
				$row->jumlah,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_realisasi(\''.$row->id_realisasi.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Data')
		{
			$data['id_anggaran'] = $this->m_realisasi->get_id_anggaran();
			$data['page_title'] = 'Tambah Realisasi';
			$data['menu'] = $this->load->view('menu/v_pengelolaData', $data, TRUE);
			$data['content'] = $this->load->view('realisasi/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
	
	function simpan() {
		$id_anggaran = $this->input->post('id_anggaran', TRUE);
		$tanggal = $this->input->post('tanggal', TRUE);
		$jumlah = $this->input->post('jumlah', TRUE);
		
		$this->form_validation->set_rules('id_anggaran', 'Id_Anggaran', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		echo "sdasd"+ $tanggal;
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'id_anggaran' => $id_anggaran,
				'tanggal' => date('Y-m-d', strtotime($tanggal)),
				'jumlah' => $jumlah
				);
	
			$this->m_realisasi->insert($data);	
			redirect('apbdes/c_realisasi','refresh');
        }
		else $this->add();
    }

    function edit($id){

		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Data')
		{
			$data['id_anggaran'] = $this->m_realisasi->get_id_anggaran();
			$data['hasil'] = $this->m_realisasi->getById($id);
			$data['page_title'] = 'Edit Realisasi';
			$data['menu'] = $this->load->view('menu/v_pengelolaData', $data, TRUE);
			$data['content'] = $this->load->view('realisasi/v_ubah', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update() {
		$id = $this->input->post('id_realisasi', TRUE);
		$id_anggaran = $this->input->post('id_anggaran', TRUE);
		$tanggal = $this->input->post('tanggal', TRUE);
		$jumlah = $this->input->post('jumlah', TRUE);

		$this->form_validation->set_rules('id_anggaran', 'Id_Anggaran', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'id_anggaran' => $id_anggaran,
				'tanggal' => date('Y-m-d', strtotime($tanggal)),
				'jumlah' => $jumlah
				);
	
		  	$result = $this->m_realisasi->update(array('id_realisasi' => $id), $data);
			
		  	redirect('apbdes/c_realisasi','refresh');
		}
		else $this->edit($id);
    }
	
	function delete()    {
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_realisasi->delete($id);
            $sucess++;
        }
		
        redirect('apbdes/c_realisasi', 'refresh');
    }
	


}
?>
