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
	*Convert a date in a human raedable format
	*
	* @param  date  $data
  	* @return date
	*/
	public static function dateForHumans($date){
		$object = new DateTime($date);
		$now = new DateTime('now');
		$now->setTimezone(new DateTimeZone('Asia/Dhaka'));
		$now->format('Y-m-d H:i:s');
		$object->format('Y-m-d H:i:s');
		$date = $object->diff($now);
		
		if($date->y >0){
			$time = $date->y;
			if($time > 1){
				$postfix = ' years ago';
			}else{
				$postfix = ' year ago';
			}
			return $data = $time.$postfix;
		}elseif($date->m > 0){
			$time = $date->m;
			if($time > 1){
				$postfix = ' months ago';
			}else{
				$postfix = ' month ago';
			}
			return $data = $time.$postfix;
		}elseif($date->d > 0){
			$time = $date->d;
			if($time > 1){
				$postfix = ' days ago';
			}else{
				$postfix = ' day ago';
			}
			return $data = $time.$postfix;
		}elseif($date->h > 0){
			$time = $date->h;
			if($time > 1){
				$postfix = ' hours ago';
			}else{
				$postfix = ' hour ago';
			}
			return $data = $time.$postfix;
		}elseif($date->i > 0){
			$time = $date->i;
			if($time > 1){
				$postfix = ' minutes ago';
			}else{
				$postfix = ' minute ago';
			}
			return $data = $time.$postfix;
		}elseif($date->s > 0){
			$time = $date->d;
			if($time > 1){
				$postfix = ' seconds ago';
			}else{
				$postfix = ' second ago';
			}
			return $data = $time.$postfix;
		}
	}

	/**
	*Convert a date in a specified format for mail
	*
	* @param  date  $data
  	* @return date
	*/
	public static function mailDate($date){
		$current_year = date('Y');
		$object = new DateTime($date);
		$year = $object->format('Y');
		
		if($year < $current_year){
			return $converted_date = $object->format('d/m/y');
		}elseif($year === $current_year){
			return $converted_date = $object->format('M d');
		}
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

