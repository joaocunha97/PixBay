<?php
spl_autoload_register(function ($class_name) {
	
    include_once dirname(__FILE__) . '/entidades/' . $class_name . '.php';
});
session_start();

?>

<html>

<head>
<link rel="stylesheet" href="css/css.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<img src="images/logo.png"  height="150px" width="250px">
<a href="end_session.php" style="float:right; color:#d31919; margin-top:130px"><b>Terminar Sessao</b></a>
<div class="fundo">  
  <a style="float:right; margin-top:15px"><b> <?php echo "admin" ?></b> </a>
  </div>
  <ul>

  </ul>
  <?php
echo "<center>";

echo "<a class='w3-button w3-green' href=upload.php name=add>Carregar Imagem</a>";
echo "<br><br>";


$dirname = "album/";
$image = scandir($dirname);
$ignore = Array(".", "..");

  foreach($image as $i=>$k){
    if(!in_array($k, $ignore) && stripos($k, '_thumb.') !== false) {
      echo "<img src='album/$k' /><br>";
      echo $k."   <span style='color:red'>(1€)</span>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
     
      }
    }
  

?>
  
</body>
</html>
