<?php 
	class Nowa_strona extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			
			
		}

		public function index()
		{
			redirect('/edytuj/index/', 'refresh');
		}
	}
?>
