<?php
require_once("config.php");



$newUser = new Usuario();
$newUser->loadById(3);

echo $newUser;


?>