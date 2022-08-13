<?php 
  session_start();
    if(!isset($_SESSION['usuario']) ){
      header("location:../sesion.php");
      
    }else{

        if($_SESSION['usuario']=="ok"){
          $nombreusuario=$_SESSION["nombreusuario"];

        }

    }
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/lombardi-web-php" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del citio Web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php">Inicio</a>

            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/secciones/productos.php">Fotos a subir</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/secciones/cerrar.php">cerrar</a>

            <a class="nav-item nav-link" href="<?php echo $url; ?>../diseño.php">Ver sitio Web</a>
        </div>
    </nav>

   <div class="container">
    <br/>
            <div class="row">