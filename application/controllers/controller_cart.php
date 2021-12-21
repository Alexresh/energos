<?php
class Controller_cart extends Controller
{
    public function __construct() {
        $this->model = new Model_Cart();
        $this->view = new View();
    }
    
    function action_index(){
        $this->view->generate('view_cart.php', 'view_template.php');
    }
    public function action_add(){
        $response = $this->model->add($_POST);
        var_dump($response);
    }
    public function action_clear(){
        $_SESSION["Cart"] = null;
        header("Location: http://energos/");
    }
}
?>