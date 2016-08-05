<?php
class M_ped extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_ped';
	$this->load->library('Excel_generator');
    //get instance
    $this->CI = get_instance();
  }
	public function getPedFlexigrid()
    {
        //Build contents query
        $this->db->select('
		tbl_ped.*,
		ref_ped_sub.deskripsi as jenis,
		ref_ped_sub.satuan as satuan,
		ref_ped_kategori.deskripsi as lahan,
		tbl_penduduk.nik as nik
		')->from($this->_table);

		$this->db->join('ref_ped_sub','ref_ped_sub.id_ped_sub = tbl_ped.id_ped_sub');
		$this->db->join('ref_ped_kategori','ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_ped.id_penduduk');


        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_ped) as record_count")->from($this->_table);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }

	public function getPedFlexigridById($id_ped_sub)
    {
        //Build contents query
        $this->db->select('
		tbl_ped.*,
		ref_ped_sub.deskripsi as jenis,
		ref_ped_sub.satuan as satuan,
		ref_ped_kategori.deskripsi as lahan
		')->from($this->_table);

		$this->db->join('ref_ped_sub','ref_ped_sub.id_ped_sub = tbl_ped.id_ped_sub');
		$this->db->join('ref_ped_kategori','ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori');
		$this->db->where('tbl_ped.id_ped_sub',$id_ped_sub);

        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_ped) as record_count")->from($this->_table);
		$this->db->where('id_ped_sub',$id_ped_sub);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        $this->CI->flexigrid->build_query(TRUE);
        //Return all
        return $return;
    }



	function insertPed($data)
	{
		$this->db->insert($this->_table, $data);
	}

	function deletePed($id)
	{
		$this->db->where('id_ped', $id);
		$this->db->delete($this->_table);
	}

	function updatePed($where, $data)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}

	function getPedByIdPed($id) //edit
	{
		 $this->db->select('
		tbl_ped.*,
		tbl_penduduk.nik as nik
		')->from($this->_table);
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_ped.id_penduduk');
		$this->db->where('id_ped', $id);
		$query = $this->db->get();
		return $query->row();
		//return $this->db->get_where($this->_table,array('id_ped' => $id))->row();
	}

	function get_ped_sub()
	{
		$this->db->select('ref_ped_sub.*,ref_ped_kategori.deskripsi as lahan')->from($this->_table);
		$this->db->join('ref_ped_kategori','ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori');
		$this->db->order_by('ref_ped_kategori.id_ped_kategori');
		$records = $this->db->get('ref_ped_sub');
		$data=array();
		foreach ($records->result() as $row)
		{
			$data[''] = '--Pilih--';
			$data[$row->id_ped_sub] = $row->lahan .' - '. $row->deskripsi;
		}
		return ($data);
	}

	function cekLokasiNull($id)
	{
		$this->db->select('lokasi');
			$this->db->where('id_ped', $id);
		$this->db->limit(1);
		$q = $this->db->get($this->_table);
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['lokasi'];
		if(!empty( $data['lokasi']))
		{
			return false;
		}
		else if(empty( $data['lokasi']))
		{
			return  true;
		}
	}

	function getKepalaKeluargaLikeNama($nama)
	{
		$this->db->select('tbl_penduduk.nama, tbl_penduduk.nik');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga','left');
		$this->db->join('ref_status_penduduk','ref_status_penduduk.id_status_penduduk = tbl_penduduk.id_status_penduduk');
		$this->db->like('tbl_penduduk.nama', $nama);
		$this->db->where('ref_status_penduduk.deskripsi <>', 'Meninggal');
		$this->db->where('ref_status_penduduk.deskripsi <>', 'Pindahan Keluar');
		$query = $this->db->get('tbl_keluarga');
		return $query->result();
	}
	function getIdPendudukByNIK($nik)
	{
		$this->db->select('id_penduduk');
		$this->db->where('nik', $nik);
		$this->db->limit(1);
		$q = $this->db->get('tbl_penduduk');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_penduduk'];
		if(!empty( $data['id_penduduk']))
		{
			return $result;
		}
		else if(empty( $data['id_penduduk']))
		{
			return  null;
		}
	}

	function getExportExcel()
	{
		 $this->db->select('
		tbl_ped.*,
		ref_ped_sub.deskripsi as jenis,
		ref_ped_sub.satuan as satuan,
		ref_ped_kategori.deskripsi as lahan,
		tbl_penduduk.nik as nik
		')->from($this->_table);
		$this->db->join('ref_ped_sub','ref_ped_sub.id_ped_sub = tbl_ped.id_ped_sub');
		$this->db->join('ref_ped_kategori','ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_ped.id_penduduk');


		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}

}

?>
