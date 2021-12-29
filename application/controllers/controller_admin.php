<?php
class Controller_admin extends Controller
{
	public function __construct()
	{
		$this->view = new View();
		$this->model = new Model_Admin();
	}

	function action_index(){
		if($_SESSION['User']->id != 1){
			header("Location: http://energos/");
		}
		$this->view->generate('view_admin.php', 'view_template.php');
	}
	public function action_login(){
		if($_SESSION['User']->id != 1){
			header("Location: http://energos/");
		}
		if(isset($_POST['nickname']) AND !empty($_POST['nickname'])){
			$user = $this->model->get_user($_POST['nickname']);
			if(isset($user)){
				$_SESSION['User'] = $user;
				
			}
		}
		header("Location: http://energos/");
	}
}
?>