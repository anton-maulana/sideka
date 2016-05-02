<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_bangunan extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_bangunan');
        $this->load->model('aset/m_aset');
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
		$colModel['id_aset_bangunan'] = array('ID',30,TRUE,'left',0);
        $colModel['no_imb'] = array('No IMB',120,TRUE,'left',2); 		
        $colModel['deskripsi'] = array('Nama Bangunan',150,TRUE,'center',2);
        $colModel['tgl_bangun'] = array('Tanggal Bangun',100,TRUE,'center',2); 
        $colModel['luas'] = array('Luas (Ha)',80,TRUE,'center',2);
        $colModel['ref_kepemilikan_aset.deskripsi'] = array('Kepemilikan',100,TRUE,'center',2);
        $colModel['no_sertifikat'] = array('No Sertifikat Tanah',120,TRUE,'center',2); 
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_bangunan/load_data'),$colModel,'id_aset_bangunan','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA BANGUNAN';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/bangunan/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_bangunan','no_imb','deskripsi','tgl_bangun','luas','ref_kepemilikan_aset.deskripsi','no_sertifikat','lokasi');
		
		$this->flexigrid->validate_post('id_aset_bangunan','DESC',$valid_fields);
		$records = $this->m_bangunan->getBangunanFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_aset_bangunan,
				$row->id_aset_bangunan,
				$row->no_imb,	
				$row->deskripsi,	
				date('j-m-Y ',strtotime($row->tgl_bangun)),
                $row->luas,				
				$row->kepemilikan_aset,	
				$row->no_sertifikat,			
				//$row->lokasi,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_bangunan(\''.$row->id_aset_bangunan.'\')"/><i class="fa fa-pencil"></i></button>'
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
			
			$data['json_array_nama'] = $this->autocomplete_NoSertifikat();
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			
			$data['page_title'] = 'TAMBAH DATA BANGUNAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/bangunan/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_bangunan() {
		
		$no_imb = $this->input->post('no_imb', TRUE);
		$tgl_bangun = $this->input->post('tgl_bangun', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);		
		$deskripsi = $this->input->post('deskripsi', TRUE);	
		$no_sertifikat = $this->input->post('no_sertifikat', TRUE);
		
		
		$id_aset_tanah = $this->m_bangunan->getIdTanahByNoSertifikat($no_sertifikat);
		
				
			$data = array(
				'no_imb' => $no_imb,			
				'tgl_bangun' => date('Y-m-d', strtotime($tgl_bangun)),
				'luas' => $luas,
				'id_kepemilikan_aset' => $id_kepemilikan_aset,
				'deskripsi' => $deskripsi,
				'id_aset_tanah' => $id_aset_tanah
			);
			
			$this->m_bangunan->insertBangunan($data);			
			$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
			redirect('aset/c_bangunan','refresh');
		;
		/* Handle ketika nomer imb telah digunakan */
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			//$data['json_array_nama'] = $this->autocomplete_NoSertifikat();
			
			$data['bangunan'] = $this->m_bangunan->getBangunanByIdBangunan($id);
			
			$data['tanah'] = $this->m_bangunan->getTanahByIdTanah($data['bangunan']->id_aset_tanah);
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			$data['page_title'] = 'UBAH DATA BANGUNAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/bangunan/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_bangunan() {	
		
		$id_aset_bangunan = $this->input->post('id_aset_bangunan', TRUE);
		
		$no_imb = $this->input->post('no_imb', TRUE);
		$tgl_bangun = $this->input->post('tgl_bangun', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);		
		$deskripsi = $this->input->post('deskripsi', TRUE);	
		$no_sertifikat = $this->input->post('no_sertifikat', TRUE);
		
		
		$id_aset_tanah = $this->m_bangunan->getIdTanahByNoSertifikat($no_sertifikat);
		
		$data = array(
			'no_imb' => $no_imb,			
			'tgl_bangun' => date('Y-m-d', strtotime($tgl_bangun)),
			'luas' => $luas,
			'id_kepemilikan_aset' => $id_kepemilikan_aset,
			'deskripsi' => $deskripsi,
			'id_aset_tanah' => $id_aset_tanah
		);
		
		$this->m_bangunan->updateBangunan(array('id_aset_bangunan' => $id_aset_bangunan), $data);
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');		
		redirect('aset/c_bangunan','refresh');
	
		
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_bangunan->deleteBangunan($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_bangunan','refresh');
    }
		
	public function autocomplete_NoSertifikat()
    {
        $nama = $this->input->post('no_sertifikat',TRUE);
        $rows = $this->m_bangunan->get_AsetTanah($nama);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->no_sertifikat.' | '.$row->deskripsi;
		}
        return json_encode($json_array);
    }
	
	function noImbExist()
	{	
		$no_imb = $this->input->post('no_imb');
		$cek = $this->m_bangunan->getNoImbExist($no_imb);
		if($cek == TRUE)
		{	echo true;	}
		else
		{	echo false;	}
	}
	
	public function export_to_excel()
	{
		$query = $this->m_bangunan->getExportExcel();
		
		//BORDER BOTTOM HEADER
		$styleArray = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		);
		$this->excel_generator->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
		unset($styleArray);
		//END BORDER BOTTOM HEADER
		
		//AUTOSIZE CELL
		for ($col = 'A'; $col != 'G'; $col++) {
		 $this->excel_generator->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		//END AUTOSIZE CELL
		
		$this->excel_generator->start_at(1);
		$this->excel_generator->set_header(array(
		'No IMB', 'Nama Bangunan','Tanggal Bangun', 'Luas Tanah (Ha)', 'Kepemilikan','No Sertifikat Tanah'
		));
		
		$this->excel_generator->set_column(array(
		'no_imb', 'deskripsi','tgl_bangun', 'luas', 'kepemilikan_aset','no_sertifikat'
		));
		
		$this->excel_generator->exportTo2003('Data Bangunan ('.date("d-m-Y").')');
	}
}
?>