
<?php

require("config/conection.php");

$query = "SELECT * FROM crear_usuario('DGAC', 'admin', 'Admin DGAC');";
$result = $db -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();


$query = "SELECT codigo_compania
FROM Companias;";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

foreach ($data as $d){
    #GENERADOR DE CONTRASEÑAS INSPIRADO EN https://www.geeksforgeeks.org/generating-random-string-using-php/
    $alfabeto='abcdefghijklmnopqrstuvwxyz';
    $largo = rand(5, 10);
    $contrasena = '';
    for ($i = 0; $i < $largo; $i = $i + 1){
        $n = rand(0, strlen($alfabeto) - 1);
        $contrasena .= $alfabeto[$n];
    }
    $query = "SELECT * FROM crear_usuario('$d[0]', '$contrasena', 'Compania Aerea');"; 
    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();

}    

$query = "SELECT pasaporte, nombre
FROM pasajeros_compradores;";
$result = $db -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();

foreach ($data as $d){
    #GENERADOR DE CONTRASEÑAS INSPIRADO EN https://www.geeksforgeeks.org/generating-random-string-using-php/
    $caracteres= "$d[1]";
    $largo = rand(5, 10);
    $contrasena = substr("$d[0]", 0, 4);
    for ($i = 0; $i < $largo; $i = $i + 1){
        $n = rand(0, strlen($caracteres) - 1);
        $contrasena .= $caracteres[$n];
    }

    $query = "SELECT * FROM crear_usuario('$d[0]', '$contrasena', 'Pasajero');"; 
    $result = $db -> prepare($query);
    $result -> execute();
}

echo "<script type='text/javascript'>alert('Los usuarios han sido importados, redirigiendo a inicio');</script>";
sleep(10);

header('Location: index.php');
exit();
?>
