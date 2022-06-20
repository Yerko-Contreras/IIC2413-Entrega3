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
      <th>1-Vuelo ID</th>
      <th>2-Aerodromo Salida ID</th>
      <th>3-Aerodromo Llegada ID</th>
      <th>4-Ruta ID</th>
      <th>5-Codigo Vuelo</th>
      <th>6-Codigo Aeronave</th>
      <th>7-Codigo Compañia</th>
      <th>8-Fecha Salida</th>
      <th>9-Fecha Llegada</th>
      <th>10-Velocidad</th>
      <th>11-Altitud</th>
      <th>12-Estado</th>
      <th>13-Nombre Aeronave</th>
      <th>14-Modelo</th>
      <th>15-Peso</th>
      <th>16-Valor</th>
      <th>17-Nombre Compañia</th>
      <th>Boton 1</th>
      <th>Boton 2</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td><td>$p[12]</td><td>$p[13]</td><td>$p[14]</td><td>$p[15]</td><td>$p[16]</td>";
          echo "<td><input type='button' name='Button1' value='buy'></td>";

          echo "<td><input type='button' name='buysell' value='buy'></td>";
          
          echo "</tr>";
      }
      ?>
      
  </table>



<?php include('../templates/footer.html'); ?>