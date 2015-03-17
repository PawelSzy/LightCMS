<?php 
	class Nowa_strona extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
			$this->load->helper('url');
		}

		public function index()
		{
			if ( $this->session->userdata('login') === false )
			{
				//Uzytkownik niezalogowany
				redirect('/zaloguj/', 'refresh');
			}


			$data['title'] = "Nowa strona";
			$this->load->helper('url');
 			
 			$this->load->helper('form');
 			
 			$data['header'] = anchor("", "LightCMS" );


			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header', $data);

			$this->load->view('nowa_strona_form');

			$this->load->view('stopka');
			$this->load->view('body_end');

		}

		public function zapisz() 
		{
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


				$this->artykuly->zapisz($artykul);
				echo "informacja zapisana";
				redirect('', 'refresh');

			}
			echo "informacja zapisana";
		}
		
	}

?>
