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
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "</tr>";
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td>";
          
          if(isset($_POST['button1'])) {
            echo "This is Button1 that is selected";
          }
          if(isset($_POST['button2'])) {
              echo "This is Button2 that is selected";
          }
          echo "</tr>";
      }
      ?>
      
  </table>

  <form method="post">
      <input type="submit" name="button1"
              value="Button1"/>
        
      <input type="submit" name="button2"
              value="Button2"/>
  </form>

<?php include('../templates/footer.html'); ?>