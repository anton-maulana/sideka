<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_callback extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
		$this->load->model('sso/m_sso');
       
    }
	
	function index()
    {
		if (!function_exists('curl_init')){
			die('cURL belum terinstall!');
		}
		$data_sso = $this->m_sso->getSso(1);
		$app_id = $data_sso->app_id;
		$token_user = $_REQUEST['token'];
		$url ='https://auth.klikindonesia.or.id/api.php/authorizations/'.$app_id.'/'.$token_user;

		// Token user untuk web aplikasi yang terintegrasi dengan SSO Klik Indonesia
		//random dan expire berdasarkan waktu dan pada setiap digunakan, token user
		//seperti url callback contoh di atas adalah:
		//a535f42eae38b0a625f9db704ad1b265
		//https://auth.klikindonesia.or.id/api.php/authorizations
		//POST /api.php/authorizations/[appid]/[kode_token] HTTP/1.1
		
		
		//exp 16 // 
		//id : sideka
		//token : 416f1eb633f057873053d8a203eb6b92
		
		$token_app =  $data_sso->token_app;;
		$header = array();
		$header[] = 'Authorization: Bearer '.$token_app;
		$header[] = 'Content-Type: application/json'; // type data yang tersedia saat ini dalam format json

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, false); // methode yg digunakan GET
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$header); //to suppress the curl output
		$result_data = curl_exec($ch);
		
		if($result = curl_exec($ch)==true){
			//print_r($result_data);
		}else{
			throw new Exception();
		}
			curl_close ($ch);
			
			redirect('web/c_home', 'refresh');   
	}

}
?>