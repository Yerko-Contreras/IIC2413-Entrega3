<?php
	ob_start();
	session_start();
?>

<?php
    $msg = '';
    if (isset($_POST['login']))
    {   
        $username = $_POST['username'];
        $contrasena = $_POST['contrasena'];
        
        require("../config/conection.php");
        $query = "SELECT * 
            FROM Usuarios
            WHERE username = '$username' AND
            contrasena = '$contrasena'";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
        $data = $data[0];
        
        echo "$contrasena";
        echo "$username";
        echo "$data[0]";
        echo "$data[1]";

        if (!(empty($data))) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $data[0];
            $_SESSION['password'] = $data[1];
            $_SESSION['tipo'] = $data[2];
            $msg = "Sesión iniciada correctamente";
            header("Location: ../index.php?msg=$msg");
        } else {
            $msg = 'Login Invalido';
            header("Location: ../views/login.php?msg=$msg");
        };
    };
?>
