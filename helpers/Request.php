<?php 
	
	include "Validation.php";
	class Request 
	{
		public $request;

		public function inputValidate($request){
			foreach ($request as $key => $value) {
				$this->request[$key] = Validation::sanitize($value);
			  Session::set($key, $value);
			}
			return (object)$this->request;
		}

	}
 ?>