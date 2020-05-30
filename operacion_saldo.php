<?php

	include("conexion.php");

	session_start();

	$saldo = "SELECT `saldo_nuevo` FROM `saldo` WHERE `usuario` = '".$_SESSION['Usuario']."'";
  	$saldo_array = mysqli_fetch_array($conexion->query($saldo));

	$saldo=$_POST['saldo']+$saldo_array[0];
	$saldo_ant=$saldo_array[0];


	$query="UPDATE `saldo` SET `saldo_nuevo`= '$saldo',`saldo_ant`= '$saldo_ant' WHERE `usuario` = '".$_SESSION['Usuario']."'";
	
	$resultado2=$conexion->query($query);
	
	if($resultado2){
		?> <script type="text/javascript">
				if (confirm("Saldo cargado correctamente")) {
            		location.href = "index.php";
		        }
			</script>
		<?php
	}else{
		echo "Insercion no exitosa";
	}
	?>