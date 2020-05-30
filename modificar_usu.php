<?php

  include("conexion.php");
  error_reporting(0);

  session_start();

  $vehiculo = "SELECT `id_user` FROM `vehiculos` WHERE `id_user` = '".$_SESSION['Usuario']."'";
  $vehiculo_array = mysqli_fetch_array($conexion->query($vehiculo));

  $usuarios = "SELECT * FROM `usuario`";
  $usuarios_array = mysqli_fetch_all($conexion->query($usuarios));

  $total = 1;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Parking Soft</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="alertify/css/alertify.css">
  <script type="text/javascript" src="alertify/alertify.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script language="javascript" src="jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Parking Soft</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="index.php">Inicio</a>
      <?php if ($_SESSION['Tipo'] == 1 || $_SESSION['Tipo'] == 2 ){ 
              if ($vehiculo_array){ ?>
                <a class="p-2 text-dark" href="reg_vehiculo.php">Registrar vehículo</a>
              <?php } else if ($_SESSION['Tipo'] != 2) { ?>
                <a class="p-2 text-dark" href="modificar.php">Modificar vehículo</a>
              <?php } else if ($_SESSION['Tipo'] != 2) { ?>
                <a class="p-2 text-dark" href="c_saldo.php">Cargar saldo</a>
      <?php }} ?>
      <?php if ($_SESSION['Tipo'] == 2) { ?>
                <a class="p-2 text-dark" href="modificar_usu.php">Modificar usuarios</a>
      <?php } ?>
    </nav>
      <?php if (!$_SESSION['Tipo'] == 1 || !$_SESSION['Tipo'] == 2 ){ ?>
        <a class="btn btn-outline-primary" href="login_1.html">Ingresar</a>
      <?php } else { ?>
        <a class="btn btn-outline-primary" href="Logout.php">Cerrar sesion</a>
      <?php } ?> 
  </div>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4" id="cupo"></h1>
      <p class="lead">Tabla de usuarios</p>
  </div>
  <div class="container">
    <table class="table" id="tabla">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Correo</th>
          <th scope="col">Telefono</th>
          <th scope="col">User</th>
          <th scope="col">Pass</th>
          <th scope="col">Tipo</th>
          <th scope="col">Modificar</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i=0; $i < count($usuarios_array) ; $i++) { ?>
          <tr>
            <th scope="row"><?php echo $total;     ?></th>
            <td><?php echo $usuarios_array[$i][1]; ?></td>
            <td><?php echo $usuarios_array[$i][2]; ?></td>
            <td><?php echo $usuarios_array[$i][4]; ?></td>
            <td><?php echo $usuarios_array[$i][5]; ?></td>
            <td><?php echo $usuarios_array[$i][6]; ?></td>
            <td><?php echo $usuarios_array[$i][7]; ?></td>
            <td><?php echo $usuarios_array[$i][8]; ?></td>
            <td><center><a href="operacion_modificar_usu.php?id='<?php echo $usuarios_array[$i][0] ?>'" class="btn btn-primary btn-lg active" ><i class="fa fa-pencil"></i></a></center></td>
          </tr>
        <?php $total++; } ?>
      </tbody>
    </table>
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <h3 class="display-4">Parking Soft</h3>
        <h6>Todos los derechos reservados ©</h6>
    </footer> 
  </div>
</body>
</html>