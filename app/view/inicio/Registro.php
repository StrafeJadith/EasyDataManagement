<?php
require_once('../../model/Conexion.php');

$conexion = new conexion();
$conn = $conexion->getConexion();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../../public/css/inicio&&registro/Registro.css">
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

            <a href="../../model/Conexion.php"></a>
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
                            <a href="../Usuario/inicio_credito.php">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <a href="../historia.php">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>
                            <?php
                            session_start();
                            if (empty($_SESSION['correo'])) { ?>
                                <a href="./inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="../controlador/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar Sesión</button></a>

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
            <h2 class="sub1 sub-one">Nombre de usuario</h2>
            <input type="text" name="usuario" class="input1">
            <br>
            <br>
            <h2 class="sub2 sub-one">Correo electronico</h2>
            <input type="email" name="correo" class="input1">
            <br>
            <br>
            <h2 class="sub3 sub-one">Telefono</h2>
            <input type="text" name="telefono" class="input1">
            <br>
            <br>
            <h2 class="sub4 sub-one">Dirección</h2>
            <input type="text" name="direccion" class="input1">
            <br>
            <br>
            <h2 class="sub5 sub-one">Nùmero de identificaciòn</h2>
            <input type="text" name="cedula" class="input1" maxlength="10">
            <br>
            <br>
            <h2 class="sub6 sub-one">Contraseña</h2>
            <input type="password" name="contraseña" class="input1">
            <br>
            <button class="btnregistro" type="submit" name="registrate">Registrate</button>
            <a class="enlace" href="inicio.php">¿Ya tienes cuenta?</a>
        </form>
        <?php
        if (isset($_SESSION["msg"])) {
            $msg = $_SESSION["msg"];
            if ($msg) {
                echo ("<script> $msg </script>");

                unset($_SESSION["msg"]);
            }
        }
        ?>
    </section>
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