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
          if(array_key_exists('button1', $_POST)) {
            button1();
          }
          else if(array_key_exists('button2', $_POST)) {
            button2();
          }
          function button1() {
              echo "This is Button1 that is selected";
          }
          function button2() {
              echo "This is Button2 that is selected";
          }
      }
      ?>
      
  </table>

<form method="post">
      <input type="submit" name="button1"
              class="button" value="Button1" />
        
      <input type="submit" name="button2"
              class="button" value="Button2" />
  </form>

<?php include('../templates/footer.html'); ?>