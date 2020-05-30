<html>
	<head>
		<title>Modificar</title>
	</head>
	<body>
		<center>
	<?php
	include("conexion.php");

	session_start();
	// error_reporting(0);

	$query="SELECT * FROM `usuario` WHERE Id=".$_GET['id']."";

	$resultado=$conexion->query($query);

	$row=$resultado->fetch_assoc();

	?>
		<link href="login_1.css" rel="stylesheet" type="text/css">
		<form action="operacion_modificar_usuario.php?hola=''" method="POST">
		</br></br>
		<H3>Nombre</H3>
			<input type="text" REQUIRED name="Nombre" placeholder=
		"Nombre. . ." value="<?php echo $row['nombre']; ?>"/> </br></br>
		<H3>Apellido</H3>
			<input type="text" REQUIRED name="Apellido" placeholder=
		"Apellido. . ." value="<?php echo $row['apellido']; ?>"/> </br></br>
		<H3>Correo</H3>
			<input type="text" REQUIRED name="Correo" placeholder="Correo. . ." value="<?php echo $row['correo']; ?>"/></br></br>
		<H3>Telefono</H3>
			<input type="text" REQUIRED name="Telefono" placeholder="Telefono. . ." value="<?php echo $row['telefono']; ?>"/></br></br>
		<H3>Usuario</H3>
			<input type="text" REQUIRED name="Usuario" placeholder="Usuario. . ." value="<?php echo $row['user']; ?>"/></br></br>
		<H3>Contraseña</H3>
			<input type="text" REQUIRED name="Contrasena" placeholder="Contraseña. . ." value="<?php echo $row['password']; ?>"/></br></br>
		<H3>Tipo usuario</H3>
			<input type="text" REQUIRED name="Tipo" placeholder="Tipo. . ." value="<?php echo $row['tipo']; ?>"/></br></br>
			<input type="hidden" name="admin" value="<?php echo $row['Id']; ?>"/></br></br>
			<input type="submit" value="Aceptar" />
		</form>
		</center>
	</body>
	
	</html>

	
