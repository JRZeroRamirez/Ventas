<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}
     include "../conexion.php";
    if(!empty($_POST))
    {
            if($_POST['codproducto'] ==1 ){
                header("location: lista_producto.php");
               
                exit;
            }          
            $codproducto=$_POST['codproducto'];
            $query_delete = mysqli_query($conection,"DELETE FROM producto WHERE codproducto = $codproducto");
           
            if($query_delete){
                header("location: lista_producto.php");
            }else{
                echo "Error al eliminar";
            }

    }

    if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 ){

        header("location: lista_producto.php");
       
    }else{

       

        $codproducto = $_REQUEST['id'];

        $query = mysqli_query($conection,"SELECT p.producto, p.descripcion, p.precio, p.cantidad, p.foto 
                                          FROM producto p                                           
                                          WHERE p.codproducto = $codproducto");
        
        $result = mysqli_num_rows($query);

if($result > 0){
    while($data = mysqli_fetch_array($query)){
        # code... 
        $producto = $data['producto'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        $cantidad = $data['cantidad'];
        $foto = $data['foto'];

        }
    }else{

    header("location: lista_producto.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Eliminar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
        
    <div class="data_delete">
        <h2>¿Esta seguro de eliminar el siguiente Registro?</h2>
        <p>Producto: <span><?php echo $producto; ?></span></p>
        <p>Descripcion: <span><?php echo $descripcion; ?></span></p>
        <p>Cantidad: <span><?php echo $cantidad; ?></span></p>

        <form method="post" action=""> 
            <input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">
            <a href="lista_producto.php" class="btn_cancel">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_ok">

        </form>

    </div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>