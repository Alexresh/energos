<?php
class Controller_register extends Controller
{
    public function __construct() {
        $this->model = new Model_Register();
        $this->view = new View();
    }
    
    function action_index(){
        $this->view->generate('view_register.php', 'view_template.php');
    }
    public function action_new(){
        $response = $this->model->create_user($_POST);
        if(isset($response)){
            echo 200;
        }
    }
}
?>