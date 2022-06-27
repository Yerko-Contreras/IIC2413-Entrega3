<?php include('../templates/header.html');   ?>
<body> 
<br>
<h3 align="center"><b>ADMIN</b></h3>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");
  #Se construye la consulta como un string
  $query = "SELECT propuestas.propuesta_vuelo_id, propuestas.codigo_compania, informacion_de_vuelo.codigo, informacion_de_vuelo.codigo_aeronave,informacion_de_vuelo.aerodromo_id_sal, informacion_de_vuelo.aerodromo_id_lle, propuestas.fecha_envio_propuesta, informacion_de_vuelo.fecha_salida, informacion_de_vuelo.fecha_llegada, fpl.tipo_vuelo, informacion_de_vuelo.estado FROM informacion_de_vuelo, fpl, propuestas WHERE fpl.informacion_id = propuestas.informacion_id AND propuestas.informacion_id = informacion_de_vuelo.informacion_id AND informacion_de_vuelo.estado = 'pendiente';";
  $result = $db2 -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
<br>
<h3 align="center"><b>Lista de Vuelos Pendientes</b></h3>
<br>
  <table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light' align="center">
    <tr>
      <th>Propuesta vuelo ID</th>
      <th>Codigo de compañia</th>
      <th>Codigo de vuelo</th>
      <th>Codigo de aeronave</th>
      <th>Aerodromo ID salida</th>
      <th>Aerodromo ID llegada</th>
      <th>Fecha envio de propuesta</th>
      <th>Fecha de salida</th>
      <th>Fecha de llegada</th>
      <th>Tipo de vuelo</th>
      <th>Estado</th>
      <th>Aceptar</th>
      <th>Rechazar</th>
    </tr>
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td>";
          
          echo "<td><form method='POST' action='prop_exec.php'>";
          echo "<input type='hidden' name='codigo' value='$p[2]'>";
          echo "<input type='submit' name='update' value='aceptar'/>";
          echo "</form></td>";
          echo "<td><form method='POST' action='prop_exec.php'>";
          echo "<input type='hidden' name='codigo' value='$p[2]'>";
          echo "<input type='submit' name='update2' value='rechazar'/>";
          echo "</form></td>";
          
          echo "</tr>";
      }
      ?> 
  </table>

<br>
<h3 align="center"><b>Filtrar por Fecha las Propuestas de Vuelos Pendientes</b></h3>
<br>
  <?php
  #OBTENGO TODAS LAS FECHAS
  require("../config/conection.php");
  $result = $db2 -> prepare("SELECT fecha_salida DISTINCT, fecha_llegada DISTINCT FROM informacion_de_vuelo ORDER BY fecha_salida, fecha_llegada;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>
  <form align="center" method="post">
  <b>Seleccionar Fechas:</b>
    <br>
    Fecha Inicio/Salida:

    <select name="inicio">
      <?php
      #INICIO -Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value='$d[0]'>'$d[0]'</option>";
      }
      ?>
    </select>

    <br/>
    Fecha Final/Llegada:

    <select name="final">
      <?php
      #FINAL - Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[1]>$d[1]</option>";
      }
      ?>
    </select>

    <br/><br/>
    <input type='submit' value='Buscar fechas' name='fechas'>
  </form>
<br>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");
 if (isset($_POST['inicio']) && isset($_POST['final'])){
  $inicio = $_POST['inicio'];
  $final = $_POST['final'];

  $query2 = "SELECT propuestas.propuesta_vuelo_id, propuestas.codigo_compania, informacion_de_vuelo.codigo, informacion_de_vuelo.codigo_aeronave,informacion_de_vuelo.aerodromo_id_sal, informacion_de_vuelo.aerodromo_id_lle, propuestas.fecha_envio_propuesta, informacion_de_vuelo.fecha_salida, informacion_de_vuelo.fecha_llegada, fpl.tipo_vuelo, informacion_de_vuelo.estado FROM informacion_de_vuelo, fpl, propuestas WHERE fpl.informacion_id = propuestas.informacion_id AND propuestas.informacion_id = informacion_de_vuelo.informacion_id AND informacion_de_vuelo.estado = 'pendiente' AND CAST(fecha_salida AS date) >= CAST('$inicio' AS date) AND CAST(fecha_salida AS date) <= CAST('$final' AS date) AND CAST(fecha_llegada AS date) >= CAST('$inicio' AS date) AND CAST(fecha_llegada AS date) <= CAST('$final' AS date);";
	$result = $db2 -> prepare($query2);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
  <h3 align="center"><b>Vuelos Pendientes</b></h3>
  <br>
	<table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light' align="center">
  <tr>
    <th>Propuesta vuelo ID</th>
    <th>Codigo de compañia</th>
    <th>Codigo de vuelo</th>
    <th>Codigo de aeronave</th>
    <th>Aerodromo ID salida</th>
    <th>Aerodromo ID llegada</th>
    <th>Fecha envio de propuesta</th>
    <th>Fecha de salida</th>
    <th>Fecha de llegada</th>
    <th>Tipo de vuelo</th>
    <th>Estado</th>
    <th>Aceptar</th>
    <th>Rechazar</th>
  </tr>
    <?php
      // echo $resultado;
      foreach ($resultado as $p) {
        echo "<tr>";
        echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td>";

        echo "<td><input type='button' name='buysell'  value='aceptar' onclick='select()'></td>";
        echo "<td><input type='button' name='buysell'  value='rechazar' onclick='insert()'></td>";
        
        echo "</tr>";     
    }}
    ?>
</table>

<?php include('../templates/footer.html'); ?>