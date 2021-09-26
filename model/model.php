<?php
class DB{
	//(A)connect to database
	public $error = "";
	private $pdo = null;
	private $stmt = null;
	function __construct(){
		try {
			$this ->pdo = new PDO(
				"mysql:host =".DB_HOST.";port=3309;dbname=".DB_NAME.";charset=".DB_CHARSET,
				DB_USER,DB_PASSWORD,[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC
					]
			);
		}catch(Exception $ex){die($ex->getMessage());}
	}

//(B)close connection
	function __destruct(){
		if($this-> stmt!==null){$this->stmt = null;}
		if($this-> pdo!==null){$this->pdo = null;}
	}

//(c) run a select query 
	function select($sql, $cond=null){
		$result = false;
		try{
			$this->stmt = $this->pdo->prepare($sql);
			$this->stmt->execute($cond);
			$result = $this->stmt->fetchAll();
			return $result;
		}
		catch(Exception $ex){
			$this->error =$ex->getMessage();
			return false;
		}
	}

	//sql insert $sql -> ex : INSERT INTO users (email, vorname, nachname) VALUES (?, ?, ?)
	function insert($sql,$vals = []){
		try{
			if(count($vals) == 0) throw new Exception("there should be values to add");
			$this->stmt = $this->pdo->prepare($sql);
			$this->stmt->execute($vals);
		} 
		catch (Exception $ex){
			$this->error = $ex->getMessage();
		}
	}
}
define('DB_HOST','localhost:8012');
define('DB_NAME','mvc');
define('DB_CHARSET','utf8');
define('DB_USER','root');
define('DB_PASSWORD','');
?>