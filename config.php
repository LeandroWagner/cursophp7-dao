<?php
spl_autoload_register(function($class_name) {					//Funcao anonima	
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";
	if (file_exists($filename))	{
		require_once("$filename");
	}
});
?>