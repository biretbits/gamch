<?php
class Conexion{

	private $database;
	private $pass;
	private $user;
	private $host;
	private $cnmysql;

	public function __construct(){
    $this->database="gamch";
		$this->pass="1234";
		$this->user="root";
		$this->host="localhost";
		$this->cnmysql=null;
	}
	public function Conectaras(){
		try{
			$cnmysql = mysqli_connect($this->host,$this->user,$this->pass,$this->database);


			if($cnmysql!=null){
				$cnmysql->set_charset("utf8mb4");
				return $cnmysql;

			}


			}catch(Exception $e){
				die($e->getMessage());
			}
	}
	public function getDatabase() {
		$arbd = array('database' => $this->database,
	 	'contrasena' => $this->pass,
		'root' => $this->user,
		'localhost'=>$this->host,
		'cnmysqli'=>$this->cnmysql);

		return $arbd;
	}
}
/*
$connn=new Conexion();
$conee;
$conee=$connn->Conectaras();
print_r($conee);
*/
?>
