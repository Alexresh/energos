<?php
class Controller_login extends Controller
{
    public function __construct() {
        $this->model = new Model_Login();
        $this->view = new View();
    }
    
    function action_index(){
        $this->view->generate('view_login.php', 'view_template.php');
    }
    public function action_login(){
        $response = $this->model->get_user($_GET);       
    }
    public function action_logout(){
        $_SESSION["User"] = null;
        header("Location: http://energos/");
    }
}
?>