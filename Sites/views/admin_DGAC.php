<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT * FROM aeronave ";

  $result = $db -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  ?>
<h3 align="center">ADMIN</h3>
  <table align="center">
    <tr>
      <th>Aerolinea</th>
      <th>Porcentaje de Vuelos Aprobados (%)</th>
      <th>Porcentaje de Vuelos Aprobados (%)</th>
       <th>Porcentaje de Vuelos Aprobados (%)</th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[6]</td><td>$p[5]</td>";
          echo "<td><input type='button' name='Button1' value='buy'></td>";

          echo "<td><input type='button' name='buysell' value='buy'></td>";
          
          echo "</tr>";
      }
      ?>
      
  </table>



<?php include('../templates/footer.html'); ?>