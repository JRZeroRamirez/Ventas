<?php
$alert ='';
// Reconocimiento de  rol
session_start();
if(!empty($_SESSION['active']))
{
    header('location: sistema/');
}else{

if(!empty($_POST)){
    if(empty($_POST['usuario']) || empty($_POST['clave']))
    {
        $alert = 'Ingrese su usuario y su clave';

    }else{
        require_once"conexion.php";
        $user= $_POST['usuario'];
        $pass =$_POST['clave'];
// conexion base de datos  
        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if($result > 0)
        {
            //compáracion y llamado de datos del usuario que ingreso 
            $data = mysqli_fetch_array($query);
            print_r($data);            
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data['idusuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['user'] = $data['usuario'];
            $_SESSION['rol'] = $data['rol'];

            header('location: sistema/');
        }else{
            $alert = 'El usuario o la clave  es incorrecto';
            session_destroy();
        }

    }
}
}
?>
<!--  visualizacion de  login  interface ususario -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Ventas</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<section id="container">
<form action="" method="post">
<h3>iniciar sesion </h3>
<img src="img/logoA.png" alt="login">

<input type ="text" name="usuario" placeholder="Usuario">
<input type ="password" name="clave" placeholder="Contraseña">
<div class="alert"><?php echo isset($alert)? $alert:'';?></div>  
<input type ="submit" value="Ingresar">

</form>

</section>

</body>

</html>