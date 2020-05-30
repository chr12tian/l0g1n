<?php
	include("conexion.php");
	set_time_limit(0);

	$query       = "SELECT * FROM `vehiculos`";
	$datos_query = $conexion->query($query);
	$dato_array  = mysqli_fetch_all($datos_query);

	if (count($dato_array) >= 1) {
		for ($i=0; $i < count($dato_array) ; $i++) { 
			$arr[] = $dato_array[$i];
		}
	} else {
		$arr[] = 0;
	}

	echo json_encode($arr);
	
?>