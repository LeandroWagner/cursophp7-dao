<?php

Class Usuario {
	private $id;
	private $user;
	private $password;
	//Nao obrigatorio
	function __construct($user ="" , $password = ""){
		$this->user = $user;
		$this->password = $password;
	}

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
	//---------------------------------------------------------------
	public function loadById($id) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM login WHERE id = :ID", array(
			":ID"=>$id
		));
		//---------------------------------------------------------------
		//Preenha os atributos
		if (count($results) > 0 ) {
			$this->setData($results[0]);
		}
	}
	//---------------------------------------------------------------
	//Metodo magico __toString retorna json
	//---------------------------------------------------------------
	public function __toString() {
		return json_encode(array(
			"id"=>$this->getId(),
			"user"=>$this->getUser(),
			"password"=>$this->getPassword()
		));
	}
	//---------------------------------------------------------------
	//Pode chamar direto o metodo por ser statics 
	//---------------------------------------------------------------
	public static function getList() {
		//Tras uma lista de usuarios
		$sql = new Sql();
		return $sql->select("SELECT * FROM login ORDER BY id;");
	}
	//---------------------------------------------------------------
	//Busca usuario expefico
	//---------------------------------------------------------------
	public static function search($user) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM login WHERE user LIKE :SEARCH ORDER BY user", array(
			':SEARCH'=>"%".$user."%"
		) );
	}
	//---------------------------------------------------------------
	//Pode chamar direto o metodo - login com usuario e senha
	//---------------------------------------------------------------
	public function login($user, $password) {
		//Tras uma lista de usuarios
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM login WHERE user =:USER AND password =:PASSWORD", array(
			":USER"=>$user,
			":PASSWORD"=>$password
		));
		//Preenha os atributos
		if (count($results) > 0 ){
			$this->setData($results[0]);
		} else {
			throw new Exception("User ou Password invalidos");
		}
	}
	//---------------------------------------------------------------
	//Dados a serem setados
	//---------------------------------------------------------------
	public function setData($data) {
		$this->setId($data['id']);
		$this->setUser($data['user']);
		$this->setPassword($data['password']);	
	}
	//---------------------------------------------------------------
	public function insert() {
		$sql = new Sql();
		//Chama procedures CALL /sp_usuarios_insert() // store procedure usuarios insert (spui)
		$results = $sql->select("CALL sp_usuarios_insert(:USER, :PASSWORD)", array(
			":USER"=>$this->getUser(),
			":PASSWORD"=>$this->getPassword()
		));
		//Preenha os atributos
		if (count($results) > 0 ) {
			$this->setData($results[0]);
		}
		// Recebe dois paramentro user e senha 
	}
	//Essa procedure foi com select porque ele no final a ser executa o insert retorna o id gerado. / confecao p-> parametro v-> variavel
	//---------------------------------------------------------------
	/*
	//-------------------------------------------------------- 
	//CRIA PROCEDURE FUNCIONA
	//-------------------------------------------------------- 
	DELIMITER //
	CREATE PROCEDURE sp_usuarios_insert(
	puser varchar(10),
	ppassword varchar(10)
	)
	BEGIN
	INSERT INTO login (user, password) VALUES (puser, ppassword);
	SELECT * FROM login where id=LAST_INSERT_ID();
	END;
	//
	DELIMITER ;
	//-------------------------------------------------------- 
	//APAGA PROCEDURE
	//-------------------------------------------------------- 
	DROP procedure sp_usuarios_insert;
	//--------------------------------------------------------
	//CHAMA PROCEDURE
	//--------------------------------------------------------
	CALL sp_usuarios_insert("Joao Agusto", "9988"); 
	*/

	//---------------------------------------------------------------
	public function update($user, $password) {
		$this->user = $user;
		$this->password = $password;
		
		$sql = new Sql();
		$sql->query("UPDATE login set user = :USER, password = :PASSWORD where id = :ID", array(
			':USER'=>$this->getUser(),
			':PASSWORD'=>$this->getPassword(),
			':ID'=>$this->getId()
		));
		// Recebe dois paramentro user e senha 
	}
	//---------------------------------------------------------------
	//---------------------------------------------------------------
	public function delete() {
		$sql = new Sql();
		$sql->query("DELETE FROM login where id = :ID", array(
			':ID'=>$this->getId()
		));
		$this->setId(0);
		$this->setUser(null);
		$this->setPassword(null);
	}
}
?>
