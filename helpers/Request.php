<?php 
	
	include "Validation.php";
	class Request 
	{
		public $request;

		public function inputValidate($request){
			foreach ($request as $key => $value) {
				Validation::sanitize($value);
			  Session::set($key, $value);
			}
			return $this->request;
		}

	}
 ?>