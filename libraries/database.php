<?php
class Database{
	public $host=DB_HOST;
	public $username=DB_USER;
	public $password=DB_PASS;
	public $db_name=DB_NAME;
	
	public $link;
	public $error;
	
	/*
	 * Class constructor
	 */
	public function __construct(){
		//Call connect function
		$this->connect();
	}
	
	/*
	 * Connector
	 */
	private function connect(){
		$this->link=new mysqli($this->host, $this->username, $this->password, $this->db_name);
		$this->link->set_charset("utf8");
		
		if(!$this->link){
			$this->error="Connection failed: ".$this->link->connect_error;
			return false;
		}
		return true;
	}
	
	/*
	 * Select
	 */
	public function select($query){
		$result=$this->link->query($query) or die($this->link->error." on line <b>".__LINE__."</b>");
		if($result->num_rows>0){
			return $result;
		}
		else{
			return false;
		}
	}
	
	/*
	 * Insert
	 */
	public function insert($query){
		$insert_row=$this->link->query($query) or die($this->link->error." on line <b>".__LINE__."</b>");
		$success_msg="Record added.";
		
		//Validate insert
		if($insert_row){
			header("location: index.php?msg=".urlencode($success_msg));
			exit();
		}
		else{
			die($this->link->error." on line <b>".__LINE__."</b>");
		}
	}
	
	/*
	 * Update
	 */
	public function update($query){
		$update_row=$this->link->query($query) or die($this->link->error." on line <b>".__LINE__."</b>");
		$success_msg="Record updated.";
		
		//Validate update
		if($update_row){
			header("location: index.php?msg=".urlencode($success_msg));
			exit();
		}
		else{
			die($this->link->error." on line <b>".__LINE__."</b>");
		}
	}
	
	/*
	 * Delete
	 */
	public function delete($query){
		$delete_row=$this->link->query($query) or die($this->link->error." on line <b>".__LINE__."</b>");
		$success_msg="Record deleted.";
		
		//Validate delete
		if($delete_row){
			header("location: index.php?msg=".urlencode($success_msg));
			exit();
		}
		else{
			die($this->link->error." on line <b>".__LINE__."</b>");
		}
	}
}
?>