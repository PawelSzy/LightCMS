<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('zapisz_strone'))
{
		function zapisz_strone() 
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
