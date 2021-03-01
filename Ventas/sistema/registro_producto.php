<?php 
session_start();



include "../conexion.php";

if(!empty($_POST)){

    $alert='';
    if(empty($_POST['producto']) || empty($_POST['descripcion']) || 
    empty($_POST['precio']) || $_POST['precio'] <= 0 || empty($_POST['cantidad']) || $_POST['cantidad'] <= 0)
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{    

        $producto =$_POST['producto'];
        $descripcion =$_POST['descripcion'];
        $precio =$_POST['precio'];
        $cantidad =$_POST['cantidad'];     
        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $imgProducto = 'img_producto.png';

            if($nombre_foto != '') {
                $destino = 'img/uploads/';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src = $destino.$imgProducto;
            }
        
            $query_insert =mysqli_query($conection,"INSERT INTO producto (producto, descripcion, precio, cantidad, foto)
                                                                VALUES ('$producto','$descripcion','$precio','$cantidad','$imgProducto')");

            if($query_insert){
                if($nombre_foto != ''){
                    move_uploaded_file($url_temp,$src);
                }

                $alert='<p class="msg_save">Producto guardado correctamente.</P>';
            }else{
                $alert='<p class="msg_error">Error al guardar el producto.</P>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Registro Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1><i class="fas fa-cubes"></i>Registro Producto</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

    <form action=" " method="post" enctype="multipart/form-data">
        <label for="producto">Producto</label>
        <input type="text" name="producto" id="producto" placeholder="Nombre del producto">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto">
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" placeholder="Precio del producto">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">

        <div class="photo">
            <label for="foto">Foto</label>
                <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
                </div>
                <div class="upimg">
                <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
        </div>

        <button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar Producto</button>

    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>