<?php

Class Usuario {
	private $id;
	private $user;
	private $password;

	//---------------------------------------------------------------

	public function getId() {
		return $this->id;

	}
	public function setId($id) {
		$this->id = $id;

	}

	public function getUser() {
		return $this->user;

	}
	public function setUser($user) {
		$this->user = $user;

	}
	public function getPassword() {
		return $this->password;

	}
	public function setPassword($password) {
		$this->password = $password;

	}
	//---------------------------------------------------------------
	//Carrega pelo id	
	public function loadById($id) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM login WHERE id = :ID", array(
			":ID"=>$id

		));

		//---------------------------------------------------------------
		//Preenha os atributos
		if (count($results) > 0 ){
			$row = $results[0];

			$this->setId($row['id']);
			$this->setUser($row['user']);
			$this->setPassword($row['password']);	

		}

	}
	//Metodo magico
	//---------------------------------------------------------------
	public function __toString() {
		
		return json_encode(array(
			"id"=>$this->getId(),
			"user"=>$this->getUser(),
			"password"=>$this->getPassword()
		));
		//*/
	}
	//---------------------------------------------------------------
	//Pode chamar direto o metodo
	public static function getList() {
		//Tras uma lista de usuarios
		$sql = new Sql();
		return $sql->select("SELECT * FROM login ORDER BY id;");

	}
	//Busca usuario 
	public static function search($user) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM login WHERE user LIKE :SEARCH ORDER BY user", array(
			':SEARCH'=>"%".$user."%"


		) );


	}
	//Pode chamar direto o metodo
	public function login($user, $password) {
		//Tras uma lista de usuarios
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM login WHERE user =:USER AND password =:PASSWORD", array(
			":USER"=>$user,
			":PASSWORD"=>$password


		));
		//---------------------------------------------------------------
		//Preenha os atributos
		if (count($results) > 0 ){
			$row = $results[0];

			$this->setId($row['id']);
			$this->setUser($row['user']);
			$this->setPassword($row['password']);	

		}else {

			throw new Exception("User ou Password invalidos");
			
		}


	}







}
?>