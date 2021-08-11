<?php 

	/**
	 * 
	 */
	class Validation
	{
		/**
		*Determine if there is any error in the array
		*
		* @param  array  $errors
    * @return true
		*/
		public static function error($errors){
			if (in_array(true, $errors)) {
     	return true;
     }
		}


		/**
		*sanitize user input value
		*
		* @param  string  $data
    * @return string
		*/
		public static function sanitize($data){
			$db = new Database;
			$data = trim($data);
			$data = stripcslashes($data);
			$data = mysqli_real_escape_string($db->link, $data);
			return $data;
		}


		/**
		*Determine if the user input value empty
		*
		* @param  string  $data
		* @param string $field
    * @return bool
		*/
		public static function required($data, $field){
			$message = $field. " is required.";
			$field = strtolower($field);
			$error = "error-".$field;

			if(empty($data)){
				Session::Set($error, $message);
				return true;
			}else{
				return false;
			}
		} 


		/**
		*chech if input value is well formed email address
		*
		* @param  string  $email
    * @return bool
		*/
		public static function email($email){
			if(!empty($email)){
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		    	Session::set('error-email', 'Please enter a valid email address.');
		    	return true;
		    }
			}else{
				return false;
			}
		}

		/**
		*chech if input value is unique in database
		*
		* @param  string  $data
		* @param  string  $field
    * @return bool
		*/
		public static function unique($data, $field, $table){
			$db = new Database;
			$query = "SELECT * FROM ".$table." WHERE ".$field."='".$data."';";
			$result = $db->select($query);

			//set session message
			$field = strtolower($field);
			$error = "error-".$field;
			$field = ucfirst($field);
			$message = $field." must be unique.";

			if ($result) {
				Session::set($error, $message); 
				return true;	
			}else{
				return false;
			}
		}


		/**
		*determine if the file is an image
		*
		* @param  object|string  $file
    * @param  string  $field
    * @return bool
		*/
		public static function image($file, $field){
			$type = array('jpg', 'jpeg', 'png', 'gif');
			$filename = $file['name'];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);

			//set message for warning 
			$field = strtolower($field);
			$error = "error-".$field;
			$field = ucfirst($field);
			$message = "This file is not an image. Please upload an image file.";

			//check file extension is in the extension type array
			if(in_array($extension, $type)){
				return false;
			}else{
				if ($file['name'] != "") {
					Session::set($error, $message);					
					return true;	
				}
			}
		}

		/**
		*Determine if file size is within a max filesize(MegaByte)
		*
		* @param  file  $file
		* @param  integer $length
		* @param  string $field
    * @return bool
		*/
		public static function maxFileSize($file, $length, $field){
			$filesize = $file['size'];
			$sizeLimit = $length*1024*1024;

			if(!self::image($file, $field)){
				if($filesize <= $sizeLimit){
					return false;
				}else{		
				if ($file['name'] != "") {					
						//set message for warning 
						$field = strtolower($field);
						$error = "error-".$field;
						$field = ucfirst($field);
						$message = $field." must be less than ".$length."MB.";
						Session::set($error, $message);
						return true;
					}	
				}
			}else{
				return false;
			}
		}


		/**
		*chech if input value has a mimnimum length of characters
		*
		* @param  string  $data
		* @param  integer $length
		* @param  string $field
    * @return bool
		*/
		public static function min($data, $length, $field){
			$string = strlen($data);
			$field = strtolower($field);
			$error = "error-".$field;
			$field = ucfirst($field);
			$message = $field. " can not be less than ".$length." characters.";
			if(!empty($data)){
				if ($string < $length) {
					Session::set($error, $message);
					return true;
				}else{
					return false;
				}
			}
		}
	}
 ?>