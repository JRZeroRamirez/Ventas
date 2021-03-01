<?php 
session_start();

    include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Lista de Productos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1><i class="fas fa-cube"></i>Lista de productos</h1>
        <a href="registro_producto.php" class="btn_new">Registrar producto</a>
               

        <table>
            <tr>
                <th>Código</th> 
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>  
                <th>Cantidad</th>              
                <th>Foto</th>
                <th>Acciones</th>                        
            </tr>
            <?php 
            
            $sql_register = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM producto");
            $result_register = mysqli_fetch_array($sql_register);
            $total_registro = $result_register['total_registro'];
            $por_pagina = 50;

            if(empty($_GET['pagina'])){
                $pagina = 1;
            } else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conection,"SELECT p.codproducto, p.producto, p.descripcion, p.precio, p.cantidad, p.foto 
                                                FROM producto p ORDER BY codproducto 
                                                ASC");

           
            $result = mysqli_num_rows($query);            
            if($result > 0){

                while($data = mysqli_fetch_array($query)){
                    if($data['foto'] != 'img_producto.png'){
                        $foto = 'img/uploads/'.$data['foto'];
                    } else{
                        $foto = 'img/'.$data['foto'];
                    }
                    
            ?>
            <tr>
                <td><?php echo $data["codproducto"]; ?></td>
                <td><?php echo $data["producto"]; ?></td>
                <td><?php echo $data["descripcion"]; ?></td>
                <td><?php echo $data["precio"]; ?></td>
                <td><?php echo $data["cantidad"]; ?></td>

                
                <td class="img_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data["producto"]; ?>"></td>
                <td>
                    
                    <a class="link_edit" href="editar_producto.php?id=<?php echo $data["codproducto"]; ?>">Editar</a>  
                    <?php  if($data['codproducto'] != 0) {                 
                    ?>
                    |       
                    <a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["codproducto"]; ?>">Eliminar</a>
                    </td>  
                <?php } ?>
                
                                
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