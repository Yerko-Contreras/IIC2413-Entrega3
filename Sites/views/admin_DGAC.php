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
      <th>Vuelo ID </th>
      <th>Aerodromo Salida ID </th>
      <th>Aerodromo Llegada ID </th>
      <th>Ruta ID </th>
      <th>Codigo Vuelo </th>
      <th>Codigo Aeronave </th>
      <th>Codigo Compañia </th>
      <th>Fecha Salida </th>
      <th>Fecha Llegada </th>
      <th>Velocidad </th>
      <th>Altitud </th>
      <th>Estado </th>
      <th>Nombre Aeronave </th>
      <th>Modelo </th>
      <th>Peso </th>
      <th>Valor </th>
      <th>Nombre Compañia </th>
      <th>Boton 1 </th>
      <th>Boton 2 </th>
    </tr>
  
      <?php
        // echo $resultado;
        foreach ($resultado as $p) {
          echo "<tr>";
          echo "<td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td><td>$p[10]</td><td>$p[11]</td><td>$p[12]</td><td>$p[13]</td><td>$p[14]</td><td>$p[15]</td><td>$p[16]</td>";
          echo "<td><input type='button' name='Button1' value='ACEPTAR'></td>";

          echo "<td><input type='button' name='buysell' value='RECHAZAR'></td>";
          
          echo "</tr>";
      }
      ?>
      
  </table>



<?php include('../templates/footer.html'); ?>