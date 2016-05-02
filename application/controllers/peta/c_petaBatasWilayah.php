<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_petaBatasWilayah extends CI_Controller {

	
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
			$this->pengaturan_peta(1);
		}else
			redirect('c_login', 'refresh');
        	
    }
	
	function pengaturan_peta($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Peta')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			$data['peta'] = $this->m_peta->getPeta();
			$data['batas_wilayah'] = $this->m_peta->getBatasWilayah();
						
			$data['page_title'] = 'PETA TANAH BATAS WILAYAH';
			$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
			$data['content'] = $this->load->view('peta/batas_wilayah/v_tambahPetaBatasWilayah', $data, TRUE);		
			
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

		$this->m_peta->updatePeta(array('id_peta' => 1), $data);
		redirect('peta/c_petaBatasWilayah','refresh');
    }
	
	
	
		
}
?>