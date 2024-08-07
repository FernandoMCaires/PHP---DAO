<?php
require_once("config.php");


//Carrega um usuario
//$newUser = new Usuario();
//$newUser->loadById(3);
//echo $newUser;

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("i");
//echo json_encode($search);

//Carrega e verifica se nome e senha estao certos
$usuario = new Usuario();
$usuario->login("Malaquias","123454321");
echo $usuario;
?>