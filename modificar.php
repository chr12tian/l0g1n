<html>
	<head>
		<title>Modificar</title>
	</head>
	<body>
		<center>
	<?php
	include("conexion.php");

	session_start();
	error_reporting(0);

	if ($_GET['cod']){
		$query="SELECT * FROM vehiculos WHERE cod='".$_GET['cod']."'";
	} else {
		$query="SELECT * FROM vehiculos WHERE id_user='".$_SESSION['Usuario']."'";
	}

	$resultado=$conexion->query($query);

	$row=$resultado->fetch_assoc();

	?>
		<link href="login_1.css" rel="stylesheet" type="text/css">
		<form action="operacion_modificar.php?hola=''" method="POST">
		</br></br>
		<H3>Placa</H3>
			<input type="text" REQUIRED name="placa" placeholder=
		"Placa. . ." value="<?php echo $row['placa']; ?>"/> </br></br>
		<H3>Color</H3>
			<input type="text" REQUIRED name="color" placeholder=
		"Color. . ." value="<?php echo $row['color']; ?>"/> </br></br>
		<H3>Marca</H3>
			<input type="text" REQUIRED name="marca" placeholder="Marca. . ." value="<?php echo $row['marca']; ?>"/></br></br>
		<H3>Tipo</H3>
			<input type="text" REQUIRED name="tipo" placeholder="Tipo. . ." value="<?php echo $row['tipo']; ?>"/></br></br>
			<input type="hidden" name="admin" value="<?php echo $row['cod']; ?>"/></br></br>
			<input type="submit" value="Aceptar" />
		</form>
		</center>
	</body>
	
	</html>

	
