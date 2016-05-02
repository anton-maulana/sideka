<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_tanah extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_tanah');
        $this->load->model('aset/m_aset');
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->helper('form');//f
        $this->load->helper('file');//f
		$this->load->helper('date');
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
		$colModel['id_aset_tanah'] = array('ID',30,TRUE,'left',0);
        $colModel['no_sertifikat'] = array('No Sertifikat',150,TRUE,'left',2); 		
        $colModel['deskripsi'] = array('Deskripsi',200,TRUE,'center',2);
        $colModel['luas'] = array('Luas Tanah (Ha)',100,TRUE,'center',2); 
        $colModel['ref_kepemilikan_aset.deskripsi'] = array('Kepemilikan',120,TRUE,'center',2);
        //$colModel['lokasi'] = array('Lokasi',200,TRUE,'center',2);
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_tanah/load_data'),$colModel,'id_aset_tanah','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA TANAH';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/tanah/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_tanah','no_sertifikat','deskripsi','luas','ref_kepemilikan_aset.deskripsi','lokasi');
		
		$this->flexigrid->validate_post('id_aset_tanah','DESC',$valid_fields);
		$records = $this->m_tanah->getTanahFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_aset_tanah,
				$row->id_aset_tanah,
				$row->no_sertifikat,			
				$row->deskripsi,
				$row->luas,
                $row->kepemilikan_aset,				
				//$row->lokasi,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_tanah(\''.$row->id_aset_tanah.'\')"/><i class="fa fa-pencil"></i></button>
'
	//<button type="submit" class="btn btn-success btn-xs" title="Tambah Bangunan" onclick="tambah_bangunan(\''.$row->id_aset_tanah.'\')"/><i class="fa fa-plus-square"></i></button>
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
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			$data['page_title'] = 'TAMBAH DATA TANAH';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/tanah/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_tanah() {
		
		$no_sertifikat = $this->input->post('no_sertifikat', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);	
		
		$data = array(
			'no_sertifikat' => $no_sertifikat,
			'deskripsi' => $deskripsi,
			'luas' => $luas,
			'id_kepemilikan_aset' => $id_kepemilikan_aset
		);

		$this->m_tanah->insertTanah($data);		
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('aset/c_tanah','refresh');
       
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			$data['tanah'] = $this->m_tanah->getTanahByIdTanah($id);
			
			$data['page_title'] = 'UBAH DATA TANAH';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/tanah/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_tanah() {	
	
		$no_sertifikat = $this->input->post('no_sertifikat', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);	
		$id_aset_tanah = $this->input->post('id_aset_tanah', TRUE);
		
		$data = array(
			'no_sertifikat' => $no_sertifikat,
			'deskripsi' => $deskripsi,
			'luas' => $luas,
			'id_kepemilikan_aset' => $id_kepemilikan_aset
		);

		$this->m_tanah->updateTanah(array('id_aset_tanah' => $id_aset_tanah), $data);			
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('aset/c_tanah','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_tanah->deleteTanah($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_tanah', 'refresh');
    }
	
	public function export_to_excel()
	{
		$query = $this->m_tanah->getExportExcel();
		
		//BORDER BOTTOM HEADER
		$styleArray = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		);
		$this->excel_generator->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
		unset($styleArray);
		//END BORDER BOTTOM HEADER
		
		//AUTOSIZE CELL
		for ($col = 'A'; $col != 'E'; $col++) {
		 $this->excel_generator->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		//END AUTOSIZE CELL
		
		$this->excel_generator->start_at(1);
		$this->excel_generator->set_header(array(
		'No Sertifikat', 'Deskripsi', 'Luas Tanah (Ha)', 'Kepemilikan'
		));
		
		$this->excel_generator->set_column(array(
		'no_sertifikat', 'deskripsi', 'luas', 'kepemilikan_aset'
		));
		
		$this->excel_generator->exportTo2003('Data Tanah ('.date("d-m-Y").')');
		
	}
		
}
?>