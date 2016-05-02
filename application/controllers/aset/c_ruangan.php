<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_ruangan extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_ruangan');
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
		$colModel['id_aset_ruangan'] = array('ID',30,TRUE,'left',0);
        $colModel['tbl_aset_ruangan.deskripsi'] = array('Nama Ruangan',150,TRUE,'center',2);
        $colModel['luas'] = array('Luas (m2)',100,TRUE,'center',2); 		
        $colModel['no_imb'] = array('No IMB',120,TRUE,'center',2);  		
        $colModel['tbl_aset_bangunan.deskripsi'] = array('Nama Bangunan',150,TRUE,'center',2);
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_ruangan/load_data'),$colModel,'id_aset_ruangan','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA RUANGAN';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/ruangan/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_ruangan','tbl_aset_ruangan.deskripsi','luas','no_imb','tbl_aset_bangunan.deskripsi');
		
		$this->flexigrid->validate_post('id_aset_ruangan','DESC',$valid_fields);
		$records = $this->m_ruangan->getRuanganFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_aset_ruangan,
				$row->id_aset_ruangan,			
				$row->deskripsi,
				$row->luas,								
				$row->no_imb,	
				$row->nama_bangunan,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_ruangan(\''.$row->id_aset_ruangan.'\')"/><i class="fa fa-pencil"></i></button>'
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
			
			$data['json_array_nama'] = $this->autocomplete_NoImb();
			
			$data['page_title'] = 'TAMBAH DATA RUANGAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/ruangan/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_ruangan() {
		
		$no_imb = $this->input->post('no_imb', TRUE);
		
		$luas = $this->input->post('luas', TRUE);	
		$deskripsi = $this->input->post('deskripsi', TRUE);		
				
		$id_aset_bangunan = $this->m_ruangan->getIdBangunanByNoImb($no_imb);
				
		$data = array(			
			'luas' => $luas,
			'deskripsi' => $deskripsi,
			'id_aset_bangunan' => $id_aset_bangunan			
		);
		
		$this->m_ruangan->insertRuangan($data);
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('aset/c_ruangan','refresh');
	
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['json_array_nama'] = $this->autocomplete_NoImb();
			
			$data['ruangan'] = $this->m_ruangan->getRuanganByIdRuangan($id);
			
			$data['bangunan'] = $this->m_ruangan->getBangunanByIdBangunan($data['ruangan']->id_aset_bangunan);
			
			$data['page_title'] = 'UBAH DATA RUANGAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/ruangan/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_ruangan() {	
		
		$id_aset_ruangan = $this->input->post('id_aset_ruangan', TRUE);
		
		$no_imb = $this->input->post('no_imb', TRUE);
		
		$luas = $this->input->post('luas', TRUE);	
		$deskripsi = $this->input->post('deskripsi', TRUE);		
				
		$id_aset_bangunan = $this->m_ruangan->getIdBangunanByNoImb($no_imb);
		
		$data = array(			
			'luas' => $luas,
			'deskripsi' => $deskripsi,
			'id_aset_bangunan' => $id_aset_bangunan			
		);
		
		$this->m_ruangan->updateRuangan(array('id_aset_ruangan' => $id_aset_ruangan), $data);
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('aset/c_ruangan','refresh');
	
		
    }
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_ruangan->deleteRuangan($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_ruangan','refresh');
    }
		
	public function autocomplete_NoImb()
    {
        $no_imb = $this->input->post('no_imb',TRUE);
        $rows = $this->m_ruangan->get_AsetRuangan($no_imb);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->no_imb.' | '.$row->deskripsi;
		}
        return json_encode($json_array);
    }
	
	public function export_to_excel()
	{
		$query = $this->m_ruangan->getExportExcel();
		
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
		'Nama Ruangan', 'Luas (m2)','No IMB', 'Nama Bangunan'
		));
		
		$this->excel_generator->set_column(array(
		'deskripsi', 'luas','no_imb', 'nama_bangunan'
		));
		
		$this->excel_generator->exportTo2003('Data Ruangan ('.date("d-m-Y").')');
	}

}
?>