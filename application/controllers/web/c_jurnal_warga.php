<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_jurnal_warga extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();		
        $this->load->helper('form');
		$this->load->model('m_jurnal_warga');
		$this->load->model('m_pages');
		$this->load->model('m_logo');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);	
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/jurnal_warga',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
	}
	
	function simpan_jurnal() {
		$penulis = $this->input->post('penulis', TRUE);
		$judul = $this->input->post('judul', TRUE);
		$gambar = $this->input->post('gambar', TRUE);
		$berita = $this->input->post('isi', TRUE);
		$user = $this->input->post('id_pengguna', TRUE);
		 
		$this->form_validation->set_rules('penulis', 'Penulis Berita', 'required');
		$this->form_validation->set_rules('judul', 'Judul Berita', 'required');

		
		//UPLOAD GAMBAR BERITA
		$newfile = $this->input->post('image-data', TRUE);
		
		define('UPLOAD_DIR', 'uploads/berita/');
		$img = $newfile;
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);		
		
		
		$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		/* $namaFile = str_replace(' ', '+', $judul);
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		$path_gambar_berita = $file; */
		$path_gambar_berita = $file;
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'id_pengguna' => 0,
				'gambar' => $path_gambar_berita,
				'penulis' => $penulis,
				'judul_berita' => $judul,
				'isi_berita' => $berita,
				'is_publish' => 'Tidak',
				'is_masyarakat' => 'Ya'
			);
	
			$this->m_jurnal_warga->insertJurnalWarga($data);
			$url='web/c_home/get_detail_berita/';
			$dataPages = array(
				'url' => $url.mysql_insert_id(),
				'title' => $judul,
				'content' => $berita	
			);
			$this->m_pages->insertPages($dataPages);
			$this->session->set_flashdata('message', 'Berita berhasil ditambahkan dan akan ditampilkan setelah mendapat persetujuan !');
			redirect('web/c_jurnal_warga','refresh');
        }
		else $this->index();
    }
}
?>