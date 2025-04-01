<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Creditos</title>
    <link rel="stylesheet" href="../../../public/css/Usuario/inicio_credito.css">
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
                    <img src="../../../public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            
                        </div>
                    </form>
                </div>


                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="../inicio_index.php">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="../productos.php">
                                <li><strong> Productos </strong></li>
                            </a>
                            <a href="">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <a href="../historia.php">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>
                            <?php
                            session_start();
                            if (empty($_SESSION['correo'])) { ?>
                                <a href="../inicio/inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="../../model/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="../productos/carrito_compra.php">
                                    <li><img src="../../../public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="./index_.php">
                                    <li><img src="../../../public/img/Usuario/home.svg" width="40px" height="40px"
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
            <br>
        <h3><strong> Solicita un crédito con nosotros</strong></h3> <br><br>
        <h4><strong> y comienza llenar tu nevera de</strong></h4> <br><br>
        <h4><strong> productos</strong></h4> <br><br>

        </p>

        <a href="../inicio/inicio.php"><button type="button" id="btn1">REGISTRATE AQUÍ</button></a>
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