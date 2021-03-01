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
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de  usuarios</h1>
        <!--mostrar en lista los usuarios-->
        <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>ubicacion</th>
                <th>Rol</th>                
                <th>Acciones</th>                           
            </tr>

            <?php 
            
            $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, u.ubicacion, r.rol FROM usuario u INNER JOIN rol r ON u.rol = R.idrol ORDER BY idusuario ASC");
           
            $result = mysqli_num_rows($query);
            if($result > 0){

                while($data = mysqli_fetch_array($query)){
                        #code...
            ?>
            <tr>
                <td><?php echo $data["idusuario"]; ?></td>
                <td><?php echo $data["nombre"]; ?></td>
                <td><?php echo $data["correo"]; ?></td>
                <td><?php echo $data["usuario"]; ?></td>
                <td><?php echo $data["ubicacion"];?></td>
                <td><?php echo $data["rol"]; ?></td>
                <td>
                    <a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Editar</a>  
                    
                 <?php  if($data['idusuario'] != 1) {
                                       
                    ?>
                    
                    |       
                    <a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Eliminar</a>
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