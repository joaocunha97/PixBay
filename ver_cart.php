<?php


spl_autoload_register(function ($class_name) {
    include_once dirname(__FILE__) . '/entidades/' . $class_name . '.php';
});
session_start();
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
<img src="images/logo.png"  height="150px" width="350px">
<a href="end_session.php" style="float:right; color:#d31919; margin-top:130px"><b>Terminar Sessao</b></a>
<div class="fundo">  
  <a style="float:right; margin-top:15px"><b> <?php echo $_SESSION['display']; ?></b> </a>
  </div>
  <ul>
  <li style="float:right"><a href="album.php">Album</a></li>
  </ul>
  <div>
  <center>
  <h1>Carrinho de Compras</h1>
  </center>
  </div>
  </body>
  </html>
  <?php
  
  if(empty($_SESSION['cart'])){
      echo "<center>";
      echo "<p style='color:red;'>Carrinho de compras vazio";
      echo "<br><br>";
      echo "<a class='w3-button w3-pale-red' href=album.php>Voltar</a>";
    }else{
        foreach($_SESSION['cart'] as $i=>$k){
            echo "<center>";
            echo $_SESSION['cart'][$i];
            echo "<br>";
            echo "Preço: 1€";
            echo "<center><a class='w3-button w3-red' href='?delete=$i' name=delete> Eliminar</a></center>";
            echo "<br><br>";
            if(isset($_GET['delete'])){
              $delete=$_GET['delete'];
              unset($_SESSION['cart'][$delete]);
              header("Location:ver_cart.php");
            }
          }
          echo "<center>";
          echo "<br><br>";
          echo "<a class='w3-button w3-orange' href=encomendar.php name=encomendar>Encomendar</a>";
          echo "</center>";
          
      
        }