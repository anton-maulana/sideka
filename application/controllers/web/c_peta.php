<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_peta extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       $this->load->model('m_peta');
       $this->load->model('m_logo');
	$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['konten_logo'] = $this->m_logo->getLogo();
		
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
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/peta',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);	
    }
	
	
}

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */