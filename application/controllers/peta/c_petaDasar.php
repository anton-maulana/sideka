<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_petaDasar extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        $this->load->helper('form');  
        $this->load->model('m_peta');		
    }   
	
	function index()
    {		
		
		$data['peta'] = $this->m_peta->getPeta();
		$data['base_url']=$this->config->item('base_url');
		$data['page_title'] = 'PETA DASAR';	
		
		$data['menu'] = $this->load->view('menu/v_pengelolaPeta', $data, TRUE);
		
		
		$data['content'] = $this->load->view('peta/dasar/v_tambahPetaDasar', $data, TRUE);
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');       
    }
	
	function simpan_peta() {	
	
		$zoom = $this->input->post('myzoom', TRUE);	
		$center = html_entity_decode($this->input->post('centerofmap', TRUE));	
		$type = strtoupper($this->input->post('mapType', TRUE));
		$tampil = $this->input->post('tampil', TRUE);
		if($tampil == true){$tampil = "true";}		
		else {$tampil = "false";}
		$changeOverlay = $this->input->post('changeOverlay', TRUE);			
		////////////////////		
		$path_overlayImage = $this->input->post('path_overlayImage', TRUE);
		$point1 = $this->input->post('point1', TRUE);
		$point2 = $this->input->post('point2', TRUE);
		
		if($changeOverlay == 'YA')
		{
			//UPLOAD IMAGE OVERLAY
			$config['upload_path']   =   "./uploads/map/";
			$config['allowed_types'] =   "gif|jpg|jpeg|png";
			$config['file_name'] = 'overlayImage';	
			$config['overwrite'] = TRUE;
			$this->load->library('upload',$config);
			$this->upload->initialize($config); 
			if(!$this->upload->do_upload('overlayImage'))
			{         
				$path_overlayImage = $path_overlayImage = "uploads/map/overlayImage.png";    
			}
			else
			{
				$upload_overlayImage = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upload_overlayImage['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 300;
				$config['height']   = 300;
				$this->load->library('image_lib', $config); 
				$path_overlayImage = "uploads/map/".$upload_overlayImage['file_name'];
				
				$point1 = $center;
				$point2 = $center;
			}
		}
		$embed = array(
			'zoom' =>  $zoom,
			'center' =>  $center,
			'type' =>  $type,
			'tampil' =>  $tampil,
			'path_overlayImage' =>  $path_overlayImage,
			'point1' =>  $point1,
			'point2' =>  $point2
		);	
		$embed = str_replace("(","",$embed);
		$embed = str_replace(")","",$embed);
		$json = json_encode($embed);
		$data = array(
			'embed' =>  $json,
		);			
		$this->m_peta->updatePeta(array('id_peta' => 1), $data);
			
		
		redirect('peta/c_petaDasar','refresh');
			
    }
	
	

}
?>