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
        

        if (!(empty($data))) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $data[1];
            $_SESSION['password'] = $data[2];
            $_SESSION['tipo'] = $data[3];
            if ($_SESSION['tipo'] == 'Pasajero') {
                $msg = "Sesión iniciada correctamente";
                header("Location: ../pasajeros.php?msg=$msg");
            } elseif ($_SESSION['tipo'] == 'Admin DGAC') {
                $msg = "Sesión iniciada correctamente";
                header("Location: ../views/admin_DGAC.php?msg=$msg");
            } elseif ($_SESSION['tipo'] == 'Compania Aerea') {
                header("Location: ../views/compania_aerea.php?msg=$msg");
            
            }else{}
            ;
        } else {
            $msg = 'Login Invalido';
            header("Location: ../views/login.php?msg=$msg");
        };
    };
?>

<form action= "../views/compania_aerea.php" method="post">
  <input type="hidden" id="username" name="username" value="<?php $_SESSION['username']?>">
  <input type="hidden" id="password" name="password" value="<?php $_SESSION['password']?>">

</form>
