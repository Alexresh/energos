<?php
class Controller_cart extends Controller
{
    public function __construct() {
        $this->view = new View();
    }
    
    function action_index(){
        $this->view->generate('view_cart.php', 'view_template.php');
    }
}
?>