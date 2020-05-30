<?php

session_start();
error_reporting(0);
date_default_timezone_set('America/Bogota');

include("conexion.php"); 
	$tipo=$_POST['tipo_vehi'];
	$placa=$_POST['placa'];
	$marca=$_POST['marca'];
	setcookie("miCookie","$marca",time()+3600); 
	$color=$_POST['color'];
	$apartar=$_POST['apartar'];
	$timestamp = date("Y-m-d H:i:s");

	
	
	if ($apartar){

		$saldo = "SELECT `saldo_nuevo`  FROM `saldo` WHERE `usuario` = '".$_SESSION['Usuario']."'";
  		$saldo_array = mysqli_fetch_array($conexion->query($saldo));

  		if ($saldo_array[0] >= 1000){

  			$query="INSERT INTO vehiculos(`tipo`, `marca`, `placa`, `color`, `id_user`, `timestamp`)
			VALUES('$tipo','$marca','$placa','$color','".$_SESSION['Usuario']."','$timestamp')";
			$resultado2=$conexion->query($query);

			if($resultado2){

				$saldo_nuevo = $saldo_array[0] - 1000;

				$query2="UPDATE `saldo` SET `saldo_nuevo`= '".$saldo_nuevo."' WHERE `usuario` = '".$_SESSION['Usuario']."'";
				$update=$conexion->query($query2);

				?> <script type="text/javascript">
						if (confirm("Vehículo registrado")) {
		            		location.href = "index.php";
				        }
					</script>
				<?php
			}else{
				echo "Insercion no exitosa";
			}
  		} else {
  			?> <script type="text/javascript">
					if (confirm("Debe tener minimo 1000$ en saldo para poder apartar el vehículo")) {
	            		location.href = "index.php";
			        }
				</script>
			<?php
  		}

	} else {

		$query="INSERT INTO vehiculos(`tipo`, `marca`, `placa`, `color`, `id_user`, `timestamp`)
		VALUES('$tipo','$marca','$placa','$color','".$_SESSION['Usuario']."','$timestamp')";
		$resultado2=$conexion->query($query);

		if($resultado2){
			?> <script type="text/javascript">
					if (confirm("Vehículo registrado")) {
						
	            		location.href = "index.php";
			        }
				</script>
			<?php
		}else{
			echo "Insercion no exitosa";
		}
	}

?>