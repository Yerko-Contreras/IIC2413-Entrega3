<?php include('../templates/header.html');   ?>

<body> 
<br>
<h3 align="center"><b>ADMIN</b></h3>
<br>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT propuestas.propuesta_vuelo_id, propuestas.codigo_compania, informacion_de_vuelo.codigo, informacion_de_vuelo.codigo_aeronave,informacion_de_vuelo.aerodromo_id_sal, informacion_de_vuelo.aerodromo_id_lle, propuestas.fecha_envio_propuesta, informacion_de_vuelo.fecha_salida, informacion_de_vuelo.fecha_llegada, fpl.tipo_vuelo, fpl.max_pasajeros, fpl.realizado, informacion_de_vuelo.estado FROM informacion_de_vuelo, fpl, propuestas WHERE fpl.informacion_id = propuestas.informacion_id AND propuestas.informacion_id = informacion_de_vuelo.informacion_id AND informacion_de_vuelo.estado = 'pendiente';";

  $result = $db2 -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
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
      <th>Maximo de pasajeros</th>
      <th>¿Es realizado?</th>
      <th>Estado</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {

          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td><td>$p[12]</td></tr>";
      }
      ?>
 
  </table>
<?php
  if(isset($_POST['aceptar'])){
    require("../config/conection.php");
    $result = $db -> prepare("SELECT DISTINCT fecha_salida, DISTINCT fecha_llegada FROM vuelo;");
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    
  }
?>


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
 if (isset($_POST['inicio']) && isset($_POST['final'])){
  $inicio = $_POST['inicio'];
  $final = $_POST['final'];
 
 	$query2 = "SELECT * FROM vuelo WHERE CAST(fecha_salida AS date) >= CAST('$inicio' AS date) AND CAST(fecha_salida AS date) <= CAST('$inicio' AS date) OR CAST(fecha_llegada AS date) >= CAST('$final' AS date) AND CAST(fecha_llegada AS date) <= CAST('$final' AS date)";
	$result = $db -> prepare($query2);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
  <h3 align="center">Vuelos Pendientes</h3>
	<table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light' align="center">
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
    <th> Estado</th>
    <th> Aceptar</th>
    <th> Rechazar</th>
  </tr>
    <?php
      // echo $resultado;
      foreach ($resultado as $p) {
        echo "<tr>";
        echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[10]</td><td>$p[11]</td>";

        
        echo "<td><input type='button' name='buysell'  value='insert' onclick='select()'></td>";
        echo "<td><input type='button' name='buysell'  value='insert' onclick='insert()'></td>";
        
        echo "</tr>";
          
    }}
    ?>


</table>

<?php
    function select(){
      require("../config/conection.php");
      $username = $_SESSION['username'];
         

      $query2 = "SELECT nombre_compania FROM COMPANIA;";
      $result2 = $db -> prepare($query2);
      $result2 -> execute();
      $nombre_aerolinea = $result2 -> fetchAll();
      echo "#{$nombre_aerolinea} ASDDDDDDDDDDDDDDDDDDD";
  }
  function insert(){
      echo "The insert function is called.";
  }
?>


<?php include('../templates/footer.html'); ?>