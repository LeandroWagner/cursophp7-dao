<?php
require_once("config.php");
// Carrega um usuario
//$nome = new Usuario();
//$nome->loadById(2);  
//echo $nome;
//---------------------------------------

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega lista buscando pelo login
//$search = Usuario::search("l");
//echo json_encode($search);

//Carrega um usuario e senha validod
$usuario  =  new Usuario();
$usuario->login("leandro","1234");
echo $usuario;


?>