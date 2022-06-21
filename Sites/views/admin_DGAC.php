<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT * FROM vuelo";

  $result = $db -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
<h3 align="center">ADMIN</h3>
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
      <th>Velocidad </th>
      <th>Altitud </th>
      <th>Estado</th>
      <th>Aceptar </th>
      <th>Rechazar</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td>";
          if ($p[11] == "pendiente") {
            echo "<td><input type='button' name='Button1' value='Aceptar'></td>";
            echo "<td><input type='button' name='buysell' value='Rechazar'></td>";}
          echo "</tr>";
      }
      ?>
      
  </table>



<?php include('../templates/footer.html'); ?>