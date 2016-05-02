<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_portal extends CI_Controller {

    function  __construct()
    {
		parent::__construct();  
		$this->load->model('statistik/m_piramida');			
		$this->load->model('statistik/m_pekerjaan');	
    }
	   
	function index()
    {			
		$place = "Balansiku-Nunukan-Kalimantan Utara";
		$result = "[".$this->type1($place).",".$this->type3($place).",".$this->type2()."]";
		echo base64_encode($result);
		//echo $result;
		
	}
	function type1($place)
	{
		$title = form_prep("<a href='".base_url()."' target='_blank'>SIDeKa ".$place."</a>");
		
		$array = array(
			'type' =>  "1",
			"title" => $title,
			"preview" => "Piramida Penduduk",
			"time" => $this->indonesian_date(time (), 'j F Y')
		);
		return json_encode($array);
	}
	function type2()
	{
		//return data piramida penduduk
		
		
		$json_laki 			= $this->getDataDataUmur('1');	
		$json_perempuan 	= $this->getDataDataUmur('2');
		
		
		//$json = json_encode($json_laki+$json_perempuan+$dataPekerjaan);
		$diagram = json_encode($json_laki+$json_perempuan);
		
		$diagram = str_replace('":','<=>',$diagram);
		$diagram = str_replace(',"','","',$diagram);
		$diagram = str_replace('{','[',$diagram);
		$diagram = str_replace('}','"]',$diagram);
		$array = array(
			'type' =>  "2",
			'diagram' => form_prep($diagram)
		);
		
		$json = json_encode($array);
		
		$json = str_replace('"[','[',$json);
		$json = str_replace(']"',']',$json);
		
		return $json;
	}
	function type3($place)
	{
		$jumlah = 0;
		$pekerjaan = $this->m_pekerjaan->getDataPekerjaan();
		foreach($pekerjaan as $row)
		{
			if(strcasecmp($row->jenis, "BURUH MIGRAN") == 0)
			{
				$jumlah = $row->jumlah;
			}
		}
		$array = array(
			'type' =>  "3",
			"title" => "Jumlah Buruh Migran",
			"variable" => "$jumlah",
			"time" => $this->indonesian_date(time (), 'j F Y'),
			"place" => $place
		);
		return json_encode($array);
	}
	function getDataDataUmur($idjenkel)
    {		
		$countA = 0;
		$countB = 4;
		
		while($countA <= 70)
		{
			if($idjenkel==1)
			{
				$data['Laki-laki umur '.$countA.'-'.$countB] = $this->m_piramida->getJumlahPenduduk($idjenkel,$countA,$countB);
			}
			else if($idjenkel==2)
			{
				$data['Perempuan umur '.$countA.'-'.$countB] = $this->m_piramida->getJumlahPenduduk($idjenkel,$countA,$countB);
			}
			$countA = $countA + 5;
			$countB = $countB + 5;
		}
		if($countA > 70)
		{
			if($idjenkel==1)
			{
				$data['Laki-laki umur '.$countA.'+'] = $this->m_piramida->getJumlahPenduduk($idjenkel,$countA,'300');
			}
			else if($idjenkel==2)
			{
				$data['Perempuan umur '.$countA.'+'] = $this->m_piramida->getJumlahPenduduk($idjenkel,$countA,'300');
			}
		}		
		return $data;
    }
	function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i') {
		if (trim ($timestamp) == '')
		{
				$timestamp = time ();
		}
		elseif (!ctype_digit ($timestamp))
		{
			$timestamp = strtotime ($timestamp);
		}
		# remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace ("/S/", "", $date_format);
		$pattern = array (
			'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
			'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
			'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
			'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
			'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
			'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
			'/April/','/June/','/July/','/August/','/September/','/October/',
			'/November/','/December/',
		);
		$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
			'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
			'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
			'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
			'Oktober','November','Desember',
		);
		$date = date ($date_format, $timestamp);
		$date = preg_replace ($pattern, $replace, $date);
		$date = "{$date}";
		return $date;
	} 
}
?>