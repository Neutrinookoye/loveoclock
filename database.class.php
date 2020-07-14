<?php

class Database {
	private $hn ;
	private $un ;
	private $pw ;
	private $db ;
	public function __construct($dataFile) {
		$this->hn = $dataFile[0] ; 
		$this->un = $dataFile[1] ; 
		$this->pw = $dataFile[2] ; 
		$this->db = $dataFile[3] ; 
	}
	public function connect() {
		try {
			$dbc = mysqli_connect($this->hn , $this->un , $this->pw , $this->db) ; 
			return $dbc ;
			throw new Exception("Unable to connect to the Database");
		}catch(Exception $e) {
			echo($e->getMessage());
		}  
	}
	public function close() {
		try {
			$dbc = mysqli_close($this->connect()) ; 
			return $dbc ;
			throw new Exception("Unable to close  the Database");
		}catch(Exception $e) {
			echo($e->getMessage());
		} 
	} 
}
class DBResult extends Database {
	private $bigQuery ;
	public function __construct($dataFile) {
		//Assuming this method will take more argument than the parent
		//public function __construct(parent , child) {
			//parent::__constructor(parent)  ; 
			//$this->child = $child ; 
			//}
		parent::__construct($dataFile) ;
	}
	public function setQuery($query) {
		$this->bigQuery = $query ;
	}
	public function getQuery() {
		return $this->bigQuery ;
	}
	// The method below is that which will take the query 
	public function database_result() {
		try {
			$result = mysqli_query($this->connect() , $this->getQuery())  ;
			throw new Exception("Unable to issue query.Check your code") ;
		}catch (Exception $e) {
			echo($e->getMessage()) ;
		}
	}
}
	
?>
        		
		 
		