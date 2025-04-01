<?php

include("../model/Conexion.php");
$conexion = new conexion();
$conn = $conexion->getConexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="../../public/css/Productos/menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../public/img/Producto/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Buscar...                                                                               🔎        "
                                style="width: 450px; border-radius: 20px;">
                        </div>
                    </form>
                </div>

                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="inicio_index.php">
                                <li><strong>Inicio</strong></li>
                            </a>
                            <a href="productos.php">
                                <li><strong> Productos </strong></li>
                            </a>


                            <?php
                            session_start();
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
                                <a href="../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="./Usuario/carrito_compra.php">
                                    <li><img src="../../public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="./Usuario/index_.php">
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
    <section>
        <div class="contenedorprincipal">
            <div class="menu">
                <br>
                <br>
                <div class="subtitulomenu">
                    <a href="productos.php">
                        <h3>Productos</h3>
                    </a>
                </div>
                <br>
                <br>
                <div class="productos">
                    <div class="imagenalimentos">
                        <img src="../../public/img/Producto/alimentos.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Alimentos</summary>
                            <br>
                            <ul>
                                <li><a href="proteinas.php">Proteinas</a></li>
                                <li><a href="verduras.php">Verduras y Frutas</a></li>
                                <li><a href="granos.php">Granos</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Aseo">
                    <div class="imagenaseo">
                        <img src="../../public/img/Producto/aseopersonal.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Aseo personal</summary>
                            <br>
                            <ul>
                                <li><a href="">Higiene facial</a></li>
                                <li><a href="">Higiene corporal</a></li>
                                <li><a href="">Higiene bucal</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Limpieza">
                    <div class="imagenlimpieza">
                        <img src="../../public/img/Producto/aseohogar.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Limpieza del hogar</summary>
                            <br>
                            <ul>
                                <li><a href="">Limpieza diaria</a></li>
                                <li><a href="">Limpieza semanal</a></li>
                                <li><a href="">Limpieza mensual</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Otros">
                    <div class="imagenotros">
                        <img src="../../public/img/Producto/otros.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>otros</summary>
                            <br>
                            <ul>
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
            </div>
            <div class="productospopulares">
                <div class="subtitulo">
                    <h2>Productos populares</h2>
                </div>
                <div class="productoscatalogo">
                    <!-- imagenes de los productos-->
                    <center>
                        <?php
                        $sql = "SELECT * FROM productos";
                        $resultado = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($resultado)) { ?>

                            <div id="div1">
                                <form action="../controller/controllerCarrito.php" method="post">
                                    <div class="imagenpro">
                                        <img src="<?php echo $row['Img'] ?>" alt="" class="imgpro"><br>
                                    </div>
                                    <div class="nombrepro">
                                        <input type="hidden" name="Nombre_PRO" value="<?php echo $row['Nombre_PRO'] ?>">
                                        <input type="hidden" name="ID_PRO" value="<?php echo $row['ID_PRO'] ?>">
                                        <strong><?php echo $row['Nombre_PRO'] ?></strong><br>
                                    </div>
                                    <br>
                                    <div class="descripcionpro">
                                        <p class="descripcion"><?php echo $row['Descripcion_PRO'] ?></p>
                                    </div>
                                    <div class="preciopro">
                                        <input type="hidden" name="Precio" value="<?php echo $row['Valor_Unitario'] ?>">
                                        <strong><?php echo $row['Valor_Unitario'] ?></strong><br>
                                        <input type="number" placeholder="Cantidad" size="10" name="Cantidad">
                                    </div>
                                    <div class="agregarcarrito">
                                        <br>
                                        <button type="submit" name="Guardar" value="">Agregar al carrito</button>
                                    </div>
                                </form>
                            </div>

                        <?php } ?>
                    </center>
                    <?php
                    if (isset($_SESSION["msg"])) {
                        $msg = $_SESSION["msg"];

                        if ($msg) {
                            echo ("<script> $msg </script>");

                            unset($_SESSION["msg"]);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
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