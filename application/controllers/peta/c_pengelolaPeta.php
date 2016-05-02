<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_pengelolaPeta extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        $this->load->helper('form'); 
        $this->load->model('m_peta');	
		$this->load->model('m_logo');		
    }
	   
	
	function index()
    {		
		$data['peta'] = $this->m_peta->getPeta();
		
		$data['batas_wilayah'] = $this->m_peta->getBatasWilayah();
		$data['tanah'] = $this->m_peta->getKoordinatTanah();
		$data['bangunan'] = $this->m_peta->getKoordinatBangunan();
		$data['potensi'] = $this->m_peta->getKoordinatPotensi();
		$data['legend_batas_wilayah'] = $this->m_peta->getLegendBatasWilayah();
		$data['legend_tanah'] = $this->m_peta->getLegendTanah();
		$data['legend_bangunan'] = $this->m_peta->getLegendBangunan();
		$data['legend_potensi'] = $this->m_peta->getLegendPotensi();
		
		
		$data['base_url']=$this->config->item('base_url');
		$data['page_title'] = 'Pengelola Peta';	
		$data['konten_logo'] = $this->m_logo->getLogo();
		
		$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
		
		$data['content'] = $this->load->view('peta/v_pengelolaPeta', $data, TRUE);
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');       
    }
	
	

}
?>