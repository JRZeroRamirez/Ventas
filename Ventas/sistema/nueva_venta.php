<?php 
session_start();



include "../conexion.php";

if(!empty($_POST)){
//conexion BD y almacenado de datos  de las ventas registradas
   
    $alert='';
    if(empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['cliente']) || empty($_POST['producto']) ||
      empty($_POST['cantidad']) || empty($_POST['valor']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{    

        $fecha =$_POST['fecha'];
        $hora =$_POST['hora'];
        $cliente =$_POST['cliente'];
        $producto =$_POST['producto'];
        $cantidad =$_POST['cantidad'];     
        $valor = $_POST['valor'];
       
        $query =mysqli_query($conection,"SELECT * FROM venta WHERE producto = '$producto'");
       
       $result = mysqli_fetch_array($query);
       if($result > 0){
        $alert='<p class="msg_errror">El cproducto ya existe.</p>';
         }else{
       $query_insert =mysqli_query($conection,"INSERT INTO venta (fecha, hora, cliente, producto, cantidad, valor)
                                                         VALUES ('$fecha','$hora','$cliente','$producto','$cantidad','$valor')");
              

              if($query_insert){ 
                $alert='<p class="msg_save">Venta guardada correctamente.</P>';
            }else{
                $alert='<p class="msg_error">Error al guardar la venta.</P>';
            }
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
	<title>Registro Venta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1>Registro Venta</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>
<!--formulario de registro ventas -->
    <form action=" " method="post" >
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha">
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" >
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" id="cliente" placeholder="Nombre del cliente">
        <label for="producto">Producto</label>
        <input type="text" name="producto" id="producto" placeholder="Producto">                    
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
        <label for="precio">Valor</label>
        <input type="number" name="precio" id="precio" placeholder="Precio del producto">
        
        <input type="submit" value="Guardar venta" class="btn_save">

    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>