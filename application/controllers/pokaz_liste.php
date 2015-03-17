<?php
	class Pokaz_liste extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
			$this->load->helper('wyswietl_tresc');
		}

		public function index()
		{
			$this->load->helper('url');

			$data['title'] = "Lista artykulow LightCMS";
 			$data['header'] = anchor("", "Lista artykulow LightCMS" );
 			$data['content'] = "";

			$data['tytuly'] = $this->artykuly->pobierz_tytuly();		

			foreach ($data['tytuly'] as $artykul) 
				{
		
					$autor =$artykul['autor'];
					$tytul = $artykul['tytul'];
					$this->load->helper('url');

	    	        $data['content'] = $data['content'].anchor("/index/index/".$tytul, $tytul );
	    	        $data['content'] = $data['content']." "."Autor: ".$autor;
	    	        $data['content'] = $data['content']."<br>";
				}



			wyswietl_tresc( $data, $this ); //zaladowany helper wyswietl tresc
		}

	}
?>