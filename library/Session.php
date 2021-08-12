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
    self::init();
    self::set('logout-message', 'You are logged out now!');
    header("Location:login.php");
	}

	/**
	*Unset sessions created
	* @param  array  $errors
  * @return bool
	*/
	public static function unsetSession($key){
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
			return true;
		}else{
			return false;
		}
	}

	/**
	* 
	*Unset sessions created
	* @param  array  $errors
  * @return bool
	*/
	public static function error($key){
		$key= "error-".$key;
		if (isset($_SESSION[$key])) {
			echo self::get($key);
			return true;
		}else{
			return false;
		}
	}


	/**
	* 
	*Unset sessions for $_POST array
	*/
	public static function unsetOld(){
		$auth_array = self::get('auth-keys');
		$session_keys = array();
		foreach ($_SESSION as $key => $value) {
			$session_keys[] = $key;
		}
		$array_offset = array_diff($session_keys, $auth_array);
		foreach ($array_offset as $value) {
			self::unsetSession($value);
		}
	}
}

 ?>