<?php
session_start();
unset($_SESSION['nome']);
unset($_SESSION['cart']);

echo "<script> 
	alert('Logout feito com Sucesso!');
	window.location.href='index.php' </script>;
	";

?>