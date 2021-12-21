<?php
class Model_Main extends Model
{
    public function get_data()
	{	
		$items = $this->context->get_items();
		$brands = $this->context->get_brands();
		
		return array(
			'items' => $items,
			'brands' => $brands
		);
	}

    public function get_filtered_data($param)
    {
		$items = $this->context->get_filtered_items($param);
        $brands = $this->context->get_brands();
		return array(
			'items' => $items,
			'brands' => $brands
		);
    }
}
?>