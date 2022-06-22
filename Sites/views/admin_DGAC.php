<?php include('../templates/header.html');   ?>

<body>
<br>
<h3 align="center"><b>ADMIN</b></h3>
<br>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT * FROM vuelo";

  $result = $db -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
<br>
        <table align="center">
    <tr>
      <th>Vuelo ID</th>
      <th>Aerodromo Salida ID</th>
      <th>Aerodromo Llegada ID</th>
      <th>Ruta ID</th>
      <th>Codigo Vuelo</th>
      <th>Codigo Aeronave</th>
      <th>Codigo Compañia</th>
      <th>Fecha Salida</th>
      <th>Fecha Llegada</th>
      <th>Velocidad</th>
      <th>Altitud</th>
      <th>Estado</th>
      <th>Nombre Aeronave</th>
      <th>Modelo</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "</tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td></tr>";
      }
      ?>
 
  </table>




<h3 align="center"><b>Filtrar por fecha las propuestas de Vuelos Pendientes</b></h3>
<br>
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("../config/conection.php");
  $result = $db -> prepare("SELECT DISTINCT fecha_salida, DISTINCT fecha_llegada FROM vuelo;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" method="post">
  <b>Seleccionar Fechas:</b>
    <br>
    Fecha Inicio/Salida:
    <select name="inicio">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value='$d[0]'>'$d[0]'</option>";
      }
      ?>
    </select>
    <br/>
    Fecha Final/Llegada:
    <select name="final">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[1]>$d[1]</option>";
      }
      ?>
    </select>
    <br/><br/>
    <input type='submit' value='Buscar fechas' name='fechas'>
  </form>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  $inicio = $_POST['inicio'];
  $final = $_POST['final'];

 	$query2 = "SELECT * FROM vuelo WHERE CAST(fecha_salida AS date) >= CAST('$inicio' AS date) AND CAST(fecha_salida AS date) <= CAST('$inicio' AS date) OR CAST(fecha_llegada AS date) >= CAST('$final' AS date) AND CAST(fecha_llegada AS date) <= CAST('$final' AS date)";
	$result = $db -> prepare($query2);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
  <h3 align="center">Vuelos Pendientes</h3>
	<table align="center">
  <tr>
    <th>Vuelo ID</th>
    <th>Aerodromo Salida ID</th>
    <th>Aerodromo Llegada ID</th>
    <th>Ruta ID</th>
    <th>Codigo Vuelo</th>
    <th>Codigo Aeronave</th>
    <th>Codigo Compañia</th>
    <th>Fecha Salida</th>
    <th>Fecha Llegada</th>
    <th>Velocidad</th>
    <th> Altitud</th>
    <th> Estado</th>
    <th> Aceptar</th>
    <th> Rechazar</th>
  </tr>
    <?php
      // echo $resultado;
      foreach ($resultado as $p) {
        echo "<tr>";
        echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td>";
        if ($p[11] == "pendiente") {
          echo "<td><input type='button' name='Button1' value='Aceptar'></td>";
          echo "<td><input type='button' name='Button2' value='Rechazar'></td>";}
        echo "</tr>";
    }
    ?>
</table>


<?php include('../templates/footer.html'); ?>