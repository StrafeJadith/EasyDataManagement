<?php

require_once("../../model/Conexion.php");

$conexion = new conexion();
$conn = $conexion->getConexion();


session_start();
if (empty($_SESSION['correo'])) {
    header("location: ../registro/inicio.php");
    session_destroy();
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existencias</title>
    <link rel="stylesheet" href="../../../public/css/vendedor/Existencias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../../public/img/Usuario/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Buscar...                                                                               🔎        "
                                style="width: 450px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="contenedorprincipal">
            <div class="menu">
                <br>
                <div class="imagen1">
                    <img src="../../../public/img/Usuario/iconousuario.png.png" alt="">
                </div>
                <div class="correo">
                    <?php
                    $correo = $_SESSION['correo'];
                    $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_US = '$correo'";
                    $resultado = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($resultado)) {
                        $nombre = $row['Nombre_US'];
                    }
                    echo "Bienvenido " . $nombre . "<br>";
                    echo $correo;
                    ?>
                </div>
                <br>
                <br>
                <div class="subtitulomenu">
                    <a href="menu.php">
                        <h3>Menú</h3>
                    </a>
                </div>
                <br>
                <div class="usuarios">
                    <div class="imagenusuarios">
                        <img src="../../../public/img/Usuario/Usuarios.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <a href="usuarios.php">
                            <h4>Usuarios</h4>
                        </a>
                    </div>
                </div>
                <div class="productos">
                    <div class="imagenproductos">
                        <img src="../../../public/img/Usuario/Productos.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Productos</summary>
                            <br>
                            <ul>
                                <li><a href="existencias.php">Existencias</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="creditos">
                    <div class="imagencreditos">
                        <img src="../../../public/img/Usuario/Creditos.png" alt="">
                    </div>
                    <div class="creditossubtitulo">
                        <a href="creditosUsuario.php">
                            <h4>Creditos</h4>
                        </a>
                    </div>
                </div>

            </div>
            <div class="apartados">
                <h3 class="titulotabla">Existencias Productos</h3>
                <div class="contenedorusuarios">
                    <table class="tablausuarios">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>NOMBRE</td>
                                <td>DESCRIPCION</td>
                                <td>CATEGORIA</td>
                                <td>VALOR_UNITARIO</td>
                                <td>CANTIDAD_TOTAL</td>
                                <td>CANTIDAD_EXISTENTES</td>
                                <td>FECHA_ENTRADA</td>
                                <td>FECHA_EXPEDICION</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = ("SELECT * FROM productos");

                            $ejecucion = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_array($ejecucion)) { ?>
                                <tr>
                                    <td><?php echo $row['ID_PRO'] ?></td>
                                    <td><?php echo $row['Nombre_PRO'] ?></td>
                                    <td><?php echo $row['Descripcion_PRO'] ?></td>
                                    <td><?php echo $row['Categoria_PRO'] ?></td>
                                    <td><?php echo $row['Valor_Unitario'] ?></td>
                                    <td><?php echo $row['Cantidad_Total'] ?></td>
                                    <td><?php echo $row['Cantidad_Existente'] ?></td>
                                    <td><?php echo $row['Fecha_Entrada'] ?></td>
                                    <td><?php echo $row['Fecha_Expedicion'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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