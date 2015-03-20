<?php  

trait wyswietl_tresc_trait {



		public function wyswietl_tresc($data)
		{
			$this->load->helper('url');

			$data['header'] = anchor("", "LightCMS" );
			$data['log_block'] = $this->utworz_log_block ($this);

			$data['boczny_pasek'] = $this->utworz_boczne_przyciski();

			$this->load->library('parser');

			
			$this->parser->parse('head', $data);
			$this->load->view('body_start');
			$this->parser->parse('log_block', $data);
			$this->parser->parse('header',  $data);

			$this->parser->parse('index_content', $data);
			$this->load->view('stopka');
			$this->load->view('body_end');
		}



		function utworz_log_block() 
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




	function utworz_boczne_przyciski() 
	{

		//uzyj regular expresion do 
		//wyciagniecia nazwy artukulu z url strony
		$url = current_url();
		$reg_expresion = "{index.php/index/index/}" ; 
		$preg_split = preg_split($reg_expresion , $url );
		if ( isset( $preg_split[1] )) {
			$nazwa_artykulu = $preg_split[1];
		} else {
			$nazwa_artykulu = "";
		}	

		// utworz url ktor prowadzi do controlera edytuj
		$edytuj_action = base_url()."index.php/edytuj/index/".$nazwa_artykulu;

		//var_dump( $nazwa_artykulu ); //$ereg
		//var_dump ( $edytuj_action );

		$przyciski_div1 = "
		<form method='post' action=".base_url()."index.php/edytuj/index/>
  			<input type='submit' class='przycisk' name='nowa_strona' value='Nowa strona'  >
        </form>" ;
        $przyciski_div2 = "
        <form method='post' action=".$edytuj_action.">"."<input type='submit' class='przycisk' name='edytuj' value='Edytuj'  >
        </form>"  ;  		
        return  $przyciski_div1.$przyciski_div2 ;   
	}
}