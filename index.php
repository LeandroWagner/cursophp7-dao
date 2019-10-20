<?php
require_once("config.php");

$nome = new Usuario();
$nome->loadById(4);

echo $nome;


?>