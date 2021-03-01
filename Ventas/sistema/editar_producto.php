<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}

 include "../conexion.php";

if(!empty($_POST)){

    $alert='';
    if(empty($_POST['producto']) || empty($_POST['descripcion'])  || empty($_POST['precio']) ||
        empty($_POST['cantidad']) ||   empty($_POST['foto']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{ 
        $codproducto = $_POST['codproducto'];       
        $producto =$_POST['producto'];
        $descripcion =$_POST['descripcion'];
        $precio =$_POST['valor'];
        $cantidad =$_POST['cantidad'];
        $user =$_POST['foto'];       

   
        $query =mysqli_query($conection,"SELECT * FROM producto
                                                    WHERE (producto = '$producto' AND codproducto != $codproducto) 
                                                    ");
                    

       
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_errror">El Producto ya existe.</p>';
        }else{
           
                $sql_update = mysqli_query($conection,"UPDATE producto
                                                        SET producto ='$producto', descripcion ='$descripcion', precio ='$precio', cantidad ='$cantidad', foto ='$foto'
                                                        WHERE codproducto =$codproducto ");
            }
           
            if($sql_update){

                $alert='<p class="msg_save">Producto actualizado  correctamente.</P>';
             }else{
                $alert='<p class="msg_error">Error al actualizar el Producto.</P>';
             }
        }
    }
   

//mostrar datos 
if(empty($_GET['id'])){

    header('location: lista_producto.php');
    
}
$codproducto = $_GET['id'];

$sql = mysqli_query($conection,"SELECT p.codproducto, p.producto, p.descripcion, p.precio, p.cantidad, p.foto FROM producto p  WHERE codproducto = $codproducto");


$result_sql =mysqli_num_rows($sql);
if($result_sql == 0){

    header('location: lista_producto.php');
}else{
    $option ='';
    while($data = mysqli_fetch_array($sql)){
        # code...
        $codproducto = $data['codproducto'];        
        $producto = $data['producto'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        $cantidad = $data['cantidad'];
        $foto = $data['foto'];

     
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Actualizar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1>Actualizar Producto</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

    <form action=" " method="post" enctype="multipart/form-data">
        <input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">       
        <label for="producto">Producto</label>
        <input type="text" name="producto" id="producto" placeholder="Nombre del producto" value ="<?php echo $producto; ?>">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto" value ="<?php echo $descripcion; ?>">
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" placeholder="Precio del producto" value ="<?php echo $precio; ?>">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto" value ="<?php echo $cantidad; ?>">

        <div class="photo">
            <label for="foto">Foto</label>
                <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
                </div>
                <div class="upimg">
                <input type="file" name="foto" id="foto" value ="<?php echo $foto; ?>" >
                </div>
                <div id="form_alert"></div>
        </div>
        
        <input type="submit" value="Actualizar Producto" class="btn_save">
    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>