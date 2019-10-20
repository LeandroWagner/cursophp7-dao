<?php
//Classe SqL
//Herda o metodos da classe PDO					
Class Sql extends PDO {
	private $conn;								//Atributo de conexao
	//-----------------------------------------------------------------
	function __construct() {					//Construtor da classe padrao
		$login = "root";
		$senha = "";
		$this->conn = new PDO("mysql:host=localhost;dbname=bdphp7;", $login, $senha);	//Conexao usando banco mysql
	} 
	//-----------------------------------------------------------------
	private function setParams($statment, $parameters = array()) {
		foreach ($parameters as $key => $value) {
			$this->setParm($key, $value);
		}
	}
	//-----------------------------------------------------------------//Faz de um parametro
	private function setParam($statment, $key, $value) {
		foreach ($parameters as $key => $value) {
			$statment->bindParam($key, $value);
		}

	}
	//-----------------------------------------------------------------
	//rawQuery = query bruta
	//-----------------------------------------------------------------//Retorna um array
	public function query($rawQuery, $params= array()) {			   //rawQuery recebe comandos SQL, paramentos.
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}
	//-----------------------------------------------------------------
	public function select($rawQuery, $params= array()):array{		   //Retorna um array
		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);					   //Dados associativos
	}
	//-----------------------------------------------------------------	

}


?>