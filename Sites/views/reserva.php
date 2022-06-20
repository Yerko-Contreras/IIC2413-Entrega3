<boody>
    <?php
    include("../templates/header.html");
    $codigo_vuelo = $_POST['codigo_vuelo'];
    require("../config/conection.php");
    session_start();
    if (isset($_POST['pasaporte_1']) || isset($_POST['pasaporte_2']) || isset($_POST['pasaporte_3'])){
        if (isset($_POST['pasaporte_1'])){
            $pasaporte_1 = $_POST['pasaporte_1'];
        } else {
            $pasaporte_1 = '';
        };
        if (isset($_POST['pasaporte_2'])){
            $pasaporte_2 = $_POST['pasaporte_2'];
        } else {
            $pasaporte_2 = '';
        };
        if (isset($_POST['pasaporte_3'])){
            $pasaporte_3 = $_POST['pasaporte_3'];
        } else {
            $pasaporte_3 = '';
        };
        $pasaporte = $_SESSION['username'];
        $query = "SELECT * FROM crear_reserva('$codigo_vuelo', '$pasaporte_1', '$pasaporte_2', '$pasaporte_3', '$pasaporte');";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
        if ($data[0][0] == "Tickets reservados correctamente") {
            echo "Pasajes Reservados";
        } else {
            echo $data[0][0];
        }
    }
    ?>
<form action='reserva.php' method="Post">

    Pasaporte 1: <input type='text' name='pasaporte_1'>
    <br>
    Pasaporte 2: <input type='text' name='pasaporte_2'>
    <br>
    Pasaporte 3: <input type='text' name='pasaporte_3'>
    <br>
    <?php
    echo "<input type='hidden' name='codigo_vuelo' value='$codigo_vuelo'>";
    ?>
    <input type='submit' value="Reservar">
</form>
<?php 
include('../templates/footer.html');
?>