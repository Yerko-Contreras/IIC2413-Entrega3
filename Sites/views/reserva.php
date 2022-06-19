<boody>
    <?php
    require("../config/conection.php");
    $pasaporte_1 = $_POST['pasaporte_1'];
    $pasaporte_1 = $_POST['pasaporte_2'];
    $pasaporte_1 = $_POST['pasaporte_3'];
    $query = "SELECT * FROM crear_reserva('$codigo', '$pasaporte_1', '$pasaporte_2', '$pasaporte_3', '$pasaporte');";
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    if ($data[0] = "Reservados") {
        echo "Pasajes Reservados";
    } else {
        echo $data[0];
    }
    ?>
<form>

    Pasaporte 1: <input type='text' name='pasaporte_1'>
    <br>
    Pasaporte 2: <input type='text' name='pasaporte_2'>
    <br>
    Pasaporte 3: <input type='text' name='pasaporte_3'>
    <br>

    <input type='submit' value="Reservar">
</form>
</boody>