<?php 

/**
* 
*/
class Artykuly extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function pobierz_artykuly($ilosc_pierwszych )
	{
		$query = $this->db->get('artykuly');
		return $query->result_array();
	}


	public function zapisz($dane)
	{
		$this->db->insert('artykuly', $dane);
		return $this->db->insert_id();
	}
}	

?>

