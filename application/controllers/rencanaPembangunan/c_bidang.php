<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_bidang extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('rencanaPembangunan/m_bidang');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh'); 
    }

    function lists() {
        $colModel['id_bidang'] = array('ID',30,TRUE,'center',0);
		$colModel['kode_bidang'] = array('Kode',60,TRUE,'left',0);
		$colModel['ket_level'] = array('Keterangan Kode',100,TRUE,'left',2);
		$colModel['deskripsi'] = array('Deskripsi',350,TRUE,'left',2);
		//$colModel['id_parent_bidang'] = array('Id Parent',100,TRUE,'left',2);
		//$colModel['id_top_bidang'] = array('Id Top',100,TRUE,'left',2);
		//$colModel['level'] = array('Level',60,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',60,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 300,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('rencanaPembangunan/c_bidang/load_data'),$colModel,'id_bidang','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA KODE REKENING';
        $data['deskripsi_title'] = '';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/bidang/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_bidang','deskripsi');

		$this->flexigrid->validate_post('id_bidang','ASC',$valid_fields);
		$records = $this->m_bidang->get_bidang_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			if($row->id_parent_bidang == null)
			{
			$record_items[] = array(
				$row->id_bidang,
				$row->id_bidang,
				$row->kode_bidang,
				$this->ket_level($row->level), //menampilkan keterangan kode bidang berdasarkan level dari bidang tsb
				$row->deskripsi,
				//$row->id_parent_bidang,
				//$row->id_top_bidang,
				//$row->level,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Detil Bidang" onclick="show_detail_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-eye"></i></button>
				'
			);  
			}
			else
			$record_items[] = array(
				$row->id_bidang,
				$row->id_bidang,
				$row->kode_bidang,
				$this->ket_level($row->level),//menampilkan keterangan kode bidang berdasarkan level dari bidang tsb
				$row->deskripsi,
				//$row->id_parent_bidang,
				//$row->id_top_bidang,
				//$row->level,
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Bidang" onclick="add_sub_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
 
	function show_detail_bidang($id) {
		$colModel['id_bidang'] = array('ID',30,TRUE,'center',0);
		$colModel['kode_bidang'] = array('Kode',60,TRUE,'left',0);
		$colModel['ket_level'] = array('Keterangan Kode',100,TRUE,'left',2);
		$colModel['deskripsi'] = array('Deskripsi',350,TRUE,'left',2);
		//$colModel['id_parent_bidang'] = array('Id Parent',100,TRUE,'left',2);
		//$colModel['id_top_bidang'] = array('Id Top',100,TRUE,'left',2);
		//$colModel['level'] = array('Level',60,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',60,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Back','prev','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 310,
            'rp' => 20,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);
		//$data['id_bidang'] = $id;
		$data['id_bidang'] = $id;
		$data['deskripsi'] = $this->m_bidang->getDeskripsi_ByIdBidang($id);
		$data['kode_bidang'] = $this->m_bidang->getKodeBidang_ByIdBidang($id);
        $grid_js = build_grid_js('flex_bidang',site_url('rencanaPembangunan/c_bidang/load_detail_bidang/'.$id),$colModel,'id_bidang','asc',$gridParams,$buttons);
																						
		$data['js_grid'] = $grid_js;
		
        $data['page_title'] = 'DETAIL KODE REKENING';
        $data['deskripsi_title'] = '';		
		$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
        $data['content'] = $this->load->view('rencanaPembangunan/bidang/v_tampil_detil_bidang', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_detail_bidang($id) {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_bidang','kode_rekening');
		
		$this->flexigrid->validate_post('id_bidang','ASC',$valid_fields);
		$records = $this->m_bidang->get_bidang_flexigrid_byIdBidang($id);
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			if($row->id_parent_bidang == null )
			{
			$record_items[] = array(
				$row->id_bidang,
				$row->id_bidang,
				$row->kode_bidang,
				$this->ket_level($row->level),//menampilkan keterangan kode bidang berdasarkan level dari bidang tsb
				$row->deskripsi,
				//$row->id_parent_bidang,
				//$row->id_top_bidang,
				//$row->level,
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Bidang" onclick="add_sub_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-plus-square"></i></button>'
			);  
			}
			else if($row->level == 4 )
			{
			$record_items[] = array(
				$row->id_bidang,
				$row->id_bidang,
				$row->kode_bidang,
				$this->ket_level($row->level),//menampilkan keterangan kode bidang berdasarkan level dari bidang tsb
				$row->deskripsi,
				//$row->id_parent_bidang,
				//$row->id_top_bidang,
				//$row->level,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
			}
			else
			$record_items[] = array(
				$row->id_bidang,
				$row->id_bidang,
				$row->kode_bidang,
				$this->ket_level($row->level),//menampilkan keterangan kode bidang berdasarkan level dari bidang tsb
				$row->deskripsi,
				//$row->id_parent_bidang,
				//$row->id_top_bidang,
				//$row->level,
				'<button type="submit" class="btn btn-success btn-xs" title="Tambah Sub Bidang" onclick="add_sub_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-plus-square"></i></button>
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_bidang(\''.$row->id_bidang.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items)); 
    }

	function ket_level($level)
	{
		if($level == 1)
		{
			return $level = 'Bidang';
		}
		else if($level == 2)
		{
			return $level = 'Urusan';
		}
		else if($level == 3)
		{
			return $level = 'Program';
		}
		else
		{
			return $level = 'Kegiatan';
		}
	}
	
    function add(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{			
			$data['page_title'] = 'TAMBAH DATA BIDANG';		
			$data['deskripsi_title'] = '';
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/bidang/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
        
    }
	
	function simpan_bidang() {
		$kode_bidang = $this->input->post('kode_bidang', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$id_tahun_anggaran = $this->input->post('id_tahun_anggaran', TRUE);
		$id_bidang = $this->input->post('id_bidang', TRUE);
		
		$this->form_validation->set_rules('kode_bidang', 'Kode Bidang', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_bidang->cekFIleExist($deskripsi);				
			
			if ($result['hasil'] == NULL) {				
				$data = array(
					'kode_bidang' => $kode_bidang,
					'deskripsi' => $deskripsi,
					'id_bidang' => $id_bidang,
					'level' => '1'
				);

			$this->m_bidang->insertBidang($data);	
			redirect('rencanaPembangunan/c_bidang','refresh');
			}			
			else $this->add();
			/* Handle ketika kode_rekening bidang telah digunakan */
        }
		else $this->add();
    }
	
	function add_sub_bidang($id){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{	
			$data['id_bidang'] = $id;
			$id_bidang = $this->m_bidang->getId_ByIdBidang($id);
			$data['page_title'] = 'TAMBAH SUB KODE REKENING';
			$data['deskripsi_title'] = '';
			$data['bidang'] = $this->m_bidang->getRowBidang_ByIdBidang($id);
			$data['deskripsi_bidang'] = $this->m_bidang->getDeskripsi_ByIdBidang($id_bidang);
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/bidang/v_tambah_sub_bidang', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function simpan_sub_bidang() {
		$kode = $this->input->post('kode', TRUE);
		$sub_kode = $this->input->post('sub_kode', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$sub_deskripsi = $this->input->post('sub_deskripsi', TRUE);
		$id_bidang = $this->input->post('id_bidang', TRUE);
		$id_parent_bidang = $this->input->post('id_parent_bidang', TRUE);
		$id_top_bidang = $this->input->post('id_top_bidang', TRUE);
		$level = $this->input->post('level', TRUE);
		
		if($id_top_bidang == null)
		{
			$id_top_bidang = $id_bidang;
		}
		else
		{
			$id_top_bidang = $this->m_bidang->getIdTopBidang_ByIdBidang($id_bidang);
		}
		
		$this->form_validation->set_rules('sub_deskripsi', 'Nama Sub Bidang', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_bidang->cekFIleExist($sub_deskripsi);				
			
			if ($result['hasil'] == NULL) 
			{				
				$data = array(
					'id_parent_bidang' => $id_bidang,
					'kode_bidang' => $sub_kode,
					'deskripsi' => $sub_deskripsi,
					'id_top_bidang' => $id_top_bidang,
					'level' => $level + 1
				);
				$this->m_bidang->insertBidang($data);
				if(!$id_top_bidang == null)
				{
					redirect('rencanaPembangunan/c_bidang/show_detail_bidang/'.$id_top_bidang,'refresh');
				}
				else
				{
					redirect('rencanaPembangunan/c_bidang/show_detail_bidang/'.$id_bidang,'refresh');
				}
			}			
			else $this->add_sub_bidang($id_bidang);
			/* Handle ketika kode_rekening bidang telah digunakan */
        }
		else $this->add_sub_bidang($id_bidang);
    }

	function show_tree_bidang(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{	
			//$data['id_bidang'] = $id;
			//$data['bidang'] = $this->m_bidang->getResultBidangByIdBidang($id);
			//$data['bidang_tes'] = $this->m_bidang->getResultBidangByIdBidang($id);
			//$data['bidang_num_row'] = $this->m_bidang->getNumRowBidangByIdBidang($id);
			
			$data['kode_rekening_list'] = $this->m_bidang->get_kode_rekening();
			$data['subkode_rekening_list'] = $this->m_bidang->get_subkode_rekening();
			
			$data['page_title'] = 'PROGRAM RPJMDes';
			$data['deskripsi_title'] = 'Rencana Pembangunan Jangka Menengah Desa';
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/bidang/v_tampil_tree_kode_rekening', $data, TRUE);
		
			$this->load->view('utama', $data);
		}
		else
			redirect('c_login', 'refresh'); 
    }
	
    function edit($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Perencana Pembangunan')
		{
			$data['id_bidang'] = $id;
			$data['bidang'] = $this->m_bidang->getRowBidang_ByIdBidang($id);
			$data['page_title'] = 'EDIT DATA KODE REKENING';
			$data['deskripsi_title'] = '';
			$data['menu'] = $this->load->view('menu/v_rencanaPembangunan', $data, TRUE);
			$data['content'] = $this->load->view('rencanaPembangunan/bidang/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_bidang() 
	{	
		$id_bidang = $this->input->post('id_bidang', TRUE);
		$kode_bidang = $this->input->post('kode_bidang', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$id_parent_bidang = $this->input->post('id_parent_bidang', TRUE);
		$id_top_bidang = $this->input->post('id_top_bidang', TRUE);
		$level = $this->input->post('level', TRUE);
		
		if($id_parent_bidang == '' && $id_top_bidang =='')
		{
			$id_parent_bidang = null;
			$id_top_bidang = null;
		}
		else
			$id_parent_bidang = $id_parent_bidang;
			$id_top_bidang = $id_top_bidang;
		
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'id_bidang' => $id_bidang,
					'kode_bidang' => $kode_bidang,
					'deskripsi' => $deskripsi,
					'id_top_bidang' => $id_top_bidang,
					'level' => $level
				);
	
			$result = $this->m_bidang->updateBidang(array('id_bidang' => $id_bidang), $data);
			if($id_top_bidang == '') //kondisi dimana berada pada bidang level 1
			{
				redirect('rencanaPembangunan/c_bidang','refresh');
			}
			else //kondisi dimana berada pada detil sub bidang
			{
				redirect('rencanaPembangunan/c_bidang/show_detail_bidang/'.$id_top_bidang,'refresh');
			}
		}
		else $this->edit($id_bidang);
    }
	
	function delete()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_bidang->deleteBidang($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_bidang', 'refresh');
    }
	
	function delete_sub()    
	{
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_bidang->deleteBidang($id);
            $sucess++;
        }
        redirect('rencanaPembangunan/c_bidang/show_detail_bidang/'.$id,'refresh');
    }
}
?>