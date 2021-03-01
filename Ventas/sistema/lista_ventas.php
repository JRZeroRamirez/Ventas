<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}
    include "../conexion.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Lista de ventas</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de Ventas</h1>
        <!--mostrar en lista los usuarios-->
        <a href="nueva_venta.php" class="btn_new">Crear Venta</a>
        <table>
            <tr>
                <th>ID</th>
                <th>fecha</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>     
                <th>Valor</th>            
                <th>Acciones</th>                           
            </tr>

            <?php 
            
            $query = mysqli_query($conection, "SELECT v.codventa, v.fecha, v.hora, v.cliente, v.producto, v.cantidad, v.valor FROM venta v ORDER BY codventa ASC");
           
            $result = mysqli_num_rows($query);
            if($result > 0){

                while($data = mysqli_fetch_array($query)){
                        #code...
            ?>
            <tr>
                <td><?php echo $data["codventa"]; ?></td>
                <td><?php echo $data["fecha"]; ?></td>
                <td><?php echo $data["hora"]; ?></td>
                <td><?php echo $data["cliente"]; ?></td>
                <td><?php echo $data["producto"];?></td>
                <td><?php echo $data["cantidad"]; ?></td>
                <td><?php echo $data["valor"]; ?></td>
                <td>
                    <a class="link_edit" href="editar_venta.php?id=<?php echo $data["codventa"]; ?>">Editar</a>  
                    
                 <?php  if($data['codventa'] != 1) {
                                       
                    ?>
                    
                    |       
                    <a class="link_delete" href="eliminar_confirmar_venta.php?id=<?php echo $data["codventa"]; ?>">Eliminar</a>
                <?php } ?>
                
                </td>                  
            </tr>
    <?php   
        }
    }
    ?>
        </table>

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>