<?php
class Item
{
    public $id;
    public $title;
    public $image;
    public $type;
    public $description;
    public $price;

    function __construct($id, $title, $image, $type, $description, $price) 
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->type = $type;
        $this->description = $description;
        $this->price = $price;
    }
}
?>