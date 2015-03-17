<?php
	class Pokaz_liste extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
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



			$this->wyswietl_tresc($data);
		}

		private function wyswietl_tresc($data)
		{

			$this->load->helper('url');

			$data['header'] = anchor("", "LightCMS" );

			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header',  $data);

			$this->parser->parse('index_content', $data);
			#$this->load->view('content');

			$this->load->view('stopka');
			$this->load->view('body_end');
		}



	}
?>