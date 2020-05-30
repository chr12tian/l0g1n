<?php
  include("conexion.php");
  session_start();

  $saldo = "SELECT `saldo_nuevo` FROM `saldo` WHERE `usuario` = '".$_SESSION['Usuario']."'";
  $saldo_array = mysqli_fetch_array($conexion->query($saldo));
  
?>

<div class="wrapper fadeInDown">
    <link href="login_1.css" rel="stylesheet" type="text/css">
  <div id="formContent">
    <h2>CARGAR SALDO </h2>

    <form method="post" action="operacion_saldo.php">

      <input type="text" REQUIRED name="saldo" placeholder="$..." value=""/> </br></br>
      <h3>Saldo Actual<input type="text" name="saldoant" disabled value="<?php echo "$ ".$saldo_array[0]; ?>"></h3>

      <input type="submit" class="fadeIn fourth" value="CARGAR">

    </form>
  </div>
</div>