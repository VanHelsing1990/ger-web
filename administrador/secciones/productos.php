<?php include("../template/cabecera.php"); ?>
<?php

$txtid=(isset($_POST['txtid']))?$_POST['txtid']:"";
$txtnombre=(isset($_POST['txtnombre']))?$_POST['txtnombre']:"";

$txtimagen=(isset($_FILES['txtimagen']['name']))?$_FILES['txtimagen']['name']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");



switch($accion){
    
    
    
    case"agregar":

        $sentenciasql= $conexion->prepare("INSERT INTO diseños (nombre,imagen) VALUES (:nombre,:imagen);");
        $sentenciasql->bindParam(':nombre',$txtnombre);

        $fecha= new DateTime();
        $nombrearchivo=($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES["txtimagen"]["name"]:"imagen.jpg";

        $tmpimagen=$_FILES["txtimagen"]["tmp_name"];

        if($tmpimagen!=""){
            move_uploaded_file($tmpimagen,"../../images/".$nombrearchivo);
        }


        $sentenciasql->bindParam(':imagen',$nombrearchivo);
        $sentenciasql->execute();
        
        header("location:productos.php");
        break;
    
    case"Modificar":

        $sentenciasql=$conexion->prepare("UPDATE diseños SET nombre=:nombre WHERE id=:id");
        $sentenciasql->bindParam(':nombre',$txtnombre);
        $sentenciasql->bindParam(':id',$txtid);
        $sentenciasql->execute();

        if($txtimagen!=""){

            $fecha= new DateTime();
            $nombrearchivo=($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES["txtimagen"]["name"]:"imagen.jpg";
            $tmpimagen=$_FILES["txtimagen"]["tmp_name"];

            move_uploaded_file($tmpimagen,"../../images/".$nombrearchivo);

            $sentenciasql=$conexion->prepare("SELECT imagen FROM diseños WHERE id=:id");
            $sentenciasql->bindParam(':id',$txtid);
            $sentenciasql->execute();
            $disenio=$sentenciasql->fetch(PDO::FETCH_LAZY);
    
            if( isset($disenio["imagen"]) &&($disenio["imagen"]!="imagen.jpg") ){
    
                if(file_exists("../../images/".$disenio["imagen"])){
    
                    unlink("../../images/".$disenio["imagen"]);
                }
    
            }

            $sentenciasql=$conexion->prepare("UPDATE diseños SET imagen=:imagen WHERE id=:id");
            $sentenciasql->bindParam(':imagen',$nombrearchivo);
            $sentenciasql->bindParam(':id',$txtid);
            $sentenciasql->execute();
        }
        header("location:productos.php");
        break;

     case"Cancelar":
         header("location:productos.php");
        break;
   
    case"Seleccionar":
        $sentenciasql=$conexion->prepare("SELECT * FROM diseños WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtid);
        $sentenciasql->execute();
        $disenio=$sentenciasql->fetch(PDO::FETCH_LAZY);

        $txtnombre=$disenio['nombre'];
        $txtimagen=$disenio['imagen'];

        break;

    case"Borrar":
        
        $sentenciasql=$conexion->prepare("SELECT imagen FROM diseños WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtid);
        $sentenciasql->execute();
        $disenio=$sentenciasql->fetch(PDO::FETCH_LAZY);

        if( isset($disenio["imagen"]) &&($disenio["imagen"]!="imagen.jpg") ){

            if(file_exists("../../images/".$disenio["imagen"])){

                unlink("../../images/".$disenio["imagen"]);
            }

        }
       

        $sentenciasql=$conexion->prepare("DELETE FROM diseños WHERE id=:id");
        $sentenciasql->bindParam(':id',$txtid);
        $sentenciasql->execute();

        header("location:productos.php");
        break;
}

$sentenciasql=$conexion->prepare("SELECT * FROM diseños");

$sentenciasql->execute();
$listadisenios=$sentenciasql->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Dato del Diseño
        </div>

        <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtid">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtid; ?>" id="txtid" name="txtid" placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtnombre">Nombre:</label>
            <input type="text" required class="form-control" value="<?php echo $txtnombre; ?>" id="txtnombre" name="txtnombre" placeholder="Nombre del diseño">
            </div>

            <div class = "form-group">
            <label for="txtnombre">Imagen:</label>

            <br/>

            <?php if($txtimagen!=""){ ?>
            
                

                <img class="img-thumbnail rounded" src="../../images/<?php echo $txtimagen;?>" width="50" alt="" srcset="">

            
            <?php } ?>
                
            


            <input type="file"  class="form-control" id="txtimagen" name="txtimagen" placeholder="Nombre del diseño">
            </div>


            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

    </form>  
        </div>

       
    </div>

    
   
    
    
</div>
<div class="col-md-7">
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listadisenios as $disenio){ ?>
            <tr>
                <td><?php echo $disenio['id']; ?></td>
                <td><?php echo $disenio['nombre']; ?></td>
                <td>
                   
                <img class="img-thumbnail rounded" src="../../images/<?php echo $disenio['imagen']; ?>" width="50" alt="" srcset="">
                
            
                </td>
                

                <td>
                    
                   

                    <form method="post">

                        <input type="hidden" name="txtid" id="txtid" value="<?php echo $disenio['id']; ?>"/>

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                    </form>

                </td>
            
            </tr>
           <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../template/pie.php"); ?>