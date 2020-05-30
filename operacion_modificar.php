<?php
	include("conexion.php");

	session_start();
	error_reporting(0);

	$placa=$_POST['placa'];
	$color=$_POST['color'];
	$marca=$_POST['marca'];
	$tipo=$_POST['tipo'];
	$admin=$_POST['admin'];

	if ($admin){
		$query="UPDATE vehiculos SET placa='$placa',color='$color',marca='$marca',tipo='$tipo' WHERE cod='".$admin."'";
	} else {
		$query="UPDATE vehiculos SET placa='$placa',color='$color',marca='$marca',tipo='$tipo' WHERE id_user='".$_SESSION['Usuario']."'";
	}

	$resultado=$conexion->query($query);
	
	if($resultado){
		?> <script type="text/javascript">
				if (confirm("Vehiculo modificado")) {
            		location.href = "index.php";
		        }
			</script>
		<?php
	}else{
		echo "Inserción no exitosa";
	}
	
	?>