<?php
include("../../model/Conexion.php");

session_start();

if (empty($_SESSION['correo'])) {
    header("location: ../registro/inicio.php");
    session_destroy();
    die();
}

$conexion = new Conexion();
$conn = $conexion->getConexion();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorDashboard.css">

</head>

<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>

        <div class="contenedorprincipal">

            <?php require_once '../inc/MenuLateral.php' ?>

            <?php


            function ObtenerCount($table, $conn)
            {

                $sqlQuery = "SELECT COUNT(*) as numus FROM $table";
                $Result = mysqli_query($conn, $sqlQuery);

                if (mysqli_num_rows($Result) > 0) {

                    $ResultRow = mysqli_fetch_array($Result);
                    $VariableIterador = $ResultRow['numus'];
                }

                return $VariableIterador;
            }

            ?>


            <div class="apartado">

                <div class="APclientes">

                    <div class="imagenclientes">

                        <img src="../../../public/img/Administrador/Usuarios.png" alt="">

                    </div>

                    <div class="clientes">

                        <h3>Usuarios</h3>

                    </div>

                    <div class="span1">

                        <span><?= ObtenerCount('usuarios', $conn); ?></span>

                    </div>

                </div>

                <div class="APproductos">

                    <div class="imagenproducto">

                        <img src="../../../public/img/Administrador/Productos.png" alt="">

                    </div>

                    <div class="productos2">

                        <h3>Productos</h3>

                    </div>

                    <div class="span2">

                        <span><?= ObtenerCount('productos', $conn); ?></span>

                    </div>

                </div>

                <div class="APexistencias">

                    <div class="imagenesexistencias">

                        <img src="../../../public/img/Administrador/Existencias.png" alt="">

                    </div>

                    <div class="existencias">

                        <h3>Existencias</h3>

                    </div>

                    <div class="span3">

                        <span>

                            <?php

                            $sqlSuma = "SELECT SUM(Cantidad_Total) AS Existencias FROM productos;";
                            $sqlSumaResult = mysqli_query($conn, $sqlSuma);

                            if (mysqli_num_rows($sqlSumaResult) > 0) {

                                $ResultRowSum = mysqli_fetch_array($sqlSumaResult);
                                $ResultSuma = $ResultRowSum['Existencias'];
                                echo $ResultSuma;
                            }

                            ?>
                        </span>

                    </div>

                </div>

                <div class="APexistenciasvendida">

                    <div class="imagenesexistenciasvendida">

                        <img src="../../../public/img/Administrador/Existencias.png" alt="">

                    </div>

                    <div class="existenciasvendidas">

                        <h3>Existencias <br> Vendidas</h3>

                    </div>

                    <div class="span4">

                        <span>

                            <?php

                            $sqlSuma1 = "SELECT SUM(Cantidad_Total) - SUM(Cantidad_Existente) AS ExistenciasVendidas FROM productos";
                            $sqlSuma1Result = mysqli_query($conn, $sqlSuma1);

                            if (mysqli_num_rows($sqlSuma1Result) > 0) {

                                $sqlResta = mysqli_fetch_array($sqlSuma1Result);
                                $ResultResta = $sqlResta['ExistenciasVendidas'];
                                echo $ResultResta;
                            }

                            ?>
                        </span>

                    </div>

                </div>

                <div class="APcreditos">

                    <div class="ImagenesCredito">

                        <img src="../../../public/img/Administrador/Creditos.png" alt="">

                    </div>

                    <div class="Credito">

                        <h3>Creditos</h3>

                    </div>

                    <div class="span5">

                        <span><?= ObtenerCount('credito', $conn); ?></span>

                    </div>

                </div>

                <div class="APventas">

                    <div class="Imagenesventas">

                        <img src="../../../public/img/Administrador/Ventas.png" alt="">

                    </div>

                    <div class="Ventas">

                        <h3>Ventas</h3>

                    </div>

                    <div class="span6">

                        <span><?= ObtenerCount('ventas', $conn); ?></span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php include '../../view/inc/footer.php' ?>