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
		<h1>Informe ventas</h1>

        <div class="one"> 
        <?php

        // consultar registros       
        
        if($consulta =$conection->query("SELECT * FROM venta ")){

        $row_cnt=$consulta->num_rows;

        echo '<h1 align="center"> <font color="Blue" face="arial"> Ventas Generadas :';echo "<br>".$row_cnt.'';   
        }
        
        ?>
        <br><br>
         <?php
          // consultar registros                
      $sql="SELECT fecha FROM venta WHERE codventa=1 ";

      $resultado = mysqli_query( $conection, $sql);
      while($fila=mysqli_fetch_assoc($resultado)){
        echo '<h1 align="center"> <font color="Black" face="arial"> fecha de venta <br>';
        echo $fila['fecha'];
      }
      mysqli_free_result($resultado);         

          ?>
<br><br>
      <?php
          // consultar registros                
      $sql="SELECT valor FROM venta  WHERE codventa=1";

      $resultado = mysqli_query( $conection, $sql);
      while($fila=mysqli_fetch_assoc($resultado)){
        echo '<h1 align="center"> <font color="Black" face="arial"> Valor venta <br>';
        echo $fila['valor'];
      }
      mysqli_free_result($resultado);         

          ?>

        </div>
       
	</section>
 

	<?php include "includes/footer.php"; ?>
</body>
</html>