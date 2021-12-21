<?php
class Model_Cart extends Model
{
    
    public function add($item)
	{	
        if(isset($_SESSION["User"])){
            $userId = $_SESSION["User"]->id;
            if(isset($_SESSION["Cart"])){
                $cart = new Cart('0', $userId);
                $cart->addAll($_SESSION["Cart"]->items);
                $item_by_id =  $this->context->get_item_by_id($item["item"]);
                $response = $cart->add($item_by_id->id, $item_by_id->title, $item_by_id->price);
                $_SESSION["Cart"] = $cart;
            }else{
                $cart = new Cart('0', $userId);
                $item_by_id =  $this->context->get_item_by_id($item["item"]);
                $response = $cart->add($item_by_id->id, $item_by_id->title, $item_by_id->price);
                $_SESSION["Cart"] = $cart;
            }
        }
		return $response;
	}
}
?>