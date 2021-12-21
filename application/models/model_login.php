<?php
class Model_Login extends Model
{
    public function get_user($userData)
	{	
		$response = $this->context->get_user($userData);
		if(isset($response)){
			$_SESSION["User"] = $response;
            echo($response->firstName);
        }else{
            echo 400;
        }
		
	}
}
?>