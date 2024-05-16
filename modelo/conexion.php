<?php
class Conexion{

	private $database;
	private $pass;
	private $user;
	private $host;
	private $cnmysql;

	public function __construct(){
    $this->database="cds";
		$this->pass="";
		$this->user="root";
		$this->host="localhost";
		$this->cnmysql=null;
	}

	public function Conectaras(){
		try{
			$cnmysql = mysqli_connect($this->host,$this->user,$this->pass,$this->database);


			if($cnmysql!=null){
				return $cnmysql;

			}


			}catch(Exception $e){
				die($e->getMessage());
			}
	}
}
/*
$connn=new Conexion();
$conee;
$conee=$connn->Conectaras();
print_r($conee);
*/
?>
