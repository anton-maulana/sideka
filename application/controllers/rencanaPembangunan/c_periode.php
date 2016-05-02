<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_periode extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_periode');
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
        $colModel['id_periode'] = array('ID',20,TRUE,'center',0);	
		$colModel['periode_awal'] = array('Periode Awal',220,TRUE,'left',2);
		$colModel['periode_akhir'] = array('Periode Akhir',220,TRUE,'left',2);
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_periode/load_data'),$colModel,'id_periode','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA PERIODE';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/periode/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_periode','periode_awal', 'periode_akhir');

		$this->flexigrid->validate_post('id_periode','ASC',$valid_fields);
		$records = $this->m_periode->get_periode_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_periode,
				$row->id_periode,
				$row->periode_awal,
				$row->periode_akhir,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_periode(\''.$row->id_periode.'\')"/><i class="fa fa-pencil"></i></button>'
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
			$data['page_title'] = 'Tambah Periode';
			$data['year'] = $this->m_periode->get_year();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/periode/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
        
    }
	
	function simpan_periode() {
		$periode_awal = $this->input->post('periode_awal', TRUE);
		$periode_akhir= $this->input->post('periode_akhir', TRUE);
		
		$this->form_validation->set_rules('periode_awal', 'Periode Awal', 'required');
		$this->form_validation->set_rules('periode_akhir', 'Periode Akhir', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'periode_awal' => $periode_awal,
					'periode_akhir' => $periode_akhir
				);
			$this->m_periode->insertperiode($data);	
			redirect('rencanaPembangunan/c_periode','refresh');
			
			/* Handle ketika nomer periode telah digunakan */
        }
		else $this->add();
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['hasil'] = $this->m_periode->getperiodeByIdperiode($id);
			$data['page_title'] = 'Edit Data periode';
			$data['year'] = $this->m_periode->get_year();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/periode/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_periode() {	
	
		$id_periode = $this->input->post('id_periode', TRUE);
		$periode_awal = $this->input->post('periode_awal', TRUE);
		$periode_akhir= $this->input->post('periode_akhir', TRUE);
		
		$this->form_validation->set_rules('periode_awal', 'Periode Awal', 'required');
		$this->form_validation->set_rules('periode_akhir', 'Periode Akhir', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'periode_awal' => $periode_awal,
					'periode_akhir' => $periode_akhir
				);
	
		  	$result = $this->m_periode->updateperiode(array('id_periode' => $id_periode), $data);
			
		  	redirect('rencanaPembangunan/c_periode','refresh');
		}
		else $this->edit($id_periode);
    }
	
	function delete()    {
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_periode->deleteperiode($id);
            $sucess++;
        }
		
        redirect('rencanaPembangunan/c_periode', 'refresh');
    }
	
	function looping_year()
	{
		/* $base_year = date("Y");
		$start_year = $base_year - 5;
		$end_year = $start_year + 10;

		for( $i = $start_year; $i <= $end_year; $i++)
		{   
			echo $i;
		}
		
		$employeeAges;
		$employeeAges["Lisa"] = "28";
		$employeeAges["Jack"] = "16";
		$employeeAges["Ryan"] = "35";
		$employeeAges["Rachel"] = "46";
		$employeeAges["Grace"] = "34";

		foreach( $employeeAges as $name => $age){
			echo "Name: $name, Age: $age <br />";
		} */
		
		/* $base_year = date("Y");
		$start_year = $base_year - 5;
		$end_year = $start_year + 10;

		for( $i = $start_year; $i <= $end_year; $i++)
		{   
			$i;
		}
		
		$i = array();
		foreach ($i as $row)
		{	
			$i[''] = '--Pilih--';
			$i[$row] = $i;	
		}	
		echo $i; */
		
		
	}
	
	function tes()
	{
		$this->load->library('calendar');
		$base_year = date("Y");
		$start_year = $base_year;
		$end_year = $start_year +1;
		
		$base_month = date("m");
		$start_month = $base_month;
		$end_month = $start_month +12;

		for( $i = $start_year; $i <= $end_year; $i++)
		{  
			for( $j = $start_month; $j <= $end_month; $j++)
			{
				echo $this->calendar->generate($i, $j);
			}
			//echo '<option value='.$i.'>'.$i.'</option>';
			
		}	
	}
}
?>