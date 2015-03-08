<?php 
	class Nowa_strona extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
		}

		public function index()
		{

			$data['title'] = "Nowa strona";
 			
 			$this->load->helper('form');
 			


			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->load->view('header');

			$this->load->view('form');

			$this->load->view('stopka');
			$this->load->view('body_end');

		}

		public function zapisz() 
		{
			$this->load->library('form_validation');

			$this->load->helper('url');

			$artykul = array 
			(
				'tytul' => $this->input->post('tytul'),
				'tekst'	=> $this->input->post('tresc')		
			);


			$this->artykuly->zapisz($artykul);

			echo "informacja zapisana";
		}
		
	}

?>
