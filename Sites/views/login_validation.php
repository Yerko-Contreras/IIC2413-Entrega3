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
        
        try {
        $query = "SELECT * 
            FROM Usuarios
            WHERE username = '$username' AND
            contrasena = '$password'";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
        
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $data[0];
        $_SESSION['password'] = $data[1];
        $_SESSION['tipo'] = $data[2];
        
        $msg = "Sesión iniciada correctamente";
        header("Location: ../index.php?msg=$msg");

        } catch (Exception $e) {
            $msg = 'Login Invalido';
            header("Location: ../views/login.php?msg=$msg");
        }   
    }
?>