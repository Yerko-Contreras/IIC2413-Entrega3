<?php
	ob_start();
	session_start();
?>

<?php
    $msg = '';
    if (isset($_POST['login']))
    {   
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        require("../config/conection.php");
        $query = "SELECT * 
            FROM Usuarios
            WHERE username = '$username' AND
            contrasena = '$password'";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
        
        if (!(empty($data))) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $data[0];
            $_SESSION['password'] = $data[1];
            $_SESSION['tipo'] = $data[2];
        } else {
        $msg = "Sesión iniciada correctamente";
        header("Location: ../index.php?msg=$msg");

        
            $msg = 'Login Invalido';
            header("Location: ../views/login.php?msg=$msg"); 
        };
    };
?>