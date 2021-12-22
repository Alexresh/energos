<?php
class Controller_Main extends Controller
{
	public function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}

	function action_index(){
		
		$data = $this->model->get_data();
		$this->view->generate('view_main.php', 'view_template.php', $data);
	}

	function action_filter($param = null){
		$data = !isset($param) ? $this->model->get_data() : $this->model->get_filtered_data($param);
		$this->view->generate('view_main.php', 'view_template.php', $data);
	}
}
?>