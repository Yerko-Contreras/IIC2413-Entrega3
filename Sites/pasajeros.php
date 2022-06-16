<?php 
function reservar($codigo, $pasaporte_1, $pasaporte_2, $pasaporte_3, $db, $pasaporte){
    $query = "SELECT * FROM crear_reserva('$codigo', '$pasaporte_1', '$pasaporte_2', '$pasaporte_3', '$pasaporte');";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
};

function ingresar_pasaporte($codigo, $db){
    echo "<input type='text' id=x'pasaporte_1' />
        <input type='text' id='pasaporte_2' />
        <input type='text' id='pasaporte_3' />
        <button onclick='reservar($codigo, document.getElementById(pasaporte_1), document.getElementById(pasaporte_2), document.getElementById(pasaporte_3), $db) />";
};

session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];
    }

    if($_SESSION['tipo']){
    require("config/conection.php");
    
    $pasaporte = $_SESSION['username'];
    $query = "SELECT nombre
        FROM pasajeros_compradores
        WHERE pasaporte = $pasaporte;";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();

    echo "Pasaporte: $pasaporte
        Nombre: $data";
    
    $query = "SELECT codigo_reserva, numero_ticket
        FROM Reserva
        WHERE pasaporte_comprador = $pasaporte;";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();

    foreach ($data as $d){
        echo "Codigo de reserva: $d[0]
            Número de ticket: $d[1]";
    }

    $query = "SELECT DISTINCT Aerodromos.nombre_ciudad
        FROM Propuestas, Informacion_de_vuelo, aerodromos
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_sal = Aerodromos.aerodromo_id;";
    $result = $db -> prepare($query);
    $result -> execute();
    $data_salida = $result -> fetchAll();

    $query = "SELECT DISTINCT Aerodromos.nombre_ciudad
        FROM Propuestas, Informacion_de_vuelo, aerodromos
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_lle = Aerodromos.aerodromo_id;";
    $result = $db -> prepare($query);
    $result -> execute();
    $data_llegada = $result -> fetchAll();
    ?>

    <form method="post">
        Ciudad de origen: <select name="ciudad_de_origen">
            <?php foreach ($data_salida as $d){
                echo "<option value='$d'>$d</optio>";
            }
            ?>
        </select>
        Ciudad de destino: <select name="ciudad_de_destino">
            <?php foreach ($data_llegada as $d){
                echo "<option value='$d'>$d</optio>";
            }
            ?>
        Fecha de despegue: <input type="date" name="fecha_despegue" />
        <input type="submit" name="submit" value="consultar" />
    </form>

    <?php
    $ciudad_de_origen = $_POST['ciudad_de_origen'];
    $ciudad_de_destino = $_POST['ciudad_de_destino'];
    $fecha_despegue = $_POST['fecha_despegue'];
    $query = "SELECT Informacion_de_vuelo.codigo, Informacion_de_vuelo.codigo_aeronave, sal.icao, lle.icao
        FROM Propuestas, Informacion_de_vuelo, Aerodromos as sal, Aerodromos as lle
        WHERE Propuestas.informacion_id = Informacion_de_vuelo.informacion_id AND
        Informacion_de_vuelo.aerodromo_id_sal = sal.aerodromo_id AND
        Informacion_de_vuelo.aerodromo_id_lle = lle.aerodromo_id AND
        Informacion_de_vuelo.estado = 'aceptado' AND
        sal.nombre_ciudad = '$ciudad_de_origen' AND
        lle.nombre_ciudad = '$ciudad_de_destino' AND
        CAST(Informacion_de_vuelo.fecha_salida AS date) = CAST('$fecha_despegue' AS DATE);";
    $result = $db -> prepare($query);
    $result -> execute();
    $data_llegada = $result -> fetchAll();
    echo "<table id = 'Vuelos'>
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
            <td><button onclick=ingresar_pasaporte($d[0], $db, $pasaporte)></td>";
    }
}
?>