<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kemiskinan extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('subquery');
    }
    
	
	// --- Kelas Sosial '0' --- //
	
	function getKelasSosial0(){		
		$this->db->select('*');
		$this->db->where('tbl_hasil_sensus.id_kelas_sosial', '0');
		$q = $this->db->get('tbl_hasil_sensus');
		return $q->num_rows();		
    }
	
	function getKelasSosial1(){		
		$this->db->select('*');
		$this->db->where('tbl_hasil_sensus.id_kelas_sosial', '1');
		$q = $this->db->get('tbl_hasil_sensus');
		return $q->num_rows();		
    }
	
	function getKelasSosial2(){		
		$this->db->select('*');
		$this->db->where('tbl_hasil_sensus.id_kelas_sosial', '2');
		$q = $this->db->get('tbl_hasil_sensus');
		return $q->num_rows();		
    }
	
	function getKelasSosial3(){		
		$this->db->select('*');
		$this->db->where('tbl_hasil_sensus.id_kelas_sosial', '3');
		$q = $this->db->get('tbl_hasil_sensus');
		return $q->num_rows();		
    }
	
	function getKelasSosial4(){		
		$this->db->select('*');
		$this->db->where('tbl_hasil_sensus.id_kelas_sosial', '4');
		$q = $this->db->get('tbl_hasil_sensus');
		return $q->num_rows();		
    }
	
	function getDataTotal(){
		$this->db->select('*');
		$this->db->from('tbl_hasil_sensus');
		$query = $this->db->get();
        return $query->num_rows();
	}
}