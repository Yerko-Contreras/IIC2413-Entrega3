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
    <h1 class="title is-3 has-text-centered"> Pagina de Vuelos</h1>
    <br>
    <?php
        if (!isset($_SESSION['username'])) {
    ?>
    
    <?php require("config/conection.php");
        ?>


        <form action="importar_usuarios.php" method="post">
            <input type="submit" value="Importar Usuarios">
        </form>
        <br>
        <br>
        <form align="center" action="views/login.php" method="get">
            <input type="submit" value="Iniciar sesión" class="button is-info">
        </form>

    <?php } else { ?>

        <?php
        if ($_SESSION['username'] == "DGAC" && $_SESSION['password']== "admin"){
        ?>

            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión">
            </form>
        <?php
        } elseif ($_SESSION['username'] == "DGAC" && $_SESSION['password']== "admin"){
        ?>
            <form align="center" action="consultas/pokemones.php" method="post">
                <input type="submit" value="Ver pokemones">
            </form>
            <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión">
            </form>
            <form align="center" action="consultas/pelea_pokemon.php" method="post">
                <input type="submit" value="Ver peleas">
            </form>
            <form align="center" action="consultas/crear_pelea_pokemon.php" method="post">
                <input type="text" name="pid1">
                <input type="text" name="pid2">
                <input type="submit" value="Crear pelea">
            </form>
            <?php } else { ?>
                <form align="center" action="views/logout.php" method="post">
                <input type="submit" value="Cerrar sesión">
                </form>
                <form align="center" action="consultas/crear_pelea_pokemon.php" method="post">
                <input type="text" name="pid1">
                <input type="text" name="pid2">
                <input type="submit" value="Crear pelea">
            </form>
    <?php } }?>
    
</body>

</html>