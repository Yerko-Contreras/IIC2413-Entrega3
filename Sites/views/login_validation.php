<?php
	ob_start();
	session_start();
?>

<?php
    $msg = '';
    if (isset($_POST['login']) && $_POST['username'] == "DGAC" && $_POST['password'] == "admin")
    {
        $rut = $_POST['username'];
        $user_password = $_POST['password'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $msg = "Sesión iniciada correctamente";
        header("Location: ../index.php?msg=$msg");
    }
    else{
        $msg = 'Login Invalido';
        header("Location: ../views/login.php?msg=$msg");
    }
?>