<?php
spl_autoload_register(function ($class_name) {
	
    include_once dirname(__FILE__) . '/entidades/' . $class_name . '.php';
});
session_start();
if((!isset ($_SESSION['users']) == true))
{
    header('location:login.php');
    
    } else {
      $users= $_SESSION['users'];
      foreach($users as $i => $k) {
      }
}

?>

<html>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

}
</style>
<head>
<link rel="stylesheet" href="css/css.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<img src="images/logo.png"  height="150px" width="250px">
<a href="end_session.php" style="float:right; color:#d31919; margin-top:130px"><b>Terminar Sessao</b></a>
<div class="fundo">  
  <a style="float:right; margin-top:15px"><b> <?php echo $_SESSION['display']; ?></b> </a>
  </div>
  <ul>
  <li style="float:right"><a href="ver_cart.php">Ver Carrinho</a></li>
  </ul>
  <?php

echo "<center>";

echo "<br><br>";


$dirname = "album/";
$image = scandir($dirname);
$ignore = Array(".", "..");

  foreach($image as $v => $k){
    if(!in_array($k, $ignore) && stripos($k, '_thumb.') !== false) {
      echo "<a  href=ver_imagem.php?id=".$v."><img src='album/$k' /> </a><br>";
      echo $k."   <span style='color:red'>(1€)</span>";
      echo "<br>";
      echo "<a class='w3-button w3-orange' href=album.php?id=".$v." name=add>Comprar</a>";
      echo "<br>";
      echo "<br>";
      }
    }
    if(isset($_GET['id'])) {
      $id=$_GET['id'];
      $_SESSION['cart'][$id]= $image[$id];

    echo "<script>alert('Produto Adicionado ao Carrinho!');window.location.href = 'album.php';</script>;";
    }
?>
  
</body>
</html>
