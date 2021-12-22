<?php
class CartItem
{
    public $id;
    public $title;
    public $count;
    public $price;

    function __construct($id, $title, $count, $price) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->count = $count;
        $this->price = $price;
    }
}
?>