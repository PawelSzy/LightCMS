<?php 



	class Zaloguj extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('autor');
			#require 'password.php';
		}

		public function index()
		{

			$data['title'] = "Zaloguj";
			$this->load->helper('url');
 			
 			$this->load->helper('form');
 			
 			$data['header'] = anchor("", "LightCMS" );


			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header', $data);

			$this->load->view('zaloguj');

			$this->load->view('stopka');
			$this->load->view('body_end');

		}

		public function logowanie() 
		{
			$this->load->library('form_validation');
			$this->load->helper('url');

			$haslo = $this->input->post('haslo');
			$login = $this->input->post('login');

			$dane_autora = $this->autor->pobierz_autora( $login );
			$passwordHash = $dane_autora[0]['hash'];

			if ( password_verify($haslo, $passwordHash))
			{
				echo "zostales zalogowany";
				$dane_sesji = array(
                   'login'  => $dane_autora[0]['login'],
                   'zalogowany' => TRUE,
                   'uprawnienia' => $dane_autora[0]['uprawnienia'],
                   'autor_id' => (int)$dane_autora[0]['autor_id']
               );
				$this->session->set_userdata($dane_sesji);	
				#var_dump( $dane_sesji['autor_id'] );
				redirect('', 'refresh');
			}
			else 
			{
				echo "nieudane logowanie";
				redirect('/zaloguj/', 'refresh');
			}
		}
		
	}

?>
