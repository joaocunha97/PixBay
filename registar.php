<?php


spl_autoload_register(function ($class_name) {
    include_once dirname(__FILE__) . '/entidades/' . $class_name . '.php';
});
session_start();

?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nome = $_POST['nome'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$morada = $_POST['morada'];
	$telefone = $_POST['telefone'];
	$msg='';

function validateName($nome){
	global $msg;
	if( strlen(trim($nome)) == 0 ){
		$msg = "Nome obrigatório";
		return false;
	}
	return true;
}

function validatePassword($password){
    global $msg;
    if( strlen(trim($password)) == 0 ){
		$msg = "password obrigatório";
		return false;
	}
	return true;

}

function validateEmail($email){
	global $msg;
	if( strlen(trim($email)) == 0 ){
		$msg = "Email obrigatório";
		return false;
	}
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$msg = "Email inválido";
		return false;
	} 
	
	return true;
}

function validateMorada($morada){
	global $msg;
	if( strlen(trim($morada)) == 0 ){
		$msg = "Morada obrigatório";
		return false;
	}
	return true;
}

function validateTelefone($telefone){
	global $msg;
	
	$telefone = (int)$telefone;
	if( strlen(trim($telefone)) == 0 ){
		$msg = "Telefone obrigatório";
		return false;
	}
	
	if(!filter_var($telefone, FILTER_VALIDATE_INT)){
		$msg = "Telefone inválido";
		return false;
	}
	return true;

}

        
        if(validateName($nome)){
            if(validatePassword($password)){
                if(validateEmail($email)){
                    if(validateMorada($morada)){
                        if(validateTelefone($telefone) ){
							if(array_key_exists($nome, $_SESSION['users'])){
								global $msg;
								$msg="Nome inválido";
							}else{
							$user= new Utilizador($nome,$password,$email,$morada,$telefone);
							$_SESSION['users'][$nome]=$user;
							header("Location: login.php");
							}
						}
                          
                        }
                    }
                }
            }
		}


?>
<html>
<head>
<link rel="stylesheet" href="css/css.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="UTF-8">
<title> </title>
</head>
<body>
<img src="images/logo.png"  height="150px" width="250px">
<form action="registar.php" method="POST" align="center">
<div class="fundo">  </div>
<p>Nome Utilizador: <input type="text" name="nome"value=<?php echo @$nome?>></p> 
<p>Password: <input type="password" name="password"value=<?php echo @$password?>></p>
<p>Email: <input type="text" name="email"value=<?php echo @$email?>></p>
<p>Morada: <input type="text" name="morada"value=<?php echo @$morada?>></p>
<p>Telefone : <input type="text" name="telefone"value=<?php echo @$telefone?>></p>


<br>
<input type="submit" value="Submeter">
<a class='w3-button w3-green' href="login.php">Inicio</a>
<p style="color: #cc0000"><?php echo @$msg?></p>
</form>
	
</body>
</html>