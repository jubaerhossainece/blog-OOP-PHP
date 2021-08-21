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


	/**
	*Get the title from url
	*
  	* @return string
	*/
	public static function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        $title = str_replace('-', ' ', $title);
        if($title === 'index'){
            $title = 'home';
        }
        return $title = ucfirst($title);
    }

	/**
	*Get the title from url
	*
	* @param  string  $uri
  	* @return bool
	*/
	public static function current_page($uri){
		$path = $_SERVER['SCRIPT_NAME'];
		$path = basename($path,".php");
		$path = str_replace('/', '', $path);
		$cur_url = strtolower($path);

        if($uri === $cur_url){
			return true;
		}else{
			return false;
		}
    }
}
?>

