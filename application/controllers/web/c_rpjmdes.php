<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rpjmdes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        $this->load->model('sso/m_sso');
                
        $this->load->library('flexigrid');
        $this->load->helper(array('flexigrid_helper', 'common_helper'));
        $this->config->load('rp_rancangan_rpjm_desa');
        
        $this->load->model(array(
            'rencanaPembangunan/m_rancangan_rpjm_desa',
            'rencanaPembangunan/m_master_rancangan_rpjm_desa',
            'rencanaPembangunan/m_sumber_dana_desa',
            'rencanaPembangunan/m_bidang'));      
       
    }
    
	
	function index()
    {
        $r_m_rpjm_desa_config = $this->config->item('rp_master_rancangan_rpjm_desa');
        $colModelM = $r_m_rpjm_desa_config['colModel'];

        $gridParams = $r_m_rpjm_desa_config['gridParams'];

        $grid_js = build_grid_js('flex1', site_url('web/c_rpjmdes/load_data'), $colModelM, 'id_m_rancangan_rpjm_desa', 'desc', $gridParams);

        $data['js_grid'] = $grid_js;
        $data['page_title'] = 'DATA RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
    

		
		$data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/rpjmdes',$data,TRUE);
		$this->load->view('templateHome',$temp);
	}
    public function detail($id) {   
        $r_rpjm_desa_config = $this->config->item('rp_rancangan_rpjm_desa');
        $colModel = $r_rpjm_desa_config['colModel'];

        //Populate flexigrid buttons..
        

        $gridParams = $r_rpjm_desa_config['gridParams'];
        

        $grid_js = build_grid_js('flex1', site_url('web/c_rpjmdes/load_detail/' . $id), $colModel, 'id_rancangan_rpjm_desa', 'asc', $gridParams);
        
        $data['js_grid']= $grid_js;
        
        $data['id_m_rancangan_rpjm_desa']= $id;

        $data['page_title'] = 'DATA RPJMDes';
        $data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';

		
		$data['data_sso'] = $this->m_sso->getSso(1);	
        $data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$temp['content'] = $this->load->view('web/content/rpjmdes',$data,TRUE);
		$data['templateHome']=$this->load->view('templateHome',$temp);
    }    
        
     public function load_detail($id) {
        $this->load->library('flexigrid');
        $this->load->helper('common_helper');
        $valid_fields = array('id_rancangan_rpjm_desa');

        $this->flexigrid->validate_post('id_m_rancangan_rpjm_desa', 'ASC', $valid_fields);

        $records = $this->m_rancangan_rpjm_desa->getFlexigrid($id);

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_rancangan_rpjm_desa,
                $row->id_rancangan_rpjm_desa,
                $row->bidang,
                $row->sub_bidang,
                $row->jenis_kegiatan,
                $row->lokasi_rt_rw,
                $row->prakiraan_volume,
                $row->sasaran_manfaat,
                ($row->tahun_pelaksanaan_1 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->tahun_pelaksanaan_2 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->tahun_pelaksanaan_3 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->tahun_pelaksanaan_4 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->tahun_pelaksanaan_5 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->tahun_pelaksanaan_6 != 0 ? '<i class="fa fa-check"></i>' : ' '),
                rupiah_display($row->jumlah_biaya),
                $row->sumber_biaya,
                ($row->swakelola != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->kerjasama_antar_desa != 0 ? '<i class="fa fa-check"></i>' : ' '),
                ($row->kerjasama_pihak_ketiga != 0 ? '<i class="fa fa-check"></i>' : ' '),
                '<a  title="Download Excel" href="' . base_url() . 'rencanaPembangunan/c_rancangan_rpjm_desa/export_excel/'.$row->id_m_rancangan_rpjm_desa.'" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            
           );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }

    
    function load_data() {
        $this->load->library('flexigrid');
        $valid_fields = array('id_m_rancangan_rpjm_desa');

        $this->load->model('rencanaPembangunan/m_master_rancangan_rpjm_desa');
        $this->flexigrid->validate_post('id_m_rancangan_rpjm_desa', 'DESC', $valid_fields);
        $records = $this->m_master_rancangan_rpjm_desa->getFlexigrid();

        $this->output->set_header($this->config->item('json_header'));

        $record_items = array();

        foreach ($records['records']->result() as $row) {
            $record_items[] = array(
                $row->id_m_rancangan_rpjm_desa,
                $row->id_m_rancangan_rpjm_desa,
                $row->tahun_awal,
                $row->tahun_akhir,
                $row->tahun_anggaran,
                $row->nama_file,
                rupiah_display($row->total_bidang_1),
                rupiah_display($row->total_bidang_2),
                rupiah_display($row->total_bidang_3),
                rupiah_display($row->total_bidang_4),
                rupiah_display($row->total_keseluruhan),
                $row->tanggal_disusun,
                $row->disusun_oleh,
                $row->kepala_desa,
                $row->id_desa,
                $row->nama_desa,
                $row->id_kecamatan,
                $row->nama_kecamatan,
                $row->id_kab_kota,
                $row->nama_kab_kota,
                $row->id_provinsi,
                $row->nama_provinsi,
                '<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil RPJM" onclick="show_detail_program(\'' . $row->id_m_rancangan_rpjm_desa . '\')"/>' .
                '<i class="fa fa-list-alt"></i>' .
                '</button>&nbsp;' .
                /**
                 * @todo Buat generate excel untuk rpjm
                 */
                '<a  title="Download Excel" href="' . base_url() . 'rencanaPembangunan/c_rancangan_rpjm_desa/export_excel/'.$row->id_m_rancangan_rpjm_desa.'" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>'
            );
        }
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items));
    }
        

}