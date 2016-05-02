<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_petaBangunan extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_bangunan');
        $this->load->model('aset/m_aset'); 
        $this->load->model('m_peta');
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
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
        $colModel['lokasi'] = array('Lokasi Peta',110,TRUE,'center',2);
		$colModel['aksi'] = array('AKSI',50,FALSE,'center',0);
       
		
		//Populate flexigrid buttons..
        /* $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
		$buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn'); */
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

        $grid_js = build_grid_js('flex1',site_url('peta/c_petaBangunan/load_data'),$colModel,'id_aset_bangunan','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA ASET BANGUNAN';		
		$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
        $data['content'] = $this->load->view('peta/bangunan/v_listPetaBangunan', $data, TRUE);
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
				$this->cek_lokasi($row->lokasi),			
'<button type="submit" class="btn btn-success btn-xs" title="Pengaturan Peta" onclick="pengaturan_peta(\''.$row->id_aset_bangunan.'\')"/><i class="fa fa-map-marker"></i></button>
'
			);   
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    function cek_lokasi($lokasi)
	{
		if(!empty($lokasi)){ return 'Ada';}
		else { return '';}
	}
	function pengaturan_peta($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			$data['bangunan'] = $this->m_bangunan->getbangunanByIdbangunan($id);
			$data['peta'] = $this->m_peta->getPeta();
			
			
			$data['lokasi_null'] = $this->m_bangunan->cekLokasiNull($id);
			$data['page_title'] = 'PENGATURAN PETA ASET BANGUNAN';
			$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
			$data['content'] = $this->load->view('peta/bangunan/v_tambahPetaBangunan', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function simpan_peta() {	
	
		$lokasi = $this->input->post('lokasi', TRUE);
		$id_aset_bangunan = $this->input->post('id_aset_bangunan', TRUE);
		
		$data = array(
			'lokasi' => $lokasi
		);

		$this->m_bangunan->updatebangunan(array('id_aset_bangunan' => $id_aset_bangunan), $data);	
		
		redirect('peta/c_petaBangunan','refresh');
    }
	
	
	function delete()
    {
        $post = explode(",", $this->input->post('items'));
        array($post); $sucess=-1;
        foreach($post as $id){
            $this->m_bangunan->deletebangunan($id);
            $sucess++;
        }
		if ($sucess > 0 ){
            //echo 'Hapus '.$sucess.' item berhasil.';
        }else{
            //echo 'Tidak ada item yang dihapus.';
        }
        redirect('aset/c_bangunan', 'refresh');
    }
		
}
?>