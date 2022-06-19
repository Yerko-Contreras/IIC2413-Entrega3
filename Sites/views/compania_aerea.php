<?php
    include("../templates/header.html");
?>


<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");
  $username = $_GET['username'];

  #Se construye la consulta como un string
  $query = "SELECT vuelo.vuelo_id, vuelo.codigo_vuelo, aerodromo1.nombre, aerodromo2.nombre, vuelo.fecha_salida, vuelo.fecha_llegada FROM vuelo, aerodromo as aerodromo1, aerodromo as aerodromo2 where vuelo.estado = 'aceptado' AND vuelo.codigo_compania = '$username' AND vuelo.aerodromo_salida_id = aerodromo1.aerodromo_id AND vuelo.aerodromo_llegada_id = aerodromo2.aerodromo_id;";

  $result = $db -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  $query1 = "SELECT vuelo.vuelo_id, vuelo.codigo_vuelo, aerodromo1.nombre, aerodromo2.nombre, vuelo.fecha_salida, vuelo.fecha_llegada FROM vuelo, aerodromo as aerodromo1, aerodromo as aerodromo2 where vuelo.estado = 'rechazado' AND vuelo.codigo_compania = '$username' AND vuelo.aerodromo_salida_id = aerodromo1.aerodromo_id AND vuelo.aerodromo_llegada_id = aerodromo2.aerodromo_id;";

  $result1 = $db -> prepare($query1);
	$result1 -> execute();
	$resultado1 = $result1 -> fetchAll();

  $query2 = "SELECT nombre_compania FROM COMPANIA WHERE codigo_compania='$username';";
  $result2 = $db -> prepare($query2);
	$result2 -> execute();
	$nombre_aerolinea = $result2 -> fetchAll();
  ?>


<h3 class="title is-1 has-text-weight-bold has-text-centered">"Bienvenida Aerolinea: <?php foreach ($nombre_aerolinea as $p) {echo "$p[0]";}?> </h3>
<h3 class="title is-2 has-text-weight-bold has-text-centered">Vuelos Aprobados</h3>
  <table class = "table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light" align="center" >
    <tr>
      <th>ID</th>
      <th>Codigo Vuelo</th>
      <th>Aerodromo de Salida</th>
      <th>Aerodromo de Llegada</th>
      <th>Fecha Salida</th>
      <th>Fecha Llegada</th>

    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td></tr>";

      }
      ?>


      
  </table>
<br>
<br>
<h3 class="title is-2 has-text-weight-bold has-text-centered">Vuelos Rechazados</h3>
  <table class = "table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light" align="center" >
    <tr>
      <th>ID</th>
      <th>Codigo Vuelo</th>
      <th>Aerodromo de Salida</th>
      <th>Aerodromo de Llegada</th>
      <th>Fecha Salida</th>
      <th>Fecha Llegada</th>

    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado1 as $p) {
          echo "<tr><td>$p[0]</td><td>$p[4]</td><td>$p[1]</td><td>$p[2]</td><td>$p[7]</td><td>$p[8]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>