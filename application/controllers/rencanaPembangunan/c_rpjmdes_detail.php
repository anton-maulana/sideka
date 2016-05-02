<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rpjmdes_detail extends CI_Controller {
	function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_rpjmdes_detail');
		$this->load->helper('array'); 
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
		
		$data['periode'] = $this->m_rpjmdes_detail->getPeriode();

        $data['page_title'] = 'DATA Detil RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';	
				
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/rpjmdes_detail/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	function lists_rpjmdes_detail() {
		$id_periode = $this->input->post('id_periode', TRUE);
		
        $colModel['id_rpjmdes_detail'] = array('ID',30,TRUE,'center',0);	
		$colModel['ref_rp_bidang.kode_bidang'] = array('Kode Bidang',80,TRUE,'center',2);
		$colModel['tbl_rp_rpjmdes.program'] = array('Program RPJMDes',198,TRUE,'center',2);
		$colModel['indikator'] = array('Indikator',75,TRUE,'center',2);
		$colModel['volume'] = array('Volume',70,TRUE,'center',2);
		$colModel['lokasi'] = array('Lokasi',75,TRUE,'left',2);
		
		$base_year = date("Y");
		$min_year = $this->m_rpjmdes_detail->get_PeriodeAwal_ById($id_periode);//$base_year - 5;
		$max_year = $this->m_rpjmdes_detail->get_PeriodeAkhir_ById($id_periode);//$base_year + 5;
		for( $i = $min_year; $i <= $max_year; $i++)
		{   
			$colModel[$i] = array($i,90,TRUE,'center',2);
		}
		
		$colModel['capaian'] = array('Capaian',75,TRUE,'left',2);
		//$colModel['tanggal'] = array('Tanggal',100,TRUE,'left',2);
		
		//Populate flexigrid buttons..
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 250,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_rpjmdes_detail/load_data/'.$id_periode),$colModel,'id_rpjmdes_detail','asc',$gridParams,$buttons);

		$data['id_periode'] = $id_periode;
		$data['js_grid'] = $grid_js;

		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
		$this->load->view('rencanaPembangunan/rpjmdes_detail/v_list_rpjmdes_detail', $data);
    }

    function load_data($id_periode) {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_rpjmdes_detail','ref_rp_bidang.kode_bidang','tbl_rp_rpjmdes.program','indikator','volume','lokasi','capaian');

		$this->flexigrid->validate_post('id_rpjmdes_detail','ASC',$valid_fields);
		$records = $this->m_rpjmdes_detail->getDetailRpjmdesFlexigrid($id_periode);
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		$a = '';
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_rpjmdes_detail,
				$row->id_rpjmdes_detail,
				$row->kode_bidang,
				$row->program_rpjmdes,
				$row->indikator,
				$row->volume,
				$row->lokasi,
				'Rp '.$this->rupiah($row->tahun_1).',-',
				'Rp '.$this->rupiah($row->tahun_2).',-',
				'Rp '.$this->rupiah($row->tahun_3).',-',
				'Rp '.$this->rupiah($row->tahun_4).',-',
				'Rp '.$this->rupiah($row->tahun_5).',-',
				$row->capaian
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	function rupiah($data) {  
            $rupiah = "";  
            $jml = strlen($data);  
            while ($jml > 3) {  
                $rupiah = "." . substr($data, -3) . $rupiah; 
                $l = strlen($data) - 3;  
                $data = substr($data, 0, $l);  
                $jml = strlen($data);  
            }  
            $rupiah = $data . $rupiah;  
            return $rupiah;  
  
        }
	
	public function export_to_excel($id_periode)
	{
		$i = array();
		$base_year = date("Y");
		$min_year = $this->m_rpjmdes_detail->get_PeriodeAwal_ById($id_periode);//$base_year - 5;
		$year_2 = $min_year + 1;
		$year_3 = $min_year + 2;
		$year_4 = $min_year + 3;
		$max_year = $this->m_rpjmdes_detail->get_PeriodeAkhir_ById($id_periode);//$base_year + 5;
		

		$query = $this->m_rpjmdes_detail->getDataForExportExcel($id_periode);
		$this->excel_generator->start_at(1);
		/* for( $i = $min_year; $i <= $max_year; $i++)
		{ 
			$i;
		}  */
		
		$this->excel_generator->set_header(array(
			'Kode Bidang',
			'Program RPJMDes',
			'Indikator',
			'Volume',
			'Lokasi',
			$min_year,
			$year_2,
			$year_3,
			$year_4,
			$max_year,
			'Capaian'
		));
		
		$this->excel_generator->set_column(array(
			'kode_bidang',
			'program_rpjmdes',
			'indikator',
			'volume',
			'lokasi',
			'tahun_1',
			'tahun_2',
			'tahun_3',
			'tahun_4',
			'tahun_5',
			'capaian'
		));
		$this->excel_generator->exportTo2003('Detil RPJMDes');
	}
	
	

	function test()
	{
		//$a = array();
		$a = '';
		for( $i = 2015; $i <= 2019; $i++) 
		{   
			
			if($i<2019)
			{
				$a = $a.'"';
				$a = $a.$i;
				$a = $a.'",';
			}
			if($i==2019)
			{
				$a = $a.'"';
				$a = $a.$i;
				$a = $a.'"';
			}
		}
		return $a;
	}
	
	function test1()
	{
		$array = array('color' => 'red', 'shape' => 'round ', 'size' => '');

		// returns "red"
		echo element('shape', $array);

		// returns NULL
		echo element('size', $array, NULL);
		$data = array();
		$i = '';
		$min_year = $this->m_rpjmdes_detail->get_PeriodeAwal_ById(4);//$base_year - 5;
		$max_year = $this->m_rpjmdes_detail->get_PeriodeAkhir_ById(4);//$base_year + 5;
		
		for( $i = $min_year; $i <= $max_year; $i++)
		{   
			$data[''] = 'kosong';
			$data[$i] = $i;
		}
		echo ($data);
	}
	/* function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$this->tampil_detil_rpjmdes();
		}else
			redirect('c_login', 'refresh'); 
        	
    }
	
	function tampil_detil_rpjmdes()
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			//$data['id_rpjmdes_detail'] = $id_rpjmdes_detail;
			//$id_rpjmdes = $this->m_rpjmdes_detail->getIdRpjmdes_ByIdDetilRpjmdes($id_rpjmdes_detail);
			
			$data['page_title'] = 'Tampil Data Detil RPJMDes';
			$data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
			$data['periode'] = $this->m_rpjmdes_detail->get_periode();
			$data['detil_rpjmdes'] = $this->m_rpjmdes_detail->getDetilRPJMDes();
			//$data['nominal'] = $this->m_rpjmdes_detail->getNominalByIdRpjmdes($id_rpjmdes);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view$data['content'] = $this->load->view('rpjmdes_detail/v_list', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
	} */
}
?>