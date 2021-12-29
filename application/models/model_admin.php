<?php
class Model_Admin extends Model{
    
    public function get_user($nickname){
        return $this->context->get_user_by_nickname($nickname);
    }

}
?>