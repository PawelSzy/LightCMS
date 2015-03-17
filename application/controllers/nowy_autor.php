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
			$this->load->library('form_validation');

			$this->load->helper('url');

			$haslo = $this->input->post('haslo');


			$passwordHash = password_hash($haslo, PASSWORD_DEFAULT);

			$nowy_autor = array 
			(
				'login' => $this->input->post('login'),
				'hash'	=> $passwordHash,
				'uprawnienia' => "w"
			);

			$this->autor->zapisz($nowy_autor);

			echo "informacja zapisana";
		}
		
	}

?>
