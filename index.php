<?php
require_once("config.php");
//---------------------------------------
// Carrega um usuario - OK
//---------------------------------------
//$nome = new Usuario();
//$nome->loadById(2);  
//echo $nome;
//---------------------------------------

//---------------------------------------
//Carrega uma lista de usuarios	- OK
//---------------------------------------
//$lista = Usuario::getList();
//echo json_encode($lista);
//---------------------------------------

//---------------------------------------
//Carrega lista buscando pelo login - OK
//---------------------------------------
//$search = Usuario::search("l");
//echo json_encode($search);
//---------------------------------------

//---------------------------------------
//Carrega um usuario e senha valido - OK
//---------------------------------------
//$usuario  =  new Usuario();
//$usuario->login("PEDRO","7777");
//echo $usuario;
//---------------------------------------

//---------------------------------------
//Cria usuario no sistema com set - OK
//---------------------------------------
//$usuario  =  new Usuario();
//$usuario->setUser("Amaral da cruz");
//$usuario->setPassword("7777");
//$usuario->insert();
//echo $usuario;
//---------------------------------------

//---------------------------------------
//Cria usuario no sistema no construtor - OK
//---------------------------------------
//$usuario  =  new Usuario("Felipe As", "7474");
//$usuario->insert();
//echo $usuario;
//---------------------------------------

//---------------------------------------
//Update alrterar do usuario - OK
//---------------------------------------
//$usuario  =  new Usuario();
//$usuario->loadById(5);  
//$usuario->update("Ananias", "9885#"); 
//echo $usuario;
//---------------------------------------

//---------------------------------------
//Delete do usuario - OK
//---------------------------------------
$usuario  =  new Usuario();
$usuario->loadById(6);  
$usuario->delete(); 
echo $usuario;
//---------------------------------------

?>