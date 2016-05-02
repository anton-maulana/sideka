<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pindah extends CI_Controller {

	
    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('aset/m_pindah');
        $this->load->model('aset/m_aset');
        $this->load->helper('url');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$this->add();
		}else
			redirect('c_login', 'refresh');
        	
    }
	
    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Aset')
		{
			$s['cek'] = $this->session->userdata('logged_in');
			
			$data['json_array_aset'] = $this->autocomplete_NamaAset();
			$data['json_array_ruangan'] = $this->autocomplete_NamaRuangan();
			
			$data['page_title'] = 'PINDAH ASET KE RUANGAN LAIN';
			$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
			$data['content'] = $this->load->view('aset/pindah/v_tambah', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
    	
	function pindah_ruangan() {	
	
		$no_aset = $this->input->post('no_aset', TRUE);
		$nama_ruangan = $this->input->post('nama_ruangan', TRUE);
		
		$id_aset_master = $this->m_pindah->getIdAsetByNoAset($no_aset);
		$id_aset_ruangan = $this->m_pindah->getIdRuanganByNamaRuangan($nama_ruangan);
		
		$data = array(
			'id_aset_ruangan' => $id_aset_ruangan
		);

		$this->m_aset->updateAset(array('id_aset_master' => $id_aset_master), $data);	
		
		$this->session->set_flashdata('message', 'Aset berhasil dipindahkan !');
		redirect('aset/c_pindah','refresh');
    }
	
	public function autocomplete_NamaAset()
    {
        $nama = $this->input->post('nama',TRUE);
        $rows = $this->m_pindah->get_Aset($nama);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->no_aset.' | '.$row->nama;
		}
        return json_encode($json_array);
    }
	
	public function autocomplete_NamaRuangan()
    {
        $nama_ruangan = $this->input->post('nama_ruangan',TRUE);
        $rows = $this->m_pindah->get_AsetRuangan($nama_ruangan);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->nama_ruangan.' | '.$row->nama_bangunan;
		}
        return json_encode($json_array);
    }
		
}
?>