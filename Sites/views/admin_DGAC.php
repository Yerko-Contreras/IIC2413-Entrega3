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
  $query = "SELECT propuestas.informacion_id, propuestas.propuesta_vuelo_id, propuestas.codigo_compania, informacion_de_vuelo.codigo, informacion_de_vuelo.codigo_aeronave,informacion_de_vuelo.aerodromo_id_sal, informacion_de_vuelo.aerodromo_id_lle, propuestas.fecha_envio_propuesta, informacion_de_vuelo.fecha_salida, informacion_de_vuelo.fecha_llegada, fpl.pasaporte, fpl.tipo_vuelo, fpl.max_pasajeros, fpl.velocidad, fpl.altitud, fpl.realizado, informacion_de_vuelo.estado FROM informacion_de_vuelo, fpl, propuestas WHERE fpl.informacion_id = propuestas.informacion_id AND propuestas.informacion_id = informacion_de_vuelo.informacion_id;";

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
    <th>Informacion ID</th>
    <th>Propuesta vuelo ID</th>
    <th>Codigo de compañia</th>
    <th>Codigo de vuelo</th>
    <th>Codigo de aeronave</th>
    <th>Aerodromo ID salida</th>
    <th>Aerodromo ID llegada</th>
    <th>Fecha envio de propuesta</th>
    <th>Fecha de salida</th>
    <th>Fecha de llegada</th>
    <th>Pasaporte</th>
    <th>Tipo de vuelo</th>
    <th>Maximo de pasajeros</th>
    <th>Velocidad</th>
    <th>Altitud</th>
    <th>¿Es realizado?</th>
    <th>Estado</th>
  </tr>
    <?php
      // echo $resultado;
      foreach ($resultado as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td><td>$p[12]</td><td>$p[13]</td><td>$p[14]</td><td>$p[15]</td><td>$p[16]</td></tr>";
    }
    ?>
</table>

<?php include('../templates/footer.html'); ?>