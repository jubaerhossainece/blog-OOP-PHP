<?php 

class Session{
	/**
	*Initialize a session
	*
	*/
	public static function init(){
		session_start();
	}

	/**
	*Insert data to the database
	*
	* @param  string  $key
	* @param  string $val
	*/
	public static function set($key, $val){
		$_SESSION[$key] = $val;
	}

	/**
	*get session data
	*
	* @param  string  $key
  * @return string
	*/
	public static function get($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];			
		}else{
			return false;
		}
	}

	/**
	*Determine if a session is initialised
	*
	*/
	public static function checkSession(){
		self::init();
		if(self::get('login') == false){
			self::destroy();
		}
	}

	/**
	*Destroy all sessions created
	*
	*/
	public static function destroy(){
		session_destroy();
		header("Location:login.php");
	}

	/**
	*Unset all sessions created
	*
	*/
	public static function unsetSession($key){
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}else{
			return false;
		}
	}
}

 ?>