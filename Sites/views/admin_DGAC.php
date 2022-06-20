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
      <th>Codigo Vuelo</th>
      <th>Fecha Salida</th>
      <th>Fecha Llegada</th>
      <th>Velocidad</th>
      <th>Altitud</th>
      <th>Estado</th>
      <th>Boton 1</th>
      <th>Boton 2</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td>";
          echo "<td><input type='button' name='Button1' value='ACEPTAR'></td>";

          echo "<td><input type='button' name='buysell' value='RECHAZAR'></td>";
          
          echo "</tr>";
      }
      ?>
      
  </table>



<?php include('../templates/footer.html'); ?>