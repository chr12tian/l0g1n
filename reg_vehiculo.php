<?php
	
	session_start();
	error_reporting(0);

?>
<!DOCTYPE html>
<html>
<head>
	<link href="login_1.css" rel="stylesheet" type="text/css">
<title>Guardar</title>
</head>
<center>
	<div class="wrapper fadeInDown">
		<div id="formContent">
<form action="operacion_guardar_vehi.php" method="POST">
</br></br>
<input type="text" REQUIRED name="placa" placeholder="Placa..." value=""/> </br></br>
<input type="text" REQUIRED name="marca" placeholder="Marca..." value=""/> </br></br>
<input type="text" REQUIRED name="color" placeholder="Color..." value=""/> </br></br>
<?php

	if($_SESSION['Tipo'] == 1){
		?> <input type="hidden" REQUIRED name="apartar" value="Apartar vehiculo"/> </br></br> <?php
	}

?>

<h5> Tipo De Vehiculo </h5> 
	<select name="tipo_vehi" >
		<option value="carro">CARRO</option>
		<option value="moto">MOTO</option>
	</select>
<br><br>
      
<input type="submit" value="Aceptar"/> 

</form>
</div>
</div>
</center>
</body>
</html>