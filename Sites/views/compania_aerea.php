<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conection.php");

  #Se construye la consulta como un string
  $query = "SELECT * FROM vuelo where estado = 'aprobado'";

  $result = $db -> prepare($query);
	$result -> execute();
	$resultado = $result -> fetchAll();
  $query1 = "SELECT * FROM vuelo where estado = 'rechazado'";

  $result1 = $db -> prepare($query1);
	$result1 -> execute();
	$resultado1 = $result1 -> fetchAll();
  ?>

<h3 align="center">Vuelos Aprobados</h3>
  <table align="center">
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
          echo "<tr><td>$p[0]</td><td>$p[4]</td><td>$p[1]</td><td>$p[2]</td><td>$p[7]</td><td>$p[8]</td></tr>";
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

    <form method="post">
        <input type="submit" name="button1"
                class="button" value="Button1" />
          
        <input type="submit" name="button2"
                class="button" value="Button2" />
    </form>
      
  </table>
<br>
<br>
<h3 align="center">Vuelos Rechazados</h3>
  <table align="center">
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