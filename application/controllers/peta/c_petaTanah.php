<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_petaTanah extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_tanah');
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
		$colModel['id_aset_tanah'] = array('ID',30,TRUE,'left',0);
        $colModel['no_sertifikat'] = array('No Sertifikat',150,TRUE,'left',2); 		
        $colModel['tbl_aset_tanah.deskripsi'] = array('Deskripsi',200,TRUE,'center',2);
        $colModel['luas'] = array('Luas Tanah (Ha)',110,TRUE,'center',2); 
        $colModel['ref_kepemilikan_aset.deskripsi'] = array('Kepemilikan',100,TRUE,'center',2);
        $colModel['lokasi'] = array('Lokasi Peta',110,TRUE,'center',2);
		$colModel['aksi'] = array('AKSI',40,FALSE,'center',0);
       
		
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

        $grid_js = build_grid_js('flex1',site_url('peta/c_petaTanah/load_data'),$colModel,'id_aset_tanah','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA ASET TANAH';		
		$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
        $data['content'] = $this->load->view('peta/tanah/v_listPetaTanah', $data, TRUE);
        $this->load->view('utama', $data);
    }
    
    function load_data() {
	
        $this->load->library('flexigrid');
		
		$valid_fields = array('id_aset_tanah','no_sertifikat','tbl_aset_tanah.deskripsi','luas','ref_kepemilikan_aset.deskripsi','lokasi');
		
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
                $this->cek_lokasi($row->lokasi),	
'<button type="submit" class="btn btn-success btn-xs" title="Pengaturan Peta" onclick="pengaturan_peta(\''.$row->id_aset_tanah.'\')"/><i class="fa fa-map-marker"></i></button>
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
			$data['tanah'] = $this->m_tanah->getTanahByIdTanah($id);
			$data['peta'] = $this->m_peta->getPeta();
			
			
			$data['kepemilikan'] = $this->m_aset->getDeskripsiKepemilikan($data['tanah']->id_kepemilikan_aset);
			$data['lokasi_null'] = $this->m_tanah->cekLokasiNull($id);
			$data['page_title'] = 'PENGATURAN ASET PETA TANAH';
			$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
			$data['content'] = $this->load->view('peta/tanah/v_tambahPetaTanah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function simpan_peta() {	
	
		$lokasi = $this->input->post('lokasi', TRUE);
		$id_aset_tanah = $this->input->post('id_aset_tanah', TRUE);
		
		$data = array(
			'lokasi' => $lokasi
		);

		$this->m_tanah->updateTanah(array('id_aset_tanah' => $id_aset_tanah), $data);	
		
		redirect('peta/c_petaTanah','refresh');
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
		
}
?>