<?php 
	class Index extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['title'] = "LightCMS Pawel test";


 			$data['index_content'] = "";
 			$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed suscipit congue turpis a porttitor. Suspendisse potenti. Curabitur et nisl vel augue laoreet condimentum. Vestibulum eu congue augue. Donec justo nisi, condimentum posuere interdum eu, pulvinar eget tellus. Quisque in ante massa. Praesent a diam eget libero finibus congue. Suspendisse porta risus a gravida maximus. In turpis nisi, semper eget luctus ac, mattis ut augue. Vestibulum et volutpat tellus.

  Proin tristique commodo eleifend. Morbi euismod tempus augue, a imperdiet nisi. Suspendisse mattis vitae libero a pulvinar. Sed lacus risus, porta maximus congue non, volutpat vel libero. Nunc erat felis, egestas sit amet porttitor id, hendrerit non nisi. Vivamus eu suscipit quam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque vitae nulla in libero venenatis imperdiet. Cras non nunc vitae purus viverra molestie.

  Aliquam et tristique nunc. Nam nec fermentum lorem, ac pellentesque dolor. Pellentesque eu felis convallis, mollis tellus eu, vehicula tortor. Sed sed egestas nisi. Donec vitae sodales dui, eu gravida est. Etiam et purus justo. Etiam molestie, velit sed commodo pretium, massa ante sodales ipsum, molestie faucibus neque velit a metus. Etiam ac nulla urna. Aliquam ullamcorper turpis eget sapien tincidunt viverra. Proin maximus elit non nisl volutpat aliquam. Integer vel tempor erat, et fringilla arcu. Sed ac fermentum leo.

  Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut at est id ante rutrum pharetra a non arcu. Integer venenatis nibh lorem, eget efficitur libero posuere vitae. Phasellus convallis odio ac lectus aliquet, et dignissim est sodales. Etiam euismod tortor vel quam tristique, eu sodales mi feugiat. Nullam eget ex odio. Vestibulum maximus ex mi, vitae efficitur nibh ultrices ac. Etiam commodo orci sed maximus efficitur. Nam vel ornare sem, non dignissim lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat dui quis turpis suscipit, sollicitudin sodales ipsum auctor. Nunc dui enim, hendrerit vel efficitur at, semper in metus. Duis at ipsum neque. Aliquam non urna sed velit ornare ultrices.

  Integer consectetur sed ipsum et sagittis. Vestibulum tincidunt erat sed lobortis ultricies. Donec facilisis aliquam ultricies. Donec ligula elit, malesuada nec fringilla sed, aliquet vitae ante. Donec imperdiet, turpis ac fringilla eleifend, leo nulla tempus nisi, non imperdiet eros arcu eget justo. Vivamus id tellus nulla. Integer molestie ligula neque, non accumsan nunc elementum ac. Suspendisse sodales efficitur sapien in sagittis. Nunc volutpat porttitor sapien vitae cursus. Integer id fringilla eros, ut maximus sem." ;      
                
            /*
            try {
              $pdo = new PDO('mysql:host=localhost;dbname=artykuly', 'Pawel', 'test');
            }
            catch(PDOexception $e){
              $output = "nie można nawiazać polaczenia z serwerem bazy danych";
              include 'output.html.php';
              exit();
            }  	
			*/

			$this->load->model('artykuly');
			$data['artykuly'] = $this->artykuly->pobierz_artykuly(5);

			$text = $data['artykuly'][0]['tekst'];

            $text_rows = explode("\n", $text);
            foreach ($text_rows as $row)
    	        $data['index_content'] =$data['index_content']. "<p>".$row."</p>"; 
 	


			$this->load->library('parser');

			$this->parser->parse('head', $data);
			#$this->load->view('head', $data);
			$this->load->view('body_start');
			$this->load->view('header');

			$this->parser->parse('index_content', $data);
			#$this->load->view('index_content');

			$this->load->view('stopka');
			$this->load->view('body_end');

		}
		
	}

?>