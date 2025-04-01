<?php

    include("../model/Conexion.php");
    session_start();
    $conexion = new conexion();
    $conn = $conexion->getConexion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quienes Somos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/Usuario/historia.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
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
                            <a href="./inicio_index.php">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="./productos.php">
                                <li><strong> Productos </strong></li>
                            </a>
                            
                            <?php
                                
                                if(empty($_SESSION['correo'])){?>

                                  <a href="./Usuario/inicio_credito.php">
                                <li><strong> Creditos </strong></li>
                                  </a>
                                  <a href="./historia.php">
                                  <li><strong> Sobre Nosotros </strong></li>
                                   </a>
                                    <a href="./inicio/inicio.php"><button type="button" class="btn">Iniciar
                                    Sesion</button></a>
                                    
                               <?php }else{ ?>
                                <a href="./CreditosInicio.php">
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
                               <?php }?> 
                            

                        </ul>


                    </div>

                </nav>
            </div>
        </div>
    </header>
    <br>
    <br>
    <div class="historia">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1 style="text-align: center;"><strong>HISTORIA</strong></h1>
        <p>Desde sus inicios, La mano de Dios se ubico en el barrio Villa Lozano de Soledad, fue creada en el año 2004, tuvo inicios simples y una clientela que iba comenzando a llegar con el tiempo, a traves de los años la tienda la mano de Dios fue formando
            su clientela diaria, la cual constaba de la comunidad de sus alrededores, ha seguido vigente diecinueve años desde su creacion y su presencia en la comunidad no es facilmente olvidable a la memoria de sus vecinos.</p>
    </div>

    <div class="row">
        <div class="mision">
            <h4 class="mision2"><strong>MISION</strong></h4>
            <p class="mision3">La tienda la mano de Dios tiene como mision y objetivo el dar el mejor servicio de atencion al cliente de forma rapida, precisa y segura, en el cual se podra atender a la comunidad de forma comoda y se podran realizar prestaciones, proporcionando
                asi a los alrededores un buen servicio en el cual se llenen todas las necesidades que una tienda comun y corriente provee a la comunidad.
            </p>
        </div>
        <div class="vision">
            <h4 class="vision2"><strong>VISION</strong></h4>
            <p class="vision3">La tienda la mano de Dios tiene su vision clara, planea ver por el futuro de la tienda, planea permanecer vigente a largo plazo permitiendo asi que la comunidad de los alrededores no solo sean atendidos de forma eficiente y buena, sino que
                garantiza que la tienda seguira
            </p>
        </div>
    </div>
    <footer class="footerContainer ">
        <div class="Contactos ">
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