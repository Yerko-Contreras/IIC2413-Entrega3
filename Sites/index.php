<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="java2.js"></script>
        <title> Entrega 2 </title>
    <style>
            body {
            background-color: #F8FDFF;
            text-align: left;
            font-family: Helvetica, Arial, sans-serif;
            }

            text{
                margin-left: 10px;
            }
            
            table{
                border-collapse: collapse;
                text-align: center;
                border-color: #F0DEDE;
                margin-left: 10;
                margin-right: auto;
            }   

            th {
                border: 1px solid;
            }

            td{
                border: 1px solid;
            }

            tr:nth-child(even) {background: #EBF5FB}
            tr:nth-child(odd) {background: #D6EAF8}
            tr:nth-child(1) {background: #85C1E9 }
    </style>
    </head>

    <body>
        <?php require("config/conection.php");
        ?>

        <form action="importar_usuarios.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>
        
    </body>

</html>