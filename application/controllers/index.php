<?php 
	class Index extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper('wyswietl_tresc');
			$this->load->model('artykuly');
			$this->load->helper('typography');
			$this->load->helper('url');
		}

		public function index($page_name ="")
		{
			//wybor czy pojedyncza strona
			//czy glowna strona z najnowszymi artykulami
			if ( $page_name =="" )
			{
				$this->main_page();
				 
			}
			else {

				$this->wyswietl_strone($page_name);
			}


		}

		private function wyswietl_strone($page_name ="") 
		{
 			$data['content'] = "";


			$data[$page_name] = $this->artykuly->pobierz_artykul($page_name);

			if ( empty($data[$page_name]) )
			{
				show_404();
				return;
			} 

			$data['title'] = $data[$page_name][0]['tytul'];
			#$data['boczny_pasek'] = ' <input type="submit" class="przycisk" name="nowa_strona" value="Nowa strona"  >' ;

			foreach ($data[$page_name] as $artykul) 
			{
				$text = auto_typography($artykul['tekst']);
				
				$autor =$artykul['autor'];
				$tytul = $artykul['tytul'];
				$this->load->helper('url');

				$data['content'] = $data['content']."<h1>".$tytul."</h1>";
				$data['content'] = $data['content'].$text;
    	        $data['content'] = $data['content']."<br>"."Autor:"."<br>".$autor."<br>";
    	        $data['content'] = $data['content']."<hr>";
			}

			wyswietl_tresc( $data, $this ); //zaladowany helper wyswietl tresc
		}

		private function main_page() 
		{

			define("ILOSC_ARTYKULOW_NA_GLOWNEJ", 5);

			$data['title'] = "LightCMS Pawel test";
 			$data['content'] = "";
			

			$artykuly = $this->artykuly->pobierz_artykuly(ILOSC_ARTYKULOW_NA_GLOWNEJ);
			#$data['boczny_pasek'] = '<input type="submit" class="przycisk" name="nowa_strona" value="Nowa strona"  >';

			foreach ($artykuly as $artykul) 
			{
				$text = auto_typography($artykul['tekst']);
				
				$autor =$artykul['autor'];
				$tytul = $artykul['tytul'];

				$data['content'] = $data['content']."<h1>".$tytul."</h1>";
				$data['content'] = $data['content'].$text;
    	        $data['content'] = $data['content']."<br>"."Autor:"."<br>".$autor."<br>";
    	        $data['content'] = $data['content']."<br>"."Link: ".anchor("/index/index/".$tytul, $tytul );
    	        $data['content'] = $data['content']."<hr>";
			}

			$data['content'] = $data['content']."<br>".anchor("/pokaz_liste", "Pokaz wszystkie artykuly");

			
			wyswietl_tresc( $data, $this ); //zaladowany helper wyswietl tresc

		}



		// private function wyswietl_tresc($data)
		// {
		// 	$this->load->helper('url');

		// 	$data['header'] = anchor("", "LightCMS" );
		// 	$data['log_block'] = $this->utworz_log_block ();

		// 	$this->load->library('parser');

			
		// 	$this->parser->parse('head', $data);
		// 	$this->load->view('body_start');
		// 	$this->parser->parse('log_block', $data);
		// 	$this->parser->parse('header',  $data);

		// 	$this->parser->parse('index_content', $data);
		// 	$this->load->view('stopka');
		// 	$this->load->view('body_end');
		// }

/*
		private function utworz_log_block () 
		{
			$session_data = $this->session->all_userdata();
			$nowy_uzytkownik = anchor( "/nowy_autor/", "zarejestruj sie" );
			$zaloguj = anchor( "/zaloguj/", "zaloguj" );
			$login_info = $nowy_uzytkownik." ".$zaloguj ; 
			

			if ( $this->session->userdata('login') === false )
			{
				//Uzytkownik niezalogowany
				$log_block = "";
				$log_block = $log_block.$login_info;
			}	
			else 
			{
				// Uzytkownik zalogowany
				$wyloguj = anchor( "/wyloguj/", "wyloguj" );
				$log_block = "";
				$log_block = $log_block."Witaj: ";
				$log_block = $log_block.( $this->session->userdata('login') );
				$log_block = $log_block.$wyloguj;

			}

			return $log_block;
		}*/





	}

?>