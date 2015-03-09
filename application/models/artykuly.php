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
		$this->db->order_by("data", "desc"); 
		$query = $this->db->get('artykuly', $ilosc_pierwszych);
		return $query->result_array();
	}


	public function zapisz($dane)
	{
		$this->db->insert('artykuly', $dane);
		return $this->db->insert_id();
	}
}	

?>

