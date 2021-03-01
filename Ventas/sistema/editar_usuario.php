<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}

 include "../conexion.php";

if(!empty($_POST)){

    $alert='';
    if(empty($_POST['tipodoc']) || empty($_POST['numero']) || empty($_POST['nombre'])  || empty($_POST['apellido']) ||
    empty($_POST['ciudad'])  || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) ||
    empty($_POST['rol']) || empty($_POST['ubicacion']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{ 
        $idusuario = $_POST['idusuario'];
        $tipodoc =$_POST['tipodoc'];
        $numero =$_POST['numero'];
        $nombre =$_POST['nombre'];
        $apellido =$_POST['apellido'];
        $ciudad =$_POST['ciudad'];
        $email =$_POST['correo'];
        $user =$_POST['usuario'];
        $clave =$_POST['clave'];
        $rol =$_POST['rol'];
        $ubicacion =$_POST['ubicacion'];

   
        $query =mysqli_query($conection,"SELECT * FROM usuario
                                                    WHERE (usuario = '$user' AND idusuario != $idusuario) 
                                                    OR (correo ='$email' AND idusuario != $idusuario)");
                    

       
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_errror">El correo o el usuario ya existe.</p>';
        }else{
            if(empty($_POST['clave'])){
                $sql_update = mysqli_query($conection,"UPDATE usuario
                                                        SET tipodoc ='$tipodoc', numero ='$numero', nombre ='$nombre', apellido ='$apellido', ciudad ='$ciudad', correo='$email', usuario='$user', rol='$rol', ubicacion ='$ubicacion'
                                                        WHERE idusuario=$idusuario ");
            }else{
                $sql_update = mysqli_query($conection,"UPDATE usuario
                                                        SET tipodoc ='$tipodoc', numero ='$numero', nombre ='$nombre', apellido ='$apellido', ciudad ='$ciudad', correo='$email', usuario='$user', clave='$clave', rol='$rol', ubicacion='$ubicacion'
                                                        WHERE idusuario=$idusuario ");
            }
           
            if($sql_update){

                $alert='<p class="msg_save">Usuario actualizado  correctamente.</P>';
             }else{
                $alert='<p class="msg_error">Error al actualizar usuario.</P>';
             }
        }
    }
   
}
//mostrar datos 
if(empty($_GET['id'])){

    header('location: lista_usuarios.php');
    
}
$iduser = $_GET['id'];
$sql = mysqli_query($conection,"SELECT u.idusuario, u.tipodoc, u.numero, u.nombre, u.apellido, u.ciudad, u.correo, u.usuario, (u.rol), u.ubicacion as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario = $iduser");


$result_sql =mysqli_num_rows($sql);
if($result_sql == 0){

    header('location: lista_usuarios.php');
}else{
    $option ='';
    while($data = mysqli_fetch_array($sql)){
        # code...
        $iduser = $data['idusuario']; 
        $numero = $data['numero'];       
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $ciudad = $data['ciudad'];
        $correo = $data['correo'];
        $usuario = $data['usuario'];
        $idrol = $data['idrol'];
        $rol = $data['rol'];

        if($idrol == 1){
            $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }else if($idrol == 2){
            $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }else if($idrol == 3){
            $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
        }else if($idrol == 4){
            $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
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
	<title>Actualizar Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1>Actualizar Usuario</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

    <form action=" " method="post" >
        <input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
        <label for="tipodoc">Tipo Documento:</label>    
        <select  name="tipodoc" id="tipodoc" placeholder="tipo documento"> 
        <option value=1>Cedula Extranjera 
        <option value=2>cedula de Ciudadania 
        <option value=3>Tarjeta de Identidad
        </select>
        <label for="numero">Numero documento:</label>
        <input type="int" name="numero" id="numero" placeholder="Numero" value ="<?php echo $numero; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value ="<?php echo $nombre; ?>">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Apellido" value ="<?php echo $apellido; ?>">
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" value ="<?php echo $ciudad; ?>">
        <label for="correo">Correo Electronico:</label>
        <input type="email" name="correo" id="correo" placeholder="Correo electronico" value ="<?php echo $correo; ?>">
        <label for="Usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario" value ="<?php echo $usuario; ?>">
        <label for="clave">Clave:</label>
        <input type="pasord" name="clave" id="clave" placeholder="Clave de acceso">
        <label for="rol">Tipo de  usuario:</label>
        <?php 
        include "../conexion.php";
        $query_rol =mysqli_query($conection,"SELECT * FROM rol");
        mysqli_close($conection);
        $result_rol = mysqli_num_rows($query_rol);
        
        ?>
        
        <select name="rol" id="rol" class="notItemOne">
            <?php
            echo $option;
                 if($result_rol> 0)
                 {
                    while ($rol = mysqli_fetch_array($query_rol)){
        ?>
                    <option value="<?php echo $rol["idrol"];?>"><?php echo $rol["rol"] ?></option>
        <?php  
            # code...
                } 
            }
        ?>                        
        </select>
        <label for="ubicacion">Ubicacion:</label>
        <input type="int" name="ubicacion" id="ubicacion" placeholder="Ubicacion">
        
        <input type="submit" value="Actualizar Usuario" class="btn_save">
    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>