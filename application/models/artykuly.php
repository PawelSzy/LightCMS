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

	public function pobierz_artykuly( $ilosc_pierwszych=0 )
	{
		$this->db->order_by("data", "desc"); 
		if ( $ilosc_pierwszych === 0 ) {
			$query = $this->db->get('artykuly');
		} else {
			$query = $this->db->get('artykuly', $ilosc_pierwszych);
		}
		return $query->result_array();
	}

	public function pobierz_artykul( $nazwa_artykulu ) 
	{

		$this->db->where('tytul',urldecode($nazwa_artykulu));
		$query = $this->db->get('artykuly');
		return $query->result_array();
	} 

	public function pobierz_tytuly()
	{
		$this->db->order_by("data", "desc"); 
		$this->db->select('tytul, autor');
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

