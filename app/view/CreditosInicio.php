<?php

require_once("../model/Conexion.php");

$conexion = new conexion();
$conn = $conexion->getConexion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Creditos</title>
    <link rel="stylesheet" href="../../public/css/CreditosInicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body id="bodyCreditos">



    <!-- HEADER -->
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                        </div>
                    </form>
                </div>


                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="inicio_index.php">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="productos.php">
                                <li><strong> Productos </strong></li>
                            </a>


                            <?php
                            session_start();
                            if (empty($_SESSION['correo'])) { ?>
                                <a href="CreditosInicio.php">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="historia.php">
                                    <li><strong> Sobre Nosotros </strong></li>
                                </a>
                                <a href="inicio/inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="CreditosInicio.php">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="Usuario/carrito_compra.php">
                                    <li><img src="../../public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="usuario/index_.php">
                                    <li><img src="../../public/img/home.svg" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                            <?php } ?>


                        </ul>

                    </div>

                </nav>
            </div>

        </div>
    </header>


    <!--CONTEXTO DE LA PAGINA O ARTICULOS -->

    <div id="content">
        <p>
        <h3><strong> Solicitar un credito nunca habia sido tan facil.</strong></h3> <br><br>
        <li><strong> Facil de usar. </strong></li><br>
        <li><strong> Facilita los procesos de credito presenciales. </strong></li><br>
        <li><strong> Control de tus transacciones y estado en la tienda. </strong></li><br>
        <li><strong> Haz transacciones con facilidad desde cualquier dispositivo. </strong></li><br>
        </p>

        <?php

        if (!empty($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];
            $sql = "SELECT * FROM credito WHERE Correo_CR = '$correo'";
            $resultado = mysqli_query($conn, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                header("location: Usuario/gasto credito.php");
            }
        }

        if (!empty($_SESSION['correo'])) { ?>
            <a href="inicio/credito.php"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } else { ?>
            <a href="inicio/inicio.php"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } ?>


    </div>


    <!--FOOTER-->

    <footer class="footerContainer ">
        <div class="contactos ">
            <h1>Contactanos</h1>
        </div>
        <div class="socialIcons ">
            <a href><i class="fa-brands fa-facebook "></i></a>
            <a href><i class="fa-brands fa-whatsapp "></i></a>
            <a href><i class="fa-brands fa-twitter "></i></a>
            <a href><i class="fa-brands fa-google "></i></a>
        </div>
    </footer>

</body>

</html>