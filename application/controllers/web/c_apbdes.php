<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_apbdes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        $this->load->model('sso/m_sso');
        
        $this->load->helper(array('flexigrid_helper', 'common_helper'));
        $this->config->load('rp_apb_desa');
        $this->load->model(array(
            'rencanaPembangunan/m_rancangan_rpjm_desa',
            'rencanaPembangunan/m_master_rkp',
            'rencanaPembangunan/m_apbdes',
            'rencanaPembangunan/m_master_apbdes',
            'rencanaPembangunan/m_rkp',
            'rencanaPembangunan/m_coa',
            'rencanaPembangunan/m_master_rancangan_rpjm_desa'));
    }
	
	function index()
    {
        
        $r_m_apb_desa_config = $this->config->item('rp_master_apb_desa');

        $colModelM = $r_m_apb_desa_config['colModel'];
        $gridParams = $r_m_apb_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_apbdes/load_data_master'), $colModelM, 'id_m_apbdes', 'desc', $gridParams);

        $data['js_grid'] = $grid_js;
        $data['page_title'] = 'DATA APBDes';
        $data['deskripsi_title'] = 'Anggaran Pendapatan dan Belanja Desa';
        
		$data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
        
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/apbdes',$data,TRUE);
		$this->load->view('templateHome',$temp);
        
         
        //var_dump($grid_js);exit;
	}
    public function detail($id) {
        $r_m_rpjm_desa_config = $this->config->item('content_rp_apb_desa');

        $colModelM = $r_m_rpjm_desa_config['colModel'];
        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_apbdes/load_data_detail/' . $id), $colModelM, 'id_coa', 'asc', $gridParams);

        $attention_message = $this->session->flashdata('attention_message');
        $data['id_m_rkp']= $id;
        $data['js_grid']= $grid_js;
        $data['page_title'] = 'Detail APBDes';
        $data['deskripsi_title'] = 'Anggaran Pendapatan dan Belanja Desa';
        
        $data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/apbdes',$data,TRUE);
		$data['templateHome']=$this->load->view('templateHome',$temp);
    }

    public function load_data_detail($id_m_apbdes = FALSE) {
        $this->load->library('flexigrid');
        $valid_fields = array('id_apbdes');

        $this->flexigrid->validate_post('id_apbdes', 'ASC', $valid_fields);
        $records = $this->m_apbdes->getFlexigrid($id_m_apbdes);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        if ($records['records']) {
            foreach ($records['records']->result() as $row) {
                $record_items[] = array(
                    $row->id_apbdes,
                    $row->id_apbdes,
                    $row->id_m_apbdes,
                    $row->id_coa,
                    $row->kode_rekening,
                    rupiah_display($row->anggaran),
                    $row->keterangan
            );
            }
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }
    
    public function load_data_master() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_m_apbdes');

        $this->flexigrid->validate_post('id_m_apbdes', 'ASC', $valid_fields);
        $records = $this->m_master_apbdes->getFlexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_m_apbdes,
                $row->id_m_apbdes,
                $row->id_m_rkp,
                $row->rkp_tahun,
                rupiah_display($row->total_pendapatan),
                rupiah_display($row->total_belanja),
                rupiah_display($row->total_pembiayaan),
                $row->tanggal_disetujui,
                $row->disetujui_oleh,
                '<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil APB Desa" onclick="show_detail_program(\'' . $row->id_m_apbdes . '\')"/>' .
                '<i class="fa fa-list-alt"></i>' .
                '</button>&nbsp;' .
                '<a  title="Download Excel" href="' . base_url() . 'rencanaPembangunan/c_apbdes/export_excel/' . $row->id_m_apbdes . '" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }
    
}