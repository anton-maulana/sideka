<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_aset extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
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
		$colModel['id_aset_master'] = array('ID',30,TRUE,'left',0);
        $colModel['no_aset'] = array('No Aset',80,TRUE,'left',2);  
        $colModel['nama'] = array('Nama',100,TRUE,'left',2);  
        $colModel['merk'] = array('Merk',100,TRUE,'left',2);  
        $colModel['ketersediaan'] = array('Ketersediaan',75,TRUE,'center',2); 		
        $colModel['kondisi'] = array('Kondisi',60,TRUE,'center',2); 
        $colModel['kepemilikan_aset'] = array('Kepemilikan',100,TRUE,'center',2); 
        $colModel['asal_aset'] = array('Asal Aset',100,TRUE,'center',2); 
        $colModel['kategori_aset'] = array('Kategori',110,TRUE,'center',2); 
        $colModel['nama_ruangan'] = array('Nama Ruangan',100,TRUE,'center',2); 
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

        $grid_js = build_grid_js('flex1',site_url('aset/c_aset/load_data'),$colModel,'id_aset_master','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA ASET';		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
        $data['content'] = $this->load->view('aset/aset/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_master','no_aset','nama','merk','ketersediaan','kondisi','kepemilikan_aset','asal_aset','kategori_aset','nama_ruangan');
		
		$this->flexigrid->validate_post('id_aset_master','DESC',$valid_fields);
		$records = $this->m_aset->getAsetFlexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                $row->id_aset_master,
				$row->id_aset_master,
				$row->no_aset,
				$row->nama,
				$row->merk,			
				$row->ketersediaan,				
				$row->kondisi,		
				$row->kepemilikan_aset,			
				$row->asal_aset,			
				$row->kategori_aset,			
				$row->nama_ruangan,			
'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_aset(\''.$row->id_aset_master.'\')"/><i class="fa fa-pencil"></i></button>'
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
			
			$data['json_array_nama'] = $this->autocomplete_NamaRuangan();
			
			$data['kategori'] = $this->m_aset->getKategoriAset();
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			$data['asal'] = $this->m_aset->getAsalAset();
			
			$data['page_title'] = 'TAMBAH DATA ASET';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/aset/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }

	function simpan_aset() {
		
		$nama_ruangan = $this->input->post('nama_ruangan', TRUE);
				
		$nama = $this->input->post('nama', TRUE);		
		$merk = $this->input->post('merk', TRUE);		
		$spesifikasi = $this->input->post('spesifikasi', TRUE);		
		$tgl_beli = $this->input->post('tgl_beli', TRUE);		
		$ketersediaan = $this->input->post('ketersediaan', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);		
		$id_asal_aset = $this->input->post('id_asal_aset', TRUE);		
		$kondisi = $this->input->post('kondisi', TRUE);		
		$keterangan = $this->input->post('keterangan', TRUE);		
		
		$id_kategori_aset = $this->input->post('id_kategori_aset', TRUE);	
				
		$id_aset_ruangan = $this->m_aset->getIdRuanganByNamaRuangan($nama_ruangan);
				
		$data = array(				
			'nama' => $nama,		
			'merk' => $merk,		
			'spesifikasi' => $spesifikasi,		
			'tgl_beli' => date('Y-m-d', strtotime($tgl_beli)),
			'ketersediaan' => $ketersediaan,		
			'id_kepemilikan_aset' => $id_kepemilikan_aset,		
			'id_asal_aset' => $id_asal_aset,		
			'kondisi' => $kondisi,		
			'keterangan' => $keterangan,		
			'id_kategori_aset' => $id_kategori_aset,		
			'id_aset_ruangan' => $id_aset_ruangan
		);
		
		$this->m_aset->insertAset($data);
		$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
		redirect('aset/c_aset','refresh');
	
    }
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['json_array_nama'] = $this->autocomplete_NamaRuangan();
			$data['kategori'] = $this->m_aset->getKategoriAset();
			$data['kepemilikan'] = $this->m_aset->getKepemilikanAset();
			$data['asal'] = $this->m_aset->getAsalAset();
			
			$data['aset'] = $this->m_aset->getAsetByIdAset($id);
			
			$data['ruangan_bangunan'] = $this->m_aset->getRuanganAndBangunanByIdRuangan($data['aset']->id_aset_ruangan);
			
			$data['page_title'] = 'UBAH DATA ASET';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/aset/v_ubah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_aset() {	
		
		$id_aset_master = $this->input->post('id_aset_master', TRUE);
		
		$nama_ruangan = $this->input->post('nama_ruangan', TRUE);
				
		$nama = $this->input->post('nama', TRUE);		
		$merk = $this->input->post('merk', TRUE);		
		$spesifikasi = $this->input->post('spesifikasi', TRUE);		
		$tgl_beli = $this->input->post('tgl_beli', TRUE);		
		$ketersediaan = $this->input->post('ketersediaan', TRUE);		
		$id_kepemilikan_aset = $this->input->post('id_kepemilikan_aset', TRUE);		
		$id_asal_aset = $this->input->post('id_asal_aset', TRUE);		
		$kondisi = $this->input->post('kondisi', TRUE);		
		$keterangan = $this->input->post('keterangan', TRUE);		
		
		$id_kategori_aset = $this->input->post('id_kategori_aset', TRUE);	
				
		$id_aset_ruangan = $this->m_aset->getIdRuanganByNamaRuangan($nama_ruangan);
				
		$data = array(				
			'nama' => $nama,		
			'merk' => $merk,		
			'spesifikasi' => $spesifikasi,		
			'tgl_beli' => date('Y-m-d', strtotime($tgl_beli)),
			'ketersediaan' => $ketersediaan,		
			'id_kepemilikan_aset' => $id_kepemilikan_aset,		
			'id_asal_aset' => $id_asal_aset,		
			'kondisi' => $kondisi,		
			'keterangan' => $keterangan,		
			'id_kategori_aset' => $id_kategori_aset,		
			'id_aset_ruangan' => $id_aset_ruangan
		);
		
		$this->m_aset->updateAset(array('id_aset_master' => $id_aset_master), $data);
		$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');		
		redirect('aset/c_aset','refresh');
	
		
    }
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_aset->deleteAset($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_aset','refresh');
    }
		
	public function autocomplete_NamaRuangan()
    {
        $nama_ruangan = $this->input->post('nama_ruangan',TRUE);
        $rows = $this->m_aset->get_AsetRuangan($nama_ruangan);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->nama_ruangan.' | '.$row->nama_bangunan;
		}
        return json_encode($json_array);
    }

	public function ExportToExcel()
	{
		$query = $this->m_aset->getExportExcel();
		
		//BORDER BOTTOM HEADER
		$styleArray = array(
			'borders' => array(
				'bottom' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			)
		);
		$this->excel_generator->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
		unset($styleArray);
		//END BORDER BOTTOM HEADER
		
		//AUTOSIZE CELL
		for ($col = 'A'; $col != 'L'; $col++) {
		 $this->excel_generator->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		//END AUTOSIZE CELL
		
		$this->excel_generator->start_at(1);
		$this->excel_generator->set_header(array(
		'No Aset', 'Nama','Merk', 'Ketersediaan', 'Kondisi', 'Kepemilikan', 'Asal Aset', 'Kategori', 'Nama Bangunan','Spesifikasi','Keterangan'
		));
		
		$this->excel_generator->set_column(array(
		'no_aset','nama','merk','ketersediaan','kondisi','kepemilikan_aset','asal_aset','kategori_aset','nama_ruangan','spesifikasi','keterangan'
		));
		
		$this->excel_generator->exportTo2003('Data Aset ('.date("d-m-Y").')');
	}
}
?>