<?php
class Model_Cart extends Model{
    
    public function add($itemId, $userId){
        return $this->context->add_to_cart($itemId, $userId);
    }

    public function clear($userId){
        return $this->context->clear_cart($userId);
    }

    public function get_data()
    {
        if(isset($_SESSION['User'])){
            $userId = $_SESSION['User']->id;
            return array('cartItems' => $this->context->get_user_cart($userId));
        }
        return null; 
    }

}
?>