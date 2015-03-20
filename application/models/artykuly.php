<?php 

/**
* 
*/
class Artykuly extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
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
		
		$return_array = $this->dodaj_autora_do_tabeli( $query->result_array() );
		return $return_array;	
	}

	public function pobierz_artykul( $nazwa_artykulu ) 
	{

		$this->db->where('tytul',urldecode($nazwa_artykulu));
		$query = $this->db->get('artykuly');
		$return_array = $this->dodaj_autora_do_tabeli( $query->result_array() );
		return $return_array;	
	} 

	public function pobierz_tytuly()
	{
		$this->db->order_by("data", "desc"); 
		$this->db->select('tytul, autor_id');
		$query = $this->db->get('artykuly');

		$return_array = $this->dodaj_autora_do_tabeli( $query->result_array() );
		return $return_array;		
	}	


	public function zapisz( $dane )
	{
		$this->db->insert('artykuly', $dane);
		return $this->db->insert_id();
	}

	public function zmien_dane($dane)
	{
		$where_array = array('autor_id' => $dane['autor_id'], 'tytul' => $dane['tytul']);
		$this->db->where($where_array);
		$this->db->update('artykuly', $dane);
	}

	public function usun_artykul( $id ) 
	{
		$this->db->delete( 'artykuly', array( 'id' => $id )); 
	}


	public function zamien_id_na_autora( $id )
	{
		$this->db->select('login');
		$this->db->where( 'autor_id', $id );
		$query = $this->db->get('autor');
		return $query->result_array()[0]['login']  ;
	}

	private function dodaj_autora_do_tabeli( $tabela )
	{
		//dodaje do tabeli autora tresci na podstawie id_autora
		$new_table =  array();
		foreach ($tabela as $row) 
		{
			
			$row['autor'] = $this->zamien_id_na_autora( $row['autor_id']); 
			array_push($new_table, $row);
		}
		
		return $new_table;
	}


}	

?>

