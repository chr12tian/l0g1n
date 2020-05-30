<?php

include("conexion.php");
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$nomb = $_POST["txtusuario"];
	$pass = $_POST["txtpassword"];

	
	$query="INSERT INTO usuario(nombre, apellido, correo, telefono, user, password, tipo)
			VALUES('$nombre','$apellido','$correo','$telefono','$nomb','$pass','1')";
	$resultado=$conexion->query($query);
	
	if($resultado){

		?> <script type="text/javascript">
				if (confirm("Usuario registrado")) {
            		location.href = "index.php";
		        }
			</script>
		<?php
		
	}else{
		echo "Insercion no exitosa";
	}
	?>