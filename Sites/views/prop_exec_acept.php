<?php
    if(isset($_POST['$p[2]'])){
        echo("You clicked button one!");
        //and then execute a sql query here
        require("../config/conection.php");
            $username = $_SESSION['username'];
               
            $query1 = "UPDATE vuelo SET vuelo.estado='aceptado' WHERE vuelo.codigo_vuelo ='$p[2]';";
            $result = $db -> prepare($query1);
            $result1 -> execute();

            $query2 = "UPDATE informacion_de_vuelo SET informacion_de_vuelo.estado='aceptado' WHERE informacion_de_vuelo.codigo_vuelo ='$p[2]';";
            $result2 = $db2 -> prepare($query2);
            $result12 -> execute();
    }
    else {
    echo" dhur";
    }
?>