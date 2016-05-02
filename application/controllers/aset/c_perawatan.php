<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_perawatan extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_perawatan');
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
		$colModel['id_aset_perawatan_bgn'] = array('ID',30,TRUE,'left',0);
        $colModel['tbl_aset_bangunan.no_imb'] = array('No IMB',120,TRUE,'left',2);  
        $colModel['tbl_aset_bangunan.deskripsi'] = array('Nama Bangunan',120,TRUE,'left',2);  
        $colModel['tgl_perawatan'] = array('Tanggal Perawatan',100,TRUE,'center',2); 
        $colModel['tbl_aset_perawatan_bgn.deskripsi'] = array('Deskripsi',150,TRUE,'center',2);
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_perawatan/load_data'),$colModel,'id_aset_perawatan_bgn','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA PERAWATAN BANGUNAN';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/perawatan/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_perawatan_bgn','tbl_aset_bangunan.no_imb','tbl_aset_bangunan.deskripsi','tgl_perawatan','tbl_aset_perawatan_bgn.deskripsi');
		
		$this->flexigrid->validate_post('id_aset_perawatan_bgn','DESC',$valid_fields);
		$records = $this->m_perawatan->getPerawatanFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_aset_perawatan_bgn,
				$row->id_aset_perawatan_bgn,
				$row->no_imb,
				$row->nama_bangunan,
				date('j-m-Y ',strtotime($row->tgl_perawatan)),
				$row->deskripsi,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_perawatan(\''.$row->id_aset_perawatan_bgn.'\')"/><i class="fa fa-pencil"></i></button>'
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
			
			$data['page_title'] = 'TAMBAH DATA PERAWATAN BANGUNAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/perawatan/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_perawatan() {
		
		$no_imb = $this->input->post('no_imb', TRUE);
		
		$tgl_perawatan = $this->input->post('tgl_perawatan', TRUE);	
		$deskripsi = $this->input->post('deskripsi', TRUE);		
				
		$id_aset_bangunan = $this->m_perawatan->getIdPerawatanByNoImb($no_imb);
				
		$data = array(			
			'tgl_perawatan' => date('Y-m-d', strtotime($tgl_perawatan)),
			'deskripsi' => $deskripsi,
			'id_aset_bangunan' => $id_aset_bangunan
			
		);
		
		$this->m_perawatan->insertPerawatan($data);
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('aset/c_perawatan','refresh');
	
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['json_array_nama'] = $this->autocomplete_NoImb();
			
			$data['perawatan'] = $this->m_perawatan->getPerawatanByIdPerawatan($id);
			
			$data['bangunan'] = $this->m_perawatan->getBangunanByIdBangunan($data['perawatan']->id_aset_bangunan);
			
			$data['page_title'] = 'UBAH DATA PERAWATAN BANGUNAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/perawatan/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_perawatan() {	
		
		$id_aset_perawatan_bgn = $this->input->post('id_aset_perawatan_bgn', TRUE);
		
		$no_imb = $this->input->post('no_imb', TRUE);
		
		$tgl_perawatan = $this->input->post('tgl_perawatan', TRUE);	
		$deskripsi = $this->input->post('deskripsi', TRUE);		
				
		$id_aset_bangunan = $this->m_perawatan->getIdPerawatanByNoImb($no_imb);
		
		$data = array(			
			'tgl_perawatan' => date('Y-m-d', strtotime($tgl_perawatan)),
			'deskripsi' => $deskripsi,
			'id_aset_bangunan' => $id_aset_bangunan
			
		);
		
		$this->m_perawatan->updatePerawatan(array('id_aset_perawatan_bgn' => $id_aset_perawatan_bgn), $data);
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');	
		redirect('aset/c_perawatan','refresh');
	
		
    }
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_perawatan->deletePerawatan($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_perawatan','refresh');
    }
		
	public function autocomplete_NoImb()
    {
        $no_imb = $this->input->post('no_imb',TRUE);
        $rows = $this->m_perawatan->get_AsetPerawatan($no_imb);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->no_imb.' | '.$row->deskripsi;
		}
        return json_encode($json_array);
    }
	
	public function export_to_excel()
	{
		$query = $this->m_perawatan->getExportEcxel();
		
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
		'No IMB', 'Nama Bangunan','Tanggal Perawatan', 'Deskripsi'
		));
		
		$this->excel_generator->set_column(array(
		'no_imb', 'nama_bangunan','tgl_perawatan', 'deskripsi'
		));
		
		$this->excel_generator->exportTo2003('Data Perawatan Bangunan ('.date("d-m-Y").')');
	}

}
?>