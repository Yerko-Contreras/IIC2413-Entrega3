<?php
	session_start();
	$msg = $_GET['msg']
?>
<?php
    include("../templates/header.html");
?>


<body>
    <br>
    <h1 class="title is-3 has-text-centered"> Inicio de sesión</h1>
    <br>
	<br>



    <form class="form-signin" role="form" action="login_validation.php" method="post">
        <?php echo $msg; ?>

        
        <input type="text" name="username" class="input is-info control mb-3 is-fullwidth" placeholder="nombre de usuario" required autofocus>
        

        
        <input  type="password" name="password" class="input is-info control mb-3 is-fullwidth" placeholder="contraseña" required>
        

    
        <button  type="submit" name="login" class="button is-info is-fullwidth"> Iniciar sesión </button>
        
    </form>

    

</body>