<?php
class Model_Main extends Model
{
    public function get_data()
	{	
		$items = $this->context->get_items();
		
		return array(
			'items' => $items
		);
	}

    public function get_filtered_data($parameters)
    {
        
    }
}
?>