<?php
	Class Database{
		public $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $link;
		public $error;

		public function __construct(){
			$this->connectDB();
		}

		/**
		*make connection with database
		*
		*/

		private function connectDB(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

			if(!$this->link){
				$this->error = "Connection failed ".$this->link->connect_error;
				return false;
			}
		}

		/**
		*Fetch data from database
		*
		* @param  string  $query
	  * @return bool or string
		*/
		public function select($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result->num_rows > 0){
				return $result;
			}else{
				return false;
			}
		}
 
		/**
		*Insert data to the database
		*
		* @param  string  $query
	  * @return bool or string
		*/
		public function insert($query){
			$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($insert_row){
				return $insert_row;
			}else{
				return false;
			}
		}

		/**
		*Update data in the database table
		*
		* @param  string  $query
	  * @return bool or string
		*/
		public function update($query){
			$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($update_row){
				return $update_row;
			}else{
				return false;
			}
		}


		/**
		*Insert data to the database
		*
		* @param  string  $query
	  * @return bool or string
		*/
		public function delete($query){
			$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($delete_row){
				return $delete_row;
			}else{
				return false;
			}
		}
	}
?>