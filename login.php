<?php


include("conexion.php");
	error_reporting(0);

$nomb = $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

$query = "SELECT * FROM usuario WHERE user = '".$nomb."' and password = '".$pass."'";
$datos_query = $conexion->query($query);
$nr = mysqli_fetch_array($datos_query);

if(count($nr) >= 1)
{
	// echo "Bienvenido";
	session_start();
	$_SESSION['Nombre'] = $nr['nombre'];
	$_SESSION['Apellido'] = $nr['apellido'];
	$_SESSION['Correo'] = $nr['correo'];
	$_SESSION['Usuario'] = $nr['user'];
	$_SESSION['Tipo'] = $nr['tipo'];

	header("Location: index.php");

}
else if (count($nr) == 0) 
{
	?> <script type="text/javascript">
			if (confirm("Usuario o contraseña incorrecta")) {
        		location.href = "index.php";
	        }
		</script>
	<?php 
}
	


?>