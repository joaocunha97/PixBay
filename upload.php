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
  <?php
echo "<center>";

//
// Carrega uma imagem do tipo .jpg, .jpeg, .gif ou .png
// Se não fôr uma destas imagens dá mensagem de erro.
//

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pasta onde colocar os ficheiros carregados:
    
 if(!isset($_SESSION['lastimage'])){

        $_SESSION["lastimage"]=0;
        }
        $_SESSION["lastimage"]+=1;
        $counter=$_SESSION["lastimage"];
	$target_dir = "album/";
	
	//Verifica se é imagem (usando a função getimagesize():	
	//Se não fôr imagem a função retorna FALSE:
	$image = getimagesize($_FILES["upload"]["tmp_name"]);
	
	if(!$image){
		echo "<p style='color: #c00'>Não é uma imagem !</p>";
	}else{
		if($image[2] == IMAGETYPE_JPEG || $image[2] == IMAGETYPE_PNG || $image[2] == IMAGETYPE_GIF){
			//obtem o nome do ficheiro carregado de $_FILES["upload"]["name"]:
			$target_file = $target_dir .$counter.'.'. basename($_FILES["upload"]["name"]);
				
			//move ficheiro da pasta temporaria para a pasta "uploads":
			move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);
			
			$imageName =$counter.'.'. basename($_FILES["upload"]["name"]);
			thumbnail($imageName);
			echo "<p style='color: #0c0'>Imagem carregada !</p>";					
		}else{
			echo "<p style='color: #c00'>Imagem deve ser do tipo .jpg, jpeg, .png ou .gif !</p>";
		}
	}
	
}


//
// Função thumbnail() que cria um thumbnail de uma imagem JPG, PNG ou GIF, com as dimensões 80x80.
//
function thumbnail($imagename){
	$imagepath = 'album/' . $imagename;
	
	
	//função getimagesize() : retorna um array com a largura, a altura e o tipo da imagem
	$props = getimagesize($imagepath);
	$width = $props[0];
	$height = $props[1];
	$imageType = $props[2];
	
	$ext = strtolower(pathinfo($imagepath,PATHINFO_EXTENSION));	
	
	switch ($imageType) {
		case IMAGETYPE_PNG:
			//função imagecreatefrompng(): cria o recurso de uma imagem a partir de uma imagem png
			$imageResourceId = imagecreatefrompng($imagepath); 
			$thumb = imageResize($imageResourceId,$width,$height);
			$idx = strpos($imagename,".");
			$basename = substr($imagename,0, $idx);
			//guarda a imagem no formato png na pasta /uploads:
			imagepng($thumb,'album/'. $_SESSION["lastimage"]. "_thumb.". $ext);
			break;

		case IMAGETYPE_GIF:
			//função imagecreatefromgif(): cria o recurso de uma imagem a partir de uma imagem gif
			$imageResourceId = imagecreatefromgif($imagepath); 
			$thumb = imageResize($imageResourceId,$width,$height);
			$idx = strpos($imagename,".");
			$basename = substr($imagename,0, $idx);
			//guarda a imagem no formato gif na pasta /uploads:
			imagegif($thumb,'album/'. $_SESSION["lastimage"]. "_thumb.". $ext);
			break;

		case IMAGETYPE_JPEG:
			//função imagecreatefromjpeg(): cria o recurso de uma imagem a partir de uma imagem jpg
			$imageResourceId = imagecreatefromjpeg($imagepath); 
			$thumb = imageResize($imageResourceId,$width,$height);
			$idx = strpos($imagename,".");
			$basename = substr($imagename,0, $idx);
			//guarda a imagem no formato jpg na pasta /uploads:
			imagejpeg($thumb,'album/'.$_SESSION["lastimage"]. "_thumb.". $ext);
			break;

	}

}


//
// Função imageResize() cria um thumbnail de 80x80 a partir de um recurso de uma imagem.
//
function imageResize($imageResourceId,$width,$height) {
    $targetWidth =80;
    $targetHeight =80;

    $thumb=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($thumb,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);

    return $thumb;

}


?>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:<br>
    <input type="file" name="upload" id="upload"><br>
    <input type="submit" value="Carregar ficheiro" name="submit">
</form>
<a class='w3-button w3-orange' href=admin.php>Voltar</a>
</body>
</html>

