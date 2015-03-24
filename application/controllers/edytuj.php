<?php 
	class Edytuj extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
			$this->lang->load('form_validation', 'polski');
			$this->load->helper('url');
			$this->load->library('parser');

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
				#var_dump($data['tytul_artykulu']);
				#var_dump($data['tekst']);
			} else {
				//utworz nowy artykul
				$data['tytul_artykulu'] ="";
				$data['tekst'] ="";
			}

			$data['title'] = "Nowa strona";

			$this->parse_page($data, $page_name);
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


				//validacja form
				if ( $page_name == "") {
					//nowy artykul
					$this->form_validation->set_rules('tytul', 'lang:tytul', 'required|callback_alpha_dash_space|xss_clean|is_unique[artykuly.tytul]');
				} else {
					//istniejacy artykul
					$this->form_validation->set_rules('tytul', 'lang:tytul', 'required|callback_alpha_dash_space|xss_clean|');
				}

				if ($this->form_validation->run() == FALSE)
				{
					//nieudana walidacja
					$this->parse_page($artykul, $page_name);
					#redirect('../index.php/edytuj/index/'.urldecode($page_name), 'refresh');
				}	
				else 
				{			
					//Udana walidacja danych
					if ( $page_name !== "" )
					{	//zmien dane w isniejacej stronie
						$dane['stary_tytul'] = $page_name;
						$dane['artykul'] = $artykul;
						$this->artykuly->zmien_dane($dane);
						echo "informacja zapisana";
						redirect('', 'refresh');
					}
					else 
					{	// utworz nowa strone
						$this->artykuly->zapisz($artykul);
						echo "informacja zapisana";
						redirect('', 'refresh');	
					}
				}
			}	
		}

		public function  alpha_dash_space($str)
		{
		    return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
		} 

		private function parse_page($data, $page_name)
		{
			$this->load->helper('url');
 			$this->load->helper('form');
 			$data['przycisk_zapisz_akcja_do_wykonania'] = base_url()."index.php/edytuj/zapisz/".$page_name;
 			
 			//utworz przycisk edytuj
 			$data['header'] = anchor("", "LightCMS" );

			$this->parser->parse('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header', $data);
			//**************************************************//
			$this->parser->parse('nowa_strona_form', $data);
			//**************************************************//
			$this->load->view('stopka');
			$this->load->view('body_end');
		}
	}

?>
