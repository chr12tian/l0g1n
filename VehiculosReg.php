<?php
	include("conexion.php");
	set_time_limit(0);

	$query       = "SELECT COUNT('cod') AS cuenta FROM `vehiculos`";
	$datos_query = $conexion->query($query);
	while($row = mysqli_fetch_array($datos_query))
	{	
		$ar["cuenta"] 	 		  = $row['cuenta'];
	}
	$dato_json   = json_encode($ar);
	echo $dato_json;
?>