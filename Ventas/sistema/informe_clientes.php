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

	<title>Sistema Productos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Informe Clientes</h1>
        <br><br>
        <div class="one"> 
        <?php

        // consultar registros  clientes       
        
        if($consulta =$conection->query("SELECT * FROM usuario")){

        $row_cnt=$consulta->num_rows;

        echo '<h1 align="center"> <font color="Blue" face="arial"> Usuarios:';echo "<br>".$row_cnt.'';   
        }
        
        ?>
         <br><br>
        
        <?php
        // consultar registros productos      
        
        if($consulta =$conection->query("SELECT * FROM producto")){

        $row_cnt=$consulta->num_rows;

        echo '<h1 align="center"> <font color="Red" face="arial"> Productos:';echo "<br>".$row_cnt.'';   
        }        
        ?>

        <br><br>
      <?php
          // consultar registros                
      $sql="SELECT nombre, ubicacion FROM usuario WHERE idusuario = 2 ";

      $resultado = mysqli_query( $conection, $sql);
      while($fila=mysqli_fetch_assoc($resultado)){
        echo '<h1 align="center"> <font color="Black" face="arial"> Ubicacion del usuario <br>';
        echo $fila['nombre'];echo '----'; echo $fila['ubicacion'];
      }
      mysqli_free_result($resultado);         

          ?>

        </div>

	</section>
 

	<?php include "includes/footer.php"; ?>
</body>
</html>


