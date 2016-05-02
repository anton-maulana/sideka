<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sso extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('sso/m_sso');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$this->edit(1);
		}else
			redirect('c_login', 'refresh'); 
        	
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$data['sso'] = $this->m_sso->getSso(1);
			$data['page_title'] = 'Pengaturan Single Sign On';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('sso/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_sso() {	
	
		$app_id = $this->input->post('app_id', TRUE);
		$token_app = $this->input->post('token_app', TRUE);
		
		$data = array(
				'app_id' => $app_id,
				'token_app' => $token_app
			);

		$result = $this->m_sso->updateSso(array('id_sso' => 1), $data);
		
		$this->session->set_flashdata('message', 'Pengaturan berhasil dilakukan !');
		redirect('admin/c_sso','refresh');
		
    }

}
?>