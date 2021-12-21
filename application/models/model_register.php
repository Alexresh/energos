<?php
class Model_Register extends Model
{
    public function create_user($userData)
	{	
		$response = $this->context->create_user($userData);
		return $response;
	}
}
?>