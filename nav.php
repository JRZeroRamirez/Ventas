<nav>
			<ul>
				<li><a href="#">Inicio</a></li>
				
					<?php 
					//rol 1 
					if($_SESSION['rol'] == 1){

					?>
					<!-- modulos -->
					<li class="principal">
					<a href="#">Usuarios</a>
					<ul>
					
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
				//ROL1
					if($_SESSION['rol'] == 1){

					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Productos</a>
					<ul>					
						<li><a href="registro_producto.php">Nuevo Producto</a></li>
						<li><a href="lista_producto.php">Lista de Productos</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
				//ROL1
					if($_SESSION['rol'] == 1){

					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Ventas</a>
					<ul>					
						<li><a href="nueva_venta.php">Nueva venta</a></li>
						<li><a href="lista_ventas.php">Lista de Ventas</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
				//ROL1
					if($_SESSION['rol'] == 1){

					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Informes</a>
					<ul>					
						<li><a href="informe_clientes.php">informe clientes</a></li>
						<li><a href="informe_ventas.php">infiorme de Ventas</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
				//ROL 2
					if($_SESSION['rol'] == 2){
						
					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Productos</a>
					<ul>
						<li><a href="registro_producto.php">Nuevo Producto</a></li>
						<li><a href="lista_producto.php">Lista de Productos</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
				//ROL3
					if($_SESSION['rol'] == 3){

					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Productos</a>
					<ul>					
					<li><a href="lista_producto.php">Lista de Productos</a></li>						
					</ul>
				</li>
				<?php } ?>		
				<?php 
				//ROL3
					if($_SESSION['rol'] == 3){

					?>
					<!-- modulos -->
				<li class="principal">
					<a href="#">Ventas</a>
					<ul>					
						<li><a href="nueva_venta.php">Nueva venta</a></li>						
					</ul>
				</li>
				<?php } ?>			
			
				
		</nav>