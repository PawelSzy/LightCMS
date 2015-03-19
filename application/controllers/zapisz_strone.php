<?php

class Zapisz_strone  extends CI_Controller
{

		public function __construct()
		{
			parent::__construct();
		}

		public function zapisz_strone() 
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