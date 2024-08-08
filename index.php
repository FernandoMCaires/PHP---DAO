<?php
require_once("config.php");


//Carrega um usuario:
//$newUser = new Usuario();
//$newUser->loadById(3);
//echo $newUser;

//Carrega uma lista de usuarios:
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("i");
//echo json_encode($search);

//Carrega e verifica se nome e senha estao certos:
//$usuario = new Usuario();
//$usuario->login("Malaquias","123454321");
//echo $usuario;

//insert new usuario:
//$aluno = new Usuario();
//$aluno->setNome("Fensk");
//$aluno->setSenha("#$%^^");
//$aluno->setEmail("fernandomullerc@gmail.com");
//$aluno->insert();
//echo $aluno;

//Update Usuario:
//$usuario = new Usuario();
//$usuario->loadById(7);
//$usuario->update("Fernando Caires","fernandomuller@gmail.com","a@@@###");
//echo $usuario;

//Delete Usuario:
$usuario = new Usuario();
$usuario->loadById(6);
$usuario->delete();
echo $usuario;

?>