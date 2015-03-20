<?php 
	class Edytuj extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
			$this->load->helper('url');

		}

		public function index($page_name ="")
		{
			//Zasada nazwa przekazywana do funckji to nazwa artukulu
			//Jesli nie przekazujemy danych do funckji opcja tworzenia nowej strony
			if ( $this->session->userdata('login') === false )
			{
				//Uzytkownik niezalogowany
				redirect('/zaloguj/', 'refresh');
			}



			//przekazana wartosc (nazwa artykulu) do funkcji - edytuj wybrany dokumeny
			if( $page_name !== "" ){
				$artykuly = $this->artykuly->pobierz_artykul( $page_name);
				$data['tytul_artykulu'] = $artykuly[0]['tytul'];
				$data['tekst'] = $artykuly[0]['tekst'];
			} else {
				//utworz nowy artykul
				$data['tytul_artykulu'] ="";
				$data['tekst'] ="";
			}

			$data['title'] = "Nowa strona";
			$this->load->helper('url');
 			$this->load->helper('form');
 			$data['przycisk_zapisz_akcja_do_wykonania'] = base_url()."index.php/edytuj/zapisz/".$page_name;
 			
 			//utworz przycisk edytuj
 			$data['header'] = anchor("", "LightCMS" );

			$this->load->library('parser');

			$this->parser->parse('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header', $data);
			//**************************************************//
			$this->parser->parse('nowa_strona_form', $data);
			//**************************************************//
			$this->load->view('stopka');
			$this->load->view('body_end');

		}

		public function zapisz($page_name="") 
		{
			//Zasada nazwa przekazywana do funckji to nazwa artukulu
			$this->load->library('form_validation');
			$this->load->database();

			$this->load->helper('url');


			if ( $this->session->userdata('login') === false )
			{
				//Uzytkownik niezalogowany
				redirect('/zaloguj/', 'refresh');
			}	
			else 
			{
				// Uzytkownik zalogowany
				$artykul = array 
				(
					'autor_id' => $this->session->userdata('autor_id'), 
					'tytul' => $this->input->post('tytul'),
					'tekst'	=> $this->input->post('tresc')		
				);

				if ( $page_name !== "" )
				{	
					$this->artykuly->zmien_dane($artykul);
				}
				else 
				{
					$this->artykuly->zapisz($artykul);
				}
				
				echo "informacja zapisana";
				redirect('', 'refresh');

			}
			echo "informacja zapisana";
		}

		
	}

?>
