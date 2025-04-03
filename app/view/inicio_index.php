<?php
session_start();
if (isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    if ($msg) {
        echo ("<script> alert('$msg'); </script>");

        unset($_SESSION["msg"]);
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/inicio.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        footer {
            background-color: #d3b386;
            padding: 50px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body class="gridContainer">
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../public/img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

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

                            if (empty($_SESSION['correo'])) { ?>
                                <a href="./Usuario/inicio_credito.php">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="./historia.php">
                                    <li><strong> Sobre Nosotros </strong></li>
                                </a>
                                <a href="inicio/inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="CreditosInicio.php">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="./Usuario/carrito_compra.php">
                                    <li><img src="../../public/img/carrito.png" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="./Usuario/index_.php">
                                    <li><img src="../../public/img/home.svg" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                            <?php } ?>



                        </ul>

                    </div>

                </nav>
            </div>

        </div>
    </header>
    <div  class="containerInicio">
        
          
        <div class="parrafoInicio">
            <h1>Tienda la <br> Mano de Dios</h1>

                <p class="fs-4" style="color: #77583e;">Nosotros queremos brindarles el mejor servicio y
                <br> adaptarnos a sus necesidades para ser una
                <br> microempresa conocida y poder mejorar nuestros
                <br> servicios a ustedes.
                </p>

            <?php

                if (empty($_SESSION['correo'])) { ?>
                    <a href="inicio/inicio.php"><button type="button" class="btn " style="width: 200px;"> Descubrelo</button></a>

            <?php } ?>

        </div>
                
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" id="divCarousel">
                    <img src="../../public/img/tienda.jpg" alt="..." >
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="../../public/img/tienbarri.jpg" alt="..." >
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="../../public/img/tienbarri2.jpg" alt="..." >
                </div>
            </div>
        </div> 
    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../../public/js/pago.js"></script>

</body>

</html>