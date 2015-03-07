<?php 
	class Index extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$this->load->view('head');
			$this->load->view('body_start');
			$this->load->view('header');
			$this->load->view('index_content');
			$this->load->view('stopka');
			$this->load->view('body_end');

		}
		
	}

?>