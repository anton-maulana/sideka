<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_tahun_anggaran extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_tahun_anggaran');
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
        $colModel['id_tahun_anggaran'] = array('ID',20,TRUE,'center',0);
		$colModel['periode'] = array('Periode',	105,TRUE,'center',2);
		$colModel['tahun'] = array('Tahun',75,TRUE,'center',2);
		$colModel['deskripsi'] = array('Deskripsi',100,TRUE,'left',2);
		$colModel['regulasi'] = array('Regulasi',220,TRUE,'left',2);
		$colModel['keterangan'] = array('Keterangan',220,TRUE,'left',2);
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

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_tahun_anggaran/load_data'),$colModel,'id_tahun_anggaran','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA TAHUN ANGGARAN';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/tahun_anggaran/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_tahun_anggaran','deskripsi');

		$this->flexigrid->validate_post('id_tahun_anggaran','ASC',$valid_fields);
		$records = $this->m_tahun_anggaran->get_tahun_anggaran_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_tahun_anggaran,
				$row->id_tahun_anggaran,
				$row->periode,
				$row->tahun,
				$row->deskripsi,
				$row->regulasi,
				$row->keterangan,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_tahun_anggaran(\''.$row->id_tahun_anggaran.'\')"/><i class="fa fa-pencil"></i></button>'
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
			$data['page_title'] = 'Tambah Tahun Anggaran';
			$data['year'] = $this->m_tahun_anggaran->get_year();
			$data['year_now'] = date("Y");
			$data['periode'] = $this->m_tahun_anggaran->get_periode();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/tahun_anggaran/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
        
    }
	
	function simpan_tahun_anggaran() {
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$regulasi = $this->input->post('regulasi', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		$tahun = $this->input->post('tahun', TRUE);
		$id_periode = $this->input->post('id_periode', TRUE);
		
				$data = array(
					'deskripsi' => $deskripsi,
					'regulasi' => $regulasi,
					'keterangan' => $keterangan,
					'tahun' => $tahun,
					'id_periode' => $id_periode
				);

			$this->m_tahun_anggaran->insertTahun_anggaran($data);	
			redirect('rencanaPembangunan/c_tahun_anggaran','refresh');
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['hasil'] = $this->m_tahun_anggaran->getTahun_anggaranByIdTahun_anggaran($id);
			$data['page_title'] = 'Edit Data Tahun Anggaran';
			$data['year'] = $this->m_tahun_anggaran->get_year();
			$data['periode'] = $this->m_tahun_anggaran->get_periode();
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/tahun_anggaran/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_tahun_anggaran() {	
	
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$regulasi = $this->input->post('regulasi', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		$tahun = $this->input->post('tahun', TRUE);
		$id_periode = $this->input->post('id_periode', TRUE);
			$data = array(
					'deskripsi' => $deskripsi,
					'regulasi' => $regulasi,
					'keterangan' => $keterangan,
					'tahun' => $tahun,
					'id_periode' => $id_periode
				);
		  	$result = $this->m_tahun_anggaran->updateTahun_anggaran(array('id_tahun_anggaran' => $id_tahun_anggaran), $data);
		  	redirect('rencanaPembangunan/c_tahun_anggaran','refresh');
    }
	
	function delete()    {
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_tahun_anggaran->deleteTahun_anggaran($id);
            $sucess++;
        }
		
        redirect('rencanaPembangunan/c_tahun_anggaran', 'refresh');
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
	
	function year_now() 
	{      
		$base_year = date("Y");
		return $base_year;
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