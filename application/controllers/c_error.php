<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_error extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
        $this->load->helper('url');
    }
	
	public function index()
    {
		$this->output->set_status_header('404');
		$this->load->view('errors/v_error404.php');
	}

}
?>