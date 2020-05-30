<?php
	include("conexion.php");

	session_start();
	error_reporting(0);

	$Nombre=$_POST['Nombre'];
	$Apellido=$_POST['Apellido'];
	$Correo=$_POST['Correo'];
	$Telefono=$_POST['Telefono'];
	$Usuario=$_POST['Usuario'];
	$Contrasena=$_POST['Contrasena'];
	$Tipo=$_POST['Tipo'];
	$admin=$_POST['admin'];

	$query = "UPDATE `usuario` SET `nombre`='$Nombre',`apellido`='$Apellido',`correo`='$Correo',`telefono`='$Telefono',`user`='$Usuario',`password`='$Contrasena',`tipo`='$Tipo' WHERE `Id` = '$admin'";

	$resultado=$conexion->query($query);
	
	if($resultado){
		?> <script type="text/javascript">
				if (confirm("Usuario modificado")) {
            		location.href = "modificar_usu.php";
		        }
			</script>
		<?php
	}else{
		echo "Inserción no exitosa";
	}
	
	?>