<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



//session_start();



class C_rencanaPembangunan extends CI_Controller {

    function __construct() {
        
        
        
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_user');
        //$this->load->model('m_kalkulasi');     
        //$this->load->model('statistik/m_kk');	
        $this->load->model('m_logo');
        $this->load->model('rencanaPembangunan/m_rencana_pembangunan');
        
        
    }

    function index() {
        $data['page_title'] = 'Perencana Pembangunan';
        $data['konten_logo'] = $this->m_logo->getLogo();
        
        
        
        //$data['jumlah_penduduk'] = $this->m_kalkulasi->getTotalPenduduk();
        //$data['jumlah_penduduk_laki'] = $this->m_kalkulasi->getTotalPendudukByKelamin('1');
        //$data['jumlah_penduduk_perempuan'] = $this->m_kalkulasi->getTotalPendudukByKelamin('2');
        $data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);

        //$data['jumlah_kk_perempuan'] = $this->m_kk->getKkPerempuan();
        //$data['jumlah_kk_laki'] = $this->m_kk->getKkLaki();		

        $data['rpjmdes'] = $this->m_rencana_pembangunan->getRpjmdes();
        $data['rkpdes'] = $this->m_rencana_pembangunan->getRkpdes();
        $data['rabdes'] = $this->m_rencana_pembangunan->getRabdes();
        $data['spp'] = $this->m_rencana_pembangunan->getSpp();

        $data['content'] = $this->load->view('rencanaPembangunan/v_rencanaPembangunan', $data, TRUE);
        if ($this->session->userdata('logged_in')) {
            $this->load->view('utama', $data);
        } else
            redirect('c_login', 'refresh');
    }

}
