<?php
class Controller_cart extends Controller
{
    public function __construct() {
        $this->model = new Model_Cart();
        $this->view = new View();
    }
    
    function action_index(){
        $data = $this->model->get_data();
        $this->view->generate('view_cart.php', 'view_template.php', $data);
    }
    public function action_add(){
        if(isset($_SESSION["User"])){
            $userId = $userId = $_SESSION["User"]->id;
            return $this->model->add($_POST['item'], $userId);
        }
    }
    public function action_clear(){
        if(isset($_SESSION['User'])){
            $userId = $_SESSION['User']->id;
            $this->model->clear($userId);
        }
        header("Location: http://energos/");
    }
}
?>