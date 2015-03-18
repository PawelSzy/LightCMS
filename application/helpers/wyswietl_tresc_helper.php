<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('wyswietl_tresc'))
{
		function wyswietl_tresc($data, $page)
		{
			$page->load->helper('url');

			$data['header'] = anchor("", "LightCMS" );
			$data['log_block'] = utworz_log_block ($page);

			$data['boczny_pasek'] = utworz_boczne_przyciski();

			$page->load->library('parser');

			
			$page->parser->parse('head', $data);
			$page->load->view('body_start');
			$page->parser->parse('log_block', $data);
			$page->parser->parse('header',  $data);

			$page->parser->parse('index_content', $data);
			$page->load->view('stopka');
			$page->load->view('body_end');
		}
}

if ( ! function_exists('utworz_log_block'))
{	
		function utworz_log_block ($page) 
		{
			$session_data = $page->session->all_userdata();
			$nowy_uzytkownik = anchor( "/nowy_autor/", "zarejestruj sie" );
			$zaloguj = anchor( "/zaloguj/", "zaloguj" );
			$login_info = $nowy_uzytkownik." ".$zaloguj ; 
			

			if ( $page->session->userdata('login') === false )
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
				$log_block = $log_block.( $page->session->userdata('login') );
				$log_block = $log_block.$wyloguj;

			}

			return $log_block;
		}
}


if ( ! function_exists('utworz_boczne_przyciski'))
{	
	function utworz_boczne_przyciski() 
	{
		

		$przyciski_div1 = "
		<form method='post' action=".base_url()."index.php/nowa_strona/>
  			<input type='submit' class='przycisk' name='nowa_strona' value='Nowa strona'  >
        </form>" ;
        $przyciski_div2 = "
        <form method='post' action=".base_url()."index.php/edytuj/>
  			<input type='submit' class='przycisk' name='edytuj' value='Edytuj'  >
        </form>"  ;  		
        return  $przyciski_div1.$przyciski_div2 ;   
	}
}	