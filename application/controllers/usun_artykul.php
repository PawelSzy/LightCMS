<?php
	class Usun_artykul extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('artykuly');
			$this->load->helper('url');
		}

		public function index( $id )
		{
			$this->artykuly->usun_artykul( $id );
			echo "Usunieto artykul";
			redirect('', 'refresh');
			echo "Usunieto artykul";
		}
	}
