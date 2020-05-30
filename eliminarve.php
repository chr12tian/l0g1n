<?php
	include("conexion.php");
	set_time_limit(0);

	$caso = $_POST["cod"];

	$query       = "DELETE FROM `vehiculos` WHERE `cod` = '".$caso."'";
	$datos_query = $conexion->query($query);

	if ($datos_query) {
        $salidaJson = array("respuesta" => "done",
                            "mensaje"   => "",
                            "contenido" => "");
    }

	echo json_encode($salidaJson);
	
?>