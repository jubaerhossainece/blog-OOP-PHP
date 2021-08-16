<?php 
	include "Validation.php";
	
	class Request 
	{
		public $request;
		protected $errors = [];

		/**
		*validate input value in the given array
		*
		* @param  array  $request
    * @return object
		*/
		public function inputValidate($request){
			foreach ($request as $key => $value) {
				$this->request[$key] = Validation::sanitize($value);
			  Session::set($key, $value);
			}
			return (object)$this->request;
		}

		/**
		*validate input value according to the validation method given in the array
		*
		* @param  object  $data
		* @param  array  $rules
    * @return bool
		*/
		public function validate($data, $rules = array()){
			$validator = new Validation;
			$errors = [];
			foreach($rules as $fieldName => $rules){

				foreach ($rules as $method_params) {
					$method_param_array = explode(":", $method_params);
					$method = $method_param_array[0];

					if (sizeof($method_param_array) === 1) {

							$error = $validator->$method($data->$fieldName, $fieldName);

					}elseif(sizeof($method_param_array) === 2){
							$param_arg = $method_param_array[1];

							$param_arg_array = explode(",", $param_arg);
							$param = $param_arg_array[0];

							if (sizeof($param_arg_array) === 1) {
							
									$error = $validator->$method($data->$fieldName, $fieldName, $param);
							
							}elseif(sizeof($param_arg_array) === 2){
								
								$arg = $param_arg_array[1];
								$error = $validator->$method($data->$fieldName, $fieldName, $param, $arg);
							
							}

					}

					$errors[] = $error;
				}
					$this->errors = array_merge($this->errors, $errors);

			}
			return $validator->error($this->errors);
		}

	}
 ?>