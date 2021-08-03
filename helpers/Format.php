<?php

class Format {

	/**
	*Convert a date in a specified format
	*
	* @param  date  $data
  * @return date
	*/
	public static function formatDate($date){
		$object = new DateTime($date);
		$converted_date = $object->format('M d, Y ');
		$converted_time = $object->format('h : i A');
		$result = $converted_date.' at '.$converted_time;
		return $result;
	}


	/**
	*Convert a date in a specified format
	*
	* @param  string  $text
	* @param  integer $limit
	* @param  string $field
  * @return string
	*/
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
}
?>

