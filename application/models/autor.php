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

	public function czy_autor_istnieje( $login )
	{
		$this->db->where('login', $login);
		$this->db->select('login');
		$query = $this->db->get('autor');
		$autor = $query->result_array();
		return ( empty( $autor ) ? False : True );
	}
}	

?>

