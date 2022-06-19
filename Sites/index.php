<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['username'];            

    }
?>

<?php
    include("templates/header.html");
?>

<body>
    <br>

    <h1 class="title is-3 has-text-centered" > Pagina de Vuelos y Pasajeros</h1>
    <br>
    <img src="https://images.unsplash.com/photo-1556388158-158ea5ccacbd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"  width="350" height="250" class="center">
    <br>
    <?php
        if (!isset($_SESSION['username'])) {
    ?>
        <form action="importar_usuarios.php" method="post" align="center" width="350">
            <input type="submit" value="Importar Usuarios" class="button is-info" width="350">
        </form>
        <br>
        <form align="center" action="views/login.php" method="get">
            <input type="submit" value="Iniciar sesión" class="button is-info">
        </form>

    <?php } else { ?>

        <?php
        if ($_SESSION['tipo'] == "Admin DGAC" ){
        ?>
            <form align="center" action="views/admin_DGAC.php" method="post">
                <input type="submit" value="Propuestas de Vuelo" class="button is-info">
            </form>

            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión" class="button is-danger">
            </form>
        <?php
        } elseif ($_SESSION['tipo'] == "Compania Aerea"){
        ?>
            <form align="center" action="views/compania_aerea.php" method="post">
                <input type="submit" value="Mis Vuelos" class="button is-info">
            </form>
            
            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión" class="button is-danger">
            </form>

        <?php
        } elseif ($_SESSION['tipo'] == "Pasajero"){
        ?> 
            <form align="center" action="pasajeros.php" method="post">
                <input type="submit" value="Reservas" class="button is-info">
            </form>

            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión" class="button is-danger">
            </form>

        <?php } else { 
        ?>
            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión" class="button is-danger">
            </form>

    <?php } }?>
    
</body>

</html>