<?php

class Format {
	//static method to format date
	public static function formatDate($date){
		$object = new DateTime($date);
		$converted_date = $object->format('M d, Y ');
		$converted_time = $object->format('h : i A');
		$result = $converted_date.' at '.$converted_time;
		return $result;
	}

	//static method to limit characters
	public static function textShorten($text, $limit = 200){
		if(strlen($text) > $limit){
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text."...";
			return $text;
		} else{
			return $text;
		}
	}


	public static function validation($data){
		$db = new Database;
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($db->link, $data);
		return $data;
	}


	//to check if input data is empty
	public static function emptyValue($data, $field){
		$message = $field. " can not be empty!";
		$field = strtolower($field);
		$error = "error-".$field;

		if(empty($data)){
			Session::Set($error, $message);
			return true;
		}else{
			return false;
		}
	} 


	public static function min($data, $length, $field){
		$string = strlen($data);
		$message = $field. " can not be less than ".$length." characters!";
		$field = strtolower($field);
		$error = "error-".$field;
	
		if ($string < $length) {
			Session::set($error, $message);
			return true;
		}else{
			return false;
		}
	}
}
?>

