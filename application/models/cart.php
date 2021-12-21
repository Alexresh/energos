<?php
class Cart
{
    public $id;
    public $userId;
    public $items = array();

    function __construct($id, $userId) 
    {
        $this->id = $id;
        $this->userid = $userId;
    }

    public function add($itemId, $itemTitle, $itemPrice)
    {
        foreach ($this->items as $cartItem) {
            if($cartItem->itemId == $itemId){
                $cartItem->count++;
                return $this->items;
            }
        }
        $pushItem = new CartItem($itemId, $itemTitle, $itemPrice);
        array_push($this->items, $pushItem);

        return $this->items;
    }
    
    public function addAll($items)
    {
        $this->items = $items;
        return $this->items;
    }

    public function clear()
    {
        $this->items = array();
    }
}


class CartItem{
    public $itemId;
    public $itemTitle;
    public $count;
    public $price;
    function __construct($itemId, $itemTitle, $itemPrice) 
    {
        $this->itemId = $itemId;
        $this->itemTitle = $itemTitle;
        $this->price = $itemPrice;
        $this->count = 1;
    }
    public function add($itemTitle)
    {
        $this->count = $this->count + 1;
    }
}
?>