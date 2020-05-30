<?php

  include("conexion.php");
  error_reporting(0);

  session_start();

  $saldo = "SELECT `saldo_nuevo`,`saldo_ant` FROM `saldo` WHERE `usuario` = '".$_SESSION['Usuario']."'";
  $saldo_array = mysqli_fetch_array($conexion->query($saldo));

  $vehiculo = "SELECT `id_user` FROM `vehiculos` WHERE `id_user` = '".$_SESSION['Usuario']."'";
  $vehiculo_array = mysqli_fetch_array($conexion->query($vehiculo));


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
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
    <script language="javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
      
      var timestamp = null;
      function cargar_push() 
      { 
        $.ajax({
        async:  true, 
        type: "POST",
        url: "VehiculosReg.php",
        data: "&timestamp="+timestamp,
        dataType:"html",
        success: function(data)
        {

          data = eval("(" + data + ")");

          cuenta = data.cuenta;


          if (cuenta == null) {
            cuenta = 0;
          } else {
            $.ajax({
              async:  true, 
              type: "POST",
              dataType:"html",
              success: function(data)
              { 
                $('#cupo').html('Cupos '+ cuenta +'/30');
              }
            });
          }

          console.log(cuenta);
          setTimeout('cargar_push()',1000);
                
        }
        });
      }

      function mostrar() 
      {
        $.ajax({
        async:  true,
        type: "POST",
        url: "ConsulVehiReg.php",
        success: function(res)
        {
          $.ajax({
              async:  true, 
              type: "POST",
              dataType:"html",
              success: function(data)
              {
                var js = JSON.parse(res);
                var tabla;
                var total = 1;
                console.log(js);
                if (js == 0){
                  tabla = '<tr></tr>'
                } else {
                  for (var i = 0; i < js.length; i++) {
                      tabla+='<tr><th scope="row">'+total+'</th><td>'+js[i][3]+'</td><td>'+js[i][2]+'</td><td>'+js[i][4]+'</td><td>'+js[i][1]+'</td><td>'+js[i][6]+'</td><td><center><button onclick="confirmar('+js[i][0]+')" class="btn btn-primary btn-lg active" ><i class="fa fa-trash"></i></button></center></td><td><center><a href="modificar.php?cod='+js[i][0]+'" class="btn btn-primary btn-lg active" ><i class="fa fa-pencil"></i></a></center></td></tr>';
                      total ++;
                  }
                }
                  $('#tbody').html(tabla);
              }
            });
                setTimeout('mostrar()',1000);
          }
        });
      }

      $(document).ready(function() {
        mostrar();
        cargar_push();
      });

    </script>
    <link href="img/favicon.png" />
    <title>Parking Soft </title>
    
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
          <a class="btn btn-outline-primary" href="login.html">Registrarse</a>
        <?php } else { ?>
          <a class="btn btn-outline-primary" href="Logout.php">Cerrar sesion</a>
        <?php } ?> 
    </div>


 <!-- Carrusel -->
      <?php if (!$_SESSION['Tipo'] == 1  || !$_SESSION['Tipo'] == 2){ ?>
        <div id="demo" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/Carro1.jpg" alt="Los Angeles" style="width: 100%">
            </div>
            <div class="carousel-item">
              <img src="img/Carro2.jpg"  style="width: 100%">
            </div>
            <div class="carousel-item">
              <img src="img/Carro3.jpg" alt="New York" style="width: 100%">
            </div>
          </div>

          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
      <?php } ?>


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="page-header" id="cupo"></h1>
      <p class="lead">Parking Soft te ofrece una solución con el problema del parqueadero de la sede principal</p>
    </div>

    <?php if (!$_SESSION['Tipo'] == 1){ ?>
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="lead">Lo invitamos a registrarse o inicar sesion para poder tener los beneficios de registro</p>
        

    <div class="row">
                <div class="col-md-6">

                    <div class="portfolio-container">
                      <img src="img/11.jpg" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portfolio-container">
                        <img src="img/22.jpg" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portfolio-container">
                        <img src="img/33.jpg" class="img-fluid">
                    </div>
                </div>
                

            </div>

     



      
<div class="jumbotron">

                    <div >
                        <div class="card-header">
                            <div >
                                <h3 class="panel-body">APARTAR CUPO</h3>
                            </div>
                            <div class="panel-body">
                                ya sea para carro o para moto
                            </div>
                        </div>
                       
                    </div>
                    
                    <div >
                        <div class="card-header">
                            <div >
                                <h3 class="panel-body">INGRESAR SALDO</h3>
                            </div>
                            <div class="panel-body">
                                de una forma sencilla
                            </div>
                        </div>
                        
                    </div>
                    
                    <div >
                        <div class="card-header">
                            <div >
                                <h3 class="panel-body">VALIDAR CUPOS DISPONIBLES</h3>
                            </div>
                            <div class="panel-body">
                                en tiempo real
                            </div>
                        </div>
                        
                    </div>

  
 </div>



    <?php } ?>

    <div class="container">

      <!-- Registro vehiculo -->
      <?php if ($_SESSION['Tipo'] == 1){ ?>
        <div class="card-deck mb-3 text-center">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <?php 
                if (!$vehiculo_array) { ?>
                  <h4 class="my-0 font-weight-normal">Registrar vehículo</h4>
              <?php
                } else { ?>
                  <h4 class="my-0 font-weight-normal">Modificar vehículo</h4>
              <?php
                }
              ?>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Tarifa actual: <small class="text-muted"> 1000 $ </small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Min: 100 $</li>
                <li>Hora: 5.000 $</li>
                <li>Dia: 100.000 $</li>
              </ul>
              <?php 
                if (!$vehiculo_array) { ?>
                  <a href="reg_vehiculo.php"><button type="button" class="btn btn-lg btn-block btn-primary">Apartar vehículo</button></a>
              <?php
                } else { ?>
                  <a href="modificar.php"><button type="button" class="btn btn-lg btn-block btn-primary">Modificar vehículo</button></a>
              <?php
                }
              ?>
            </div>
          </div>
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Cargar saldo</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Saldo actual: <small class="text-muted"> <br> <?php echo $saldo_array[0]; ?> $ </small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Saldo cargado previamente: <?php echo $saldo_array[1]; ?> </li>
                <li>Correo: <?php echo $_SESSION['Correo']; ?></li>
                <li>Nombre: <?php echo $_SESSION['Nombre']. " ". $_SESSION['Apellido']; ?></li>
              </ul>
              <a href="c_saldo.php"><button type="button" class="btn btn-lg btn-block btn-primary">Cargar saldo</button></a>
            </div>
          </div>
        </div>
      <?php } ?>

     



      <!-- Admin -->
      <?php if ($_SESSION['Tipo'] == 2){ ?>
        <table class="table" id="tabla">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Placa</th>
              <th scope="col">Marca</th>
              <th scope="col">Color</th>
              <th scope="col">Tipo</th>
              <th scope="col">Time</th>
              <th scope="col">Retirar</th>
              <th scope="col">modificar</th>
            </tr>
          </thead>
          <tbody id="tbody">
          </tbody>
        </table>
        <br>
        <a href="reg_vehiculo.php"><button type="button" class="btn btn-lg btn-block btn-primary">Agregar vehículo</button></a>
      <?php } ?>


 
      



     <footer class="panel panel-yellow">
        <div class="card-footer bg-primary text-center">
            <ul >
                <li class="list-inline-item footer-menu"><a>PARKING SOFT</a></li>
            </ul>
            <ul>
                <li class="list-inline-item"><a href="#"><img src="img/instagram.svg" ></a></li>
                <li class="list-inline-item"><a href="#"><img src="img/twitter.svg" ></a></li>
                <li class="list-inline-item"><a href="#"><img src="img/youtube.svg" ></a></li>
                <li class="list-inline-item"><a href="#"><img src="img/facebook.svg" ></a></li>
            </ul>
            <small>©2020 All Rights Reserved. Created by CHRISTIAN ACOSTA NARVAEZ</a></small>
            
            
        </div>
       
    </footer>



    </div>
  </body>
  <script type="text/javascript">

    function caseDelet(caso) {
        if (caso!="") {
            $.ajax({
                cache: false,
                type: "POST",
                dataType: "json",
                url: "eliminarve.php",
                data: {"cod": caso},
                success: function(response) {
                            alertify.alert("Notificación","Vehículo eliminado correctamente"
                          );
                },
                error: function() {
                    alertify.alert("¡Problemas al eliminar el vehículo verifique y vuelva a intentarlo!");
                }
            });
        }
    }
    
    function confirmar(numero) {
      alertify.confirm("Retirar vehículo","¿Está seguro que desea retirar el vehículo?", function() {
        caseDelet(numero);
        alertify.success("Ha pulsado Aceptar", 1.9);
      }, function() {
        alertify.error("Ha pulsado Cancelar", 1.9);
      });
    }

  </script>
</html>

