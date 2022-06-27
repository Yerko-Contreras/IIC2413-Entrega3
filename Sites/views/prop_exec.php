<?php
    if(isset($_POST['update'])){
        echo("You clicked button 1!");
        //and then execute a sql query here
        require("../config/conection.php");
            $username = $_SESSION['username'];
            $codigo = $_POST['codigo'];
               
            $query1 = "UPDATE vuelo SET vuelo.estado='aceptado' WHERE vuelo.codigo_vuelo ='$codigo';";
            $result1 = $db -> prepare($query1);
            $result1 -> execute();

            $query2 = "UPDATE informacion_de_vuelo SET informacion_de_vuelo.estado='aceptado' WHERE informacion_de_vuelo.codigo_vuelo ='$p[2]';";
            $result2 = $db2 -> prepare($query2);
            $result12 -> execute();
    }
    else {
    echo" dhur";
    }
?>

<?php
    if(isset($_POST['update2'])){
        echo("You clicked button 2!");
        //and then execute a sql query here
        require("../config/conection.php");
            $username = $_SESSION['username'];
            $codigo = $_POST['codigo'];
               
            $query1 = "UPDATE vuelo SET vuelo.estado='rechazado' WHERE vuelo.codigo_vuelo ='$codigo';";
            $result1 = $db -> prepare($query1);
            $result1 -> execute();

            $query2 = "UPDATE informacion_de_vuelo SET informacion_de_vuelo.estado='rechazado' WHERE informacion_de_vuelo.codigo_vuelo ='$p[2]';";
            $result2 = $db2 -> prepare($query2);
            $result12 -> execute();
    }
    else {
    echo" dhur";
    }
?>
