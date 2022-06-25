<?php include('../templates/header.html');   ?>

<body>
<br>
<h3 align="center"><b>ADMIN</b></h3>
<br>

<form class="form-signin" role="form" action="../views/propuestas_pendientes.php" method="post">
  <button  type="submit" name="login" class="button is-info is-fullwidth"> Ver Propuestas Pendientes </button>
</form>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT propuestas.id, propuestas.fecha_envio_propuesta, informacion_de_vuelo.fecha_salida, informacion_de_vuelo.fecha_llegada, informacion_de_vuelo.codigo, fpl.tipo_vuelo, fpl.max_pasajeros, fpl.velocidad, fpl.altitud, fpl.realizado, informacion_de_vuelo.estado FROM informacion_de_vuelo, fpl, propuestas WHERE fpl.fpl_propuestas = propuestas.fpl_propuestas AND propuestas.id = informacion_de_vuelo.informacion_id;";

  $result = $db2 -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
?>

<br>
<br>
<h3 align="center"><b>Lista de Propuestas de Vuelos</b></h3>
<br>
<table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light' align="center">
  <tr>
    <th>Propuesta ID</th>
    <th>Fecha Envio Propuesta</th>
    <th>Fecha Salida</th>
    <th>Fecha Llegada</th>
    <th>Codigo</th>
    <th>Tipo Vuelo</th>
    <th>Maximo Pasajeros</th>
    <th>Velocidad</th>
    <th>Altitud</th>
    <th>¿Es realizado?</th>
    <th>Estado</th>
  </tr>
    <?php
      // echo $resultado;
      foreach ($resultado as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td></tr>";
    }
    ?>
</table>

<?php include('../templates/footer.html'); ?>