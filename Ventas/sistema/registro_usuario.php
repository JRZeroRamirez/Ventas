<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABYgrjjWF2DguLy9LWp58DvTJfJK3sU84&callback=initMap"></script>

<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}


include "../conexion.php";


if(!empty($_POST)){

//conexion BD y almacenado de datos  de los usuarios registrados
    $alert='';
    if(empty($_POST['tipodoc']) || empty($_POST['numero']) || empty($_POST['nombre'])  || empty($_POST['apellido']) ||
       empty($_POST['ciudad'])  || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) ||
       empty($_POST['rol']) || empty($_POST['ubicacion']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{    

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
       
       $query =mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo ='$email'");
       
       $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_errror">El correo o el usuario ya existe.</p>';
        }else{
            $query_insert =mysqli_query($conection,"INSERT INTO usuario (tipodoc, numero, nombre, apellido, ciudad, correo, usuario, clave, rol, ubicacion)
                                                                VALUES ('$tipodoc','$numero','$nombre','$apellido','$ciudad','$email','$user','$clave','$rol','$ubicacion')");

             if($query_insert){

                $alert='<p class="msg_save">Usuario creado correctamente.</P>';
             }else{
                $alert='<p class="msg_error">Error al crear usuario.</P>';
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
	<title>Registro Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1>Registro Usuario</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

<!--formulario de registro usuarios y tipo de usuarios -->
    <form action=" " method="post" >
        <label for="tipodoc">Tipo Documento:</label>    
        <select  name="tipodoc" id="tipodoc" placeholder="tipo documento"> 
        <option value=1>Cedula Extranjera 
        <option value=2>Cedula de Ciudadania 
        <option value=3>Tarjeta de Identidad
        </select>
        <label for="numero">Numero documento:</label>
        <input type="int" name="numero" id="numero" placeholder="Numero">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Apellido">
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad">
        <label for="correo">Correo Electronico:</label>
        <input type="email" name="correo" id="correo" placeholder="Correo electronico">
        <label for="Usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario">
        <label for="clave">Clave:</label>
        <input type="pasord" name="clave" id="clave" placeholder="Clave de acceso">
       <!--validacion de  rol-->
        <label for="rol">Tipo de  usuario:</label>
        <?php         
        $query_rol =mysqli_query($conection,"SELECT * FROM rol");
        mysqli_close($conection);
        $result_rol = mysqli_num_rows($query_rol);
        ?>
            <select name="rol" id="rol">
            <?php
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
        <label for="ubicacion">ubicacion:</label>
        <input type="int" name="ubicacion" id="ubicacion" placeholder="Ubicacion">
        <!--

                <label for="ubicacion">Oprima el boton para obtener sus coordenandas: </label>
                <button type="button" name="ubicacion" id="ubicacion" onclick="getLocation()">Buscar</button>                
                <p id="ubicacion"></p>
                <script>
                var x = document.getElementById("ubicacion");
                function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    x.innerHTML = "Geolocation No es soportrada en su Buscador.";
                }
                }
                function showPosition(position) {
                    
                x.innerHTML = "Latitud: " + position.coords.latitude + 
                "<br>Longitud: " + position.coords.longitude;
                }  
                </script>
              
                -->

        <!-- generar ubicacion maps-->  
        <!--        
        <section class="col-lg-12 connectedSortable">
        <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-codigo">
            Ubicacion
            </h3>
            <button class="btn btn-block btn-primary" id="find_btn" type="button">
                Ubicar mi posición
            </button>
        </div>
        <div class="box-body">
            <div class="">
                <div id="floating-panel">
                </div>
                <div id="map">
                </div>
            </div>
            </div>
            </div>
        </section>
        <style>
            #map {
       height: 100%;
             }
            html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            var map;
            function geocodeLatLng(geocoder, map, infowindow) {
                var input = document.getElementById('latlng').value;
                var latlngStr = input.split(',', 2);
            }
            var nuevosarboles = [0.0,0.0];
            function aaa() {
                alert("si paso");
                mgr.clearMarkers();
            }
            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
            function initMap(){
                var options = {
                zoom:16,
                center:{lat:4.302314898662877,lng:-74.80926649120488}
            }
            // New map
            map = new google.maps.Map(document.getElementById('map'), options);
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

        $("#find_btn").click(function (){
                if("geolocation" in navigator){
                    navigator.geolocation.getCurrentPosition(function(position){ 
                        infoWindow = new google.maps.InfoWindow({map: map});
                        var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
                        infoWindow.setPosition(pos);
                        map.setZoom(19);
                        infoWindow.setContent("Localización del usuario <br/>"+
                            "@can('Arboles Add')"+
                            "<a class='massmodal btn btn-success' href='#' id='massadd-modal' <span class='glyphicon glyphicon-eye-open'></span>Añadir Ubicacion</a>"+
                            "@endcan"+
                            //"Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude
                            "");
                        //obtener el latitud y logitud 
                        $('#latitud_mass').val(position.coords.latitude);
                        $('#longitud_mass').val(position.coords.longitude);
                        map.panTo(pos);
                    // MostrarsitiosCercanos(position.coords.latitude,position.coords.longitude);
                    });
                }else{
                    console.log("Su navegador no soporta la Geo-localización ");
                }
        });
        }
        </script>

        <style>
            #map {
            height: 100%;
            }
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
        <!--guardar api generada de goole --><!--
        <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABYgrjjWF2DguLy9LWp58DvTJfJK3sU84&callback=initMap"></script>             
             --> 
       <input type="submit" value="Crear Usuario" class="btn_save">
    </form>

</div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>