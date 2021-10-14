<?php


spl_autoload_register(function ($class_name) {
	var_dump($class_name);
    include_once dirname(__FILE__) . '/entidades/' . $class_name . '.php';
});

session_start();

if(!isset( $_SESSION["users"] ) ){
	$_SESSION["users"] = array();
	$user = new Utilizador("admin", "admin", '', '', '');
	$_SESSION["users"]["admin"] = $user;
}

header("Location: login.php");
?>