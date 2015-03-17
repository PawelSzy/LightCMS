<?php 

/**
* 
*/
class Autor extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function pobierz_autora( $login ) 
	{

		$this->db->where('login', $login);
		$query = $this->db->get('autor');
		return $query->result_array();
	} 

	public function zapisz($dane)
	{
		$this->db->insert('autor', $dane);
		return $this->db->insert_id();
	}
}	

?>

