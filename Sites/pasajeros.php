<body>

<?php 
session_start();

    if($_SESSION['tipo']){
    require("config/conection.php");
    
    $pasaporte = $_SESSION['username'];
    $query = "SELECT nombre
        FROM pasajeros_compradores
        WHERE pasaporte = '$pasaporte';";
    $result = $db -> prepare($query);
    $result -> execute();
    $informacion_usuario = $result -> fetchAll();
    $informacion_usuario = $informacion_usuario[0];

    $query = "SELECT reserva.codigo_reserva, ticket.numero_ticket, ticket.clase, vuelo.pasaporte_pasajero, vuelo.codigo_vuelo
        FROM reserva, ticket, vuelo
        WHERE pasaporte_comprador = '$pasaporte' AND
        reserva.numero_ticket = ticket.numero_ticket AND
        vuelo.vuelo_id = ticket.vuelo_id;";
    $result = $db -> prepare($query);
    $result -> execute();
    $reservas = $result -> fetchAll();
    
    

    $query = "SELECT DISTINCT Aerodromos.nombre_ciudad
        FROM Propuestas, Informacion_de_vuelo, aerodromos
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_sal = Aerodromos.aerodromo_id;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data_salida = $result -> fetchAll();

    $query = "SELECT DISTINCT Aerodromos.nombre_ciudad
        FROM Propuestas, Informacion_de_vuelo, aerodromos
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_lle = Aerodromos.aerodromo_id;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data_llegada = $result -> fetchAll();
    
    echo "<h1 class='title is-1 has-text-weight-bold has-text-centered'>Pasaporte: $pasaporte </h1>
    <h1 class='title is-1 has-text-weight-bold has-text-centered'>Nombre: $informacion_usuario[0]</h1>";

    echo "<h1 class='title is-1 has-text-weight-bold has-text-centered'>Tus Reservas:</h1>";
    echo "<table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light'>
        <tr>
            <th> Codigo de Reserva </th>
            <th> Número de Ticket </th>
            <th> Clase </th>
            <th> Pasaporte Pasajero </th>
            <th> Código de Vuelo </th>
        </tr>";
    
        foreach ($reservas as $d){
        echo "<tr>
        <td> $d[0] </td>
        <td> $d[1] </td>
        <td> $d[2] </td>
        <td> $d[3] </td>
        <td> $d[4] </td> </tr>";
    }
    echo "</table>";
    ?>
    
    <br>
        
    <form method="post">
        Ciudad de origen: <select name="ciudad_de_origen">
            <?php foreach ($data_salida as $d){
                echo "<option value='$d[0]'>$d[0]</optio>";
            }
            ?>
        </select>
        Ciudad de destino: <select name="ciudad_de_destino">
            <?php foreach ($data_llegada as $d){
                echo "<option value='$d[0]'>$d[0]</optio>";
            }
            ?>
        Fecha de despegue: <input type="date" name="fecha_despegue" />
        <input type="submit" name="submit" value="consultar" />
    </form>

    <?php
    if (isset($_POST['ciudad_de_origen']) && isset($_POST['ciudad_de_destino']) && isset($_POST['fecha_despegue'])){
    $ciudad_de_origen = $_POST['ciudad_de_origen'];
    $ciudad_de_destino = $_POST['ciudad_de_destino'];
    $fecha_despegue = $_POST['fecha_despegue'];
    $query = "SELECT Informacion_de_vuelo.codigo, Informacion_de_vuelo.codigo_aeronave, sal.codigo_icao, lle.codigo_icao
        FROM Propuestas, Informacion_de_vuelo, Aerodromos as sal, Aerodromos as lle
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_sal = sal.aerodromo_id AND
        Informacion_de_vuelo.aerodromo_id_lle = lle.aerodromo_id AND
        Informacion_de_vuelo.estado = 'aceptado' AND
        sal.nombre_ciudad = '$ciudad_de_origen' AND
        lle.nombre_ciudad = '$ciudad_de_destino' AND
        CAST(Informacion_de_vuelo.fecha_salida AS date) = CAST('$fecha_despegue' AS DATE);";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();

    if (!(empty($data))) {
    echo "<table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth has-background-info-light' align='center'>
        <tr>
            <th> Código de Vuelo </th>
            <th> Código de Aeronave </th>
            <th> Aeródromo Salida </th>
            <th> Aeródromo Llegada </th>
            <th> Reservar </th>
        </tr>";
    
    foreach ($data as $d){
        echo "<tr>
            <td>$d[0]</td>
            <td>$d[1]</td>
            <td>$d[2]</td>
            <td>$d[3]</td>
            <td><form action='views/reserva.php' method='post'>
            <input type='hidden' name='codigo_vuelo' value=$d[0]>
            <input type='submit' value='Reservar'>
            </form></td> 
            </tr>";
    };
    echo "</table>";}
    include('templates/footer.html');
}
}
?>

</body>