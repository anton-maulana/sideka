<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sumber_dana extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_sumber_dana');
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
        $colModel['id_sumber_dana'] = array('ID',20,TRUE,'center',0);	
		$colModel['sumber'] = array('Sumber Dana',170,TRUE,'left',2);
		$colModel['deskripsi'] = array('Deskripsi',260,TRUE,'left',2);
		$colModel['nominal'] = array('Nominal',170,TRUE,'left',2);
		$colModel['tahun_anggaran'] = array('Tahun Anggaran',100,TRUE,'center',2);
        $colModel['aksi'] = array('AKSI',60,FALSE,'center',0);
		
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_sumber_dana/load_data'),$colModel,'id_sumber_dana','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA SUMBER DANA';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/sumber_dana/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_sumber_dana','deskripsi');

		$this->flexigrid->validate_post('id_sumber_dana','ASC',$valid_fields);
		$records = $this->m_sumber_dana->get_sumber_dana_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_sumber_dana,
				$row->id_sumber_dana,
				$row->sumber,
				$row->deskripsi,
				'Rp '. $this->rupiah($row->nominal).',-',
				$row->tahun_anggaran,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_sumber_dana(\''.$row->id_sumber_dana.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['page_title'] = 'TAMBAH SUMBER DANA';
			$data['tahun_anggaran'] = $this->m_sumber_dana->get_tahun_anggaran();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/sumber_dana/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
        
    }
	
	function simpan_sumber_dana() {
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$sumber = $this->input->post('sumber', TRUE);
		$nominal = $this->input->post('nominal', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Sumber Dana', 'required');
		$this->form_validation->set_rules('sumber', 'Sumber Dana', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_sumber_dana->cekFIleExist($deskripsi);				
			
			if ($result['hasil'] == NULL) {				
				$data = array(
					'deskripsi' => $deskripsi,
					'sumber' => $sumber,
					'nominal' => $nominal,
					'id_tahun_anggaran' => $id_tahun_anggaran
				);

			$this->m_sumber_dana->insertSumber_dana($data);	
			redirect('rencanaPembangunan/c_sumber_dana','refresh');
			}			
			else $this->add();
			/* Handle ketika nomer sumber_dana telah digunakan */
        }
		else $this->add();
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['hasil'] = $this->m_sumber_dana->getSumber_danaByIdSumber_dana($id);
			$data['page_title'] = 'EDIT DATA SUMBER DANA';
			$data['tahun_anggaran'] = $this->m_sumber_dana->get_tahun_anggaran();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/sumber_dana/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_sumber_dana() {	
	
		$id_sumber_dana = $this->input->post('id_sumber_dana', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$sumber = $this->input->post('sumber', TRUE);
		$nominal = $this->input->post('nominal', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'deskripsi' => $deskripsi,
					'sumber' => $sumber,
					'nominal' => $nominal,
					'id_tahun_anggaran' => $id_tahun_anggaran
				);
	
		  	$result = $this->m_sumber_dana->updateSumber_dana(array('id_sumber_dana' => $id_sumber_dana), $data);
			
		  	redirect('rencanaPembangunan/c_sumber_dana','refresh');
		}
		else $this->edit($id_sumber_dana);
    }
	
	function delete()    {
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_sumber_dana->deleteSumber_dana($id);
            $sucess++;
        }
		
        redirect('rencanaPembangunan/c_sumber_dana', 'refresh');
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