<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_ped extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('ped/m_ped');		
        $this->load->helper('url');
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
		$colModel['id_ped'] = array('ID',30,TRUE,'left',0);
        $colModel['tbl_ped.deskripsi'] = array('Detil Potensi',150,TRUE,'left',2); 
        $colModel['ref_ped_sub.deskripsi'] = array('Jenis Potensi',130,TRUE,'center',2); 
        $colModel['ref_ped_kategori.deskripsi'] = array('Lahan',130,TRUE,'center',2); 
        $colModel['luas'] = array('Luas',70,TRUE,'center',0);
        $colModel['tbl_penduduk.nik'] = array('NIK Pengelola',120,TRUE,'center',2);
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

        $grid_js = build_grid_js('flex1',site_url('ped/c_ped/load_data'),$colModel,'id_ped','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA DETIL POTENSI DESA';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('ped/ped/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_ped','tbl_ped.deskripsi','ref_ped_sub.deskripsi','ref_ped_kategori.deskripsi','luas','tbl_penduduk.nik');
		
		$this->flexigrid->validate_post('id_ped','DESC',$valid_fields);
		$records = $this->m_ped->getPedFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_ped,
				$row->id_ped,
				$row->deskripsi,
				$row->jenis,
                $row->lahan,				
				'<p style="text-align:right;">'.$row->luas.' '.$row->satuan.'</p>',	
				$row->nik,				
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_ped(\''.$row->id_ped.'\')"/><i class="fa fa-pencil"></i></button>'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_sub'] = $this->m_ped->get_ped_sub();
			
			$data['json_array'] = $this->autocomplete_KepalaKeluarga();	
			$data['page_title'] = 'TAMBAH DETIL POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_ped() {
		
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_ped_sub = $this->input->post('id_ped_sub', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$nik	= $this->input->post('nik', TRUE);
		$id_penduduk = $this->m_ped->getIdPendudukByNIK($nik);
		$data = array(
			'deskripsi' => $deskripsi,
			'luas' => $luas,
			'id_ped_sub' => $id_ped_sub,
			'id_penduduk' => $id_penduduk
		);

		$this->m_ped->insertPed($data);		
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('ped/c_ped','refresh');
       
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['ped_sub'] = $this->m_ped->get_ped_sub();	
			
			$data['ped'] = $this->m_ped->getPedByIdPed($id);
			$data['json_array'] = $this->autocomplete_KepalaKeluarga();	
			$data['page_title'] = 'UBAH DETIL POTENSI DESA';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('ped/ped/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_ped() {	
	
		$id_ped = $this->input->post('id_ped', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$luas = $this->input->post('luas', TRUE);		
		$id_ped_sub = $this->input->post('id_ped_sub', TRUE);
		$lokasi = $this->input->post('lokasi', TRUE);
		$nik	= $this->input->post('nik', TRUE);
		$id_penduduk = $this->m_ped->getIdPendudukByNIK($nik);
		$data = array(
			'deskripsi' => $deskripsi,
			'luas' => $luas,
			'id_ped_sub' => $id_ped_sub,
			'id_penduduk' => $id_penduduk
		);

		$this->m_ped->updatePed(array('id_ped' => $id_ped), $data);	
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
		redirect('ped/c_ped','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_ped->deletePed($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('ped/c_ped', 'refresh');
    }
	
	public function autocomplete_KepalaKeluarga()
    {
        $nama = $this->input->post('nama',TRUE);
        $rows = $this->m_ped->getKepalaKeluargaLikeNama($nama);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->nik.' | '.$row->nama;
		}
        return json_encode($json_array);
    }
	
	public function export_to_excel()
	{
		$query = $this->m_ped->getExportExcel();
		
		//BORDER BOTTOM HEADER
		$styleArray = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		);
		$this->excel_generator->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);
		unset($styleArray);
		//END BORDER BOTTOM HEADER
		
		//AUTOSIZE CELL
		for ($col = 'A'; $col != 'F'; $col++) {
		 $this->excel_generator->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		//END AUTOSIZE CELL
		
		$this->excel_generator->start_at(1);
		$this->excel_generator->set_header(array(
		'Detil Potensi','Jenis Potensi','Lahan','Luas','NIK Pengelola'
		));
		
		$this->excel_generator->set_column(array(
		'deskripsi', 'jenis','lahan', 'luas', 'nik'
		));
		
		$this->excel_generator->exportTo2003('Data Detil Potensi ('.date("d-m-Y").')');
	}
		
}
?>