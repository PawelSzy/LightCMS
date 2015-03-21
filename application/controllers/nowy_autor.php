<?php 



	class Nowy_autor extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('autor');
			#require 'password.php';
		}

		public function index()
		{

			$data['title'] = "Nowa autor";
			$this->load->helper('url');
 			
 			$this->load->helper('form');
 			
 			$data['header'] = anchor("", "LightCMS" );


			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('header', $data);

			$this->load->view('nowy_autor_form');

			$this->load->view('stopka');
			$this->load->view('body_end');

		}

		public function zapisz() 
		{
			// utworz nowego autora w bazie danych
			$this->load->library('form_validation');
			$this->load->helper('url');
			$haslo = $this->input->post('haslo');

			//validacja form
			$this->form_validation->set_rules('login', 'Login', 'required|callback__alpha_dash_space|is_unique[autor.login]');
			$this->form_validation->set_rules('haslo', 'haslo', 'required|callback__alpha_dash_space');
			if ($this->form_validation->run() == FALSE)
			{
				redirect('../index.php/nowy_autor', 'refresh');
			}

			$passwordHash = password_hash($haslo, PASSWORD_DEFAULT);
			$login = $this->input->post('login');

			$nowy_autor = array 
			(
				'login' => $login,
				'hash'	=> $passwordHash,
				'uprawnienia' => "w"
			);

			// sprawdz czy istnieje autor
			if ( $this->autor->czy_autor_istnieje($login) == False)
			{
				$this->autor->zapisz($nowy_autor);
				echo "utworzono nowego autora\n";
			}

			//zaloguj sie
			$dane_autora = $this->autor->pobierz_autora( $login );
			if ( password_verify($haslo, $passwordHash))
			{
				echo "zostales zalogowany\n";
				$dane_sesji = array(
                   'login'  => $dane_autora[0]['login'],
                   'zalogowany' => TRUE,
                   'uprawnienia' => $dane_autora[0]['uprawnienia'],
                   'autor_id' => (int)$dane_autora[0]['autor_id']
               );
				$this->session->set_userdata($dane_sesji);
			}
			redirect('', 'refresh');
			echo "utworzono nowego autora\n";
		}

		private function  alpha_dash_space($str)
		{
		    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
		} 		
		
	}

?>
