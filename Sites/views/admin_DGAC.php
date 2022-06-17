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
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>