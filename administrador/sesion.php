
<?php
    session_start();
    if($_POST){
      if(($_POST['usuario']=="lombardi")&&($_POST['contrasenia']=="humo")){

        $_SESSION['usuario']="ok";
        $_SESSION['nombreusuario']="lombardi";
        header('location:inicio.php');

      }else{
        $mensaje="Error: El usuario o contraseñá son incorrectos";
      }
                        

    }
?>
<!-------------------------------------------->
<!doctype html>
<html lang="es">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <div class="container">
        <div class="row">
        <!--  -->
        <div class="col-md-4"> <!--agregado para llevarlo al medio-->
            
        </div>

            <div class="col-md-4">
            <br/><br/><br/><br/><br/>  <!--bajar del header-->
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                
                <?php if(isset($mensaje)) {?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $mensaje; ?>
                </div>
                <?php } ?>

                <form method="POST"> <!--enviar la informacion a index.php-->


                <div class = "form-group">
                <label>Usuario</label>

                <input type="text" class="form-control" name="usuario"  placeholder="Escribe tu Usuario">
                </div>

                <div class="form-group">

                <label>Contraseña</label>
                <input type="password" class="form-control" name="contrasenia"  placeholder="Escribe tu Contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Entrar al administrador</button>



                </form>
                
                
                   
                </div>
              
            </div>
                
            </div>
            
        </div>
    </div>
    
  </body>
</html>