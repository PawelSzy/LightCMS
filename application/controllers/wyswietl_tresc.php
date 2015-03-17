<<?php  

if ( ! function_exists('wyswietl_tresc'))
{
		function wyswietl_tresc($data)
		{
			$this->load->helper('url');

			$data['header'] = anchor("", "LightCMS" );
			$data['log_block'] = $this->utworz_log_block ();

			$this->load->library('parser');

			
			$this->parser->parse('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('log_block', $data);
			$this->parser->parse('header',  $data);

			$this->parser->parse('index_content', $data);
			$this->load->view('stopka');
			$this->load->view('body_end');
		}
}

if ( ! function_exists('utworz_log_block'))
{	
		function utworz_log_block () 
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
		}
}