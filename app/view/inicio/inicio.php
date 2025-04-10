<?php

require_once("../../model/Conexion.php");

// esta función se usa para iniciar o reanudar una sesión
session_start();

$conexion = new conexion();
$conn = $conexion->getConexion();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="../../../public/css/inicio&&registro/Inicio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<style>
    .btn {
        background-color: #804e23;
        color: white;
        border-radius: 100px;
        width: 170px;
        font-size: 19px;
        margin-left: 150px;
        margin-top: -10px;
    }

    .btn:hover {
        background-color: beige;
        color: #804e23;
        border-radius: 100px;
    }

    h3 {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #804e23;
        font-size: 35px;
    }

    .linea {
        margin-top: 25px;
        padding: 3px;
        background-color: #804e23;
        height: 5px;
        border: none;

    }

    .botonregistrate {
        background-color: #804e23;
        color: white;
        border-radius: 50px;
        border: #804e23;
        width: 200px;
        height: 50px;
        font-size: 20px;

    }

    .Listas a {
        text-decoration: none;
    }
</style>

<body>

    <header id="headerCreditos">
        <div id="barranav">

            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../../public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">

                        </div>
                    </form>
                </div>

                <nav id="Nav">
                    <div id="NavList">

                        <ul class="Listas">
                            <a href="../inicio_index.php">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="../productos.php">
                                <li><strong> Productos </strong></li>
                            </a>
                            <a href="../CreditosInicio.php">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <a href="../historia.php">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>
                            <?php

                            if (empty($_SESSION['correo'])) { ?>
                                <a href="inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="../../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="../productos/carrito_compra.php">
                                    <li><img src="./imagenes/Carrito.png" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="../Usuario/index_.php">
                                    <li><img src="../inicio_productos/img/home.svg" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                            <?php } ?>

                        </ul>

                    </div>

                </nav>
            </div>

        </div>
    </header>

    <section class="Registro">
        <div class="cabecera">
            <ul class="Registro">
                <li>
                    <h3><a href="inicio.php" style="text-decoration: none;">INICIAR SESIÓN</a></h3>
                </li>
                <li>
                    <h3>
                        <a href="Registro.php">REGÍSTRATE</a>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="linea"></div>
        <br>
        <br>
        <form action="../../controller/controllerInicio.php" method="post">
            <h2 class="sub-one">Correo electrónico</h2>
            <input class="sub-two" type="text" name="correo" value="">
            <br>
            <br>
            <h2 class="sub-one">Contraseña</h2>
            <input class="sub-two" type="password" name="contraseña" value="">
            <br>
            <br>
            <a class="otc" href="olvido_contraseña.php">¿olvidaste tu contraseña?</a>
            <br>
            <br>
            <a class="btn-c" href="Registro.php">Crear cuenta</a>
            <br>
            <br>
            <input class="btn-inc" type="submit" name="iniciar" value="Iniciar Sesión">
            <br>
            <br>
            <br>
        </form>

    </section>

    <?php

    if (isset($_SESSION["msg"])) {
        $msg = $_SESSION["msg"];

        if ($msg) {
            echo ("<script> $msg </script>");

            unset($_SESSION["msg"]);
        }
    }


    ?>
    <footer class="footerContainer">
        <div class="contactos">
            <h1>Contactanos</h1>
        </div>
        <div class="socialIcons">
            <a href><i class="fa-brands fa-facebook"></i></a>
            <a href><i class="fa-brands fa-whatsapp"></i></a>
            <a href><i class="fa-brands fa-twitter"></i></a>
            <a href><i class="fa-brands fa-google"></i></a>
        </div>
    </footer>
</body>

</html>