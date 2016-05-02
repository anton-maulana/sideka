<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_logo extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
		$this->load->model('m_logo');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['konten_logo'] = $this->m_logo->getLogo();
		$this->load->view('v_logo', $data);
	}
}
?>