<?php
    if(isset($_POST['update'])){
        echo("You clicked button ACEPTAR!");
        //and then execute a sql query here
        require("../config/conection.php");
            session_start();
            $codigo = $_POST['codigo'];
               
            $query1 = "UPDATE vuelo SET estado='aceptado' WHERE codigo_vuelo ='$codigo';";
            $result1 = $db -> prepare($query1);
            $result1 -> execute();

            $query2 = "UPDATE informacion_de_vuelo SET estado='aceptado' WHERE codigo_vuelo ='$codigo';";
            $result2 = $db2 -> prepare($query2);
            $result2 -> execute();
    }
    else {
    echo" dhur";
    }
?>

<?php
    if(isset($_POST['update2'])){
        echo("You clicked button RECHAZAR!");
        //and then execute a sql query here
        require("../config/conection.php");
            session_start();
            $codigo = $_POST['codigo'];
               
            $query3 = "UPDATE vuelo SET estado='rechazado' WHERE codigo_vuelo ='$codigo';";
            $result3 = $db -> prepare($query3);
            $result3 -> execute();

            $query4 = "UPDATE informacion_de_vuelo SET estado='rechazado' WHERE codigo_vuelo ='$codigo';";
            $result4 = $db2 -> prepare($query4);
            $result4 -> execute();
    }
    else {
    echo" dhur";
    }
?>
<?php
require('propuestas_pendientes.php')
?>