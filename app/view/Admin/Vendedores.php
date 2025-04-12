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

    $usuariosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $usuariosPorPagina;

    $totalUsuariosQuery = "SELECT COUNT(*) as total FROM usuarios WHERE ID_TU = 2";
    $totalResult = mysqli_query($conn, $totalUsuariosQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalPaginas = ceil($totalRow['total'] / $usuariosPorPagina);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedores</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorUsuarios.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">
            
            <?php require_once '../inc/MenuLateral.php' ?>
    

            <div class="apartadoVendedores">
                <div id="tittleDashboard">
                    <h1><strong>Vendedores</strong></h1>
                </div>
                

                <div class="TablaAgregarVen">
                    <button id="aggVen" data-bs-toggle="modal" data-bs-target="#ModalVen"><strong>Agregar Vendedores</strong></button>
                        <div id="Reportes">
                            <a href="./ReportesVendedores.php" class="btn" id="generarReportesVen" type="submit"><strong>Generar reportes de vendedores</strong></a>
                        </div>
                    <table id="TableVen">
                        <tr>
                            <td><strong>IDENTIFICACION</strong></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>CORREO</strong></td>
                            <td><strong>DIRECCION</strong></td>
                            <td><strong>TELEFONO</strong></td>
                            <td><strong>EDITAR</strong></td>
                            <td><strong>ELIMINAR</strong></td>
                            
                            
                        </tr>                  
                        <tbody>
                            
                            
                                <?php

                                
                                    
                                    $queryVen = "SELECT * FROM usuarios WHERE ID_TU = 2 LIMIT $usuariosPorPagina OFFSET $offset";
                                    $resultadoVen = mysqli_query($conn,$queryVen);
                                    
                                    while($rowVen = mysqli_fetch_array($resultadoVen)){ ?>
                                    <tr>
                                            <td><?php echo $rowVen['ID_US'] ?></td>
                                            <td><?php echo $rowVen['Nombre_US'] ?></td>
                                            <td><?php echo $rowVen['Correo_US'] ?></td>
                                            <td><?php echo $rowVen['Dirección_US'] ?></td>
                                            <td><?php echo $rowVen['Telefono_US'] ?></td>
                                        
                                            
                                            <td>
                                                <button class="editarVen" id="editarVendedor" name="Editar" data-bs-toggle="modal" data-bs-target="#ModalEditVen<?php echo $rowVen['ID_US']; ?>"><img src="../../../public/img/Administrador/Editar.png" alt="Editar" id="editarImg"></button>
                                            </td>
                                            
                                            <td>
                                            <button id="deleteVendedor" data-bs-toggle="modal" data-bs-target="#ModalEliminarVen<?php echo $rowVen['ID_US']; ?>"><img src="../../../public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg"></button>
                                            </td>
                                            <?php include '../../model/Modals/ModalEliminarVen.php' ?>
                                            <?php include '../../model/Modals/ModalEditVen.php' ?>
                                            
                                    <?php } ?>    
                                    <?php 
                                        if(isset($_SESSION["msg"])){
                                            $msg = $_SESSION["msg"];
                                            if($msg){
                                                echo("<script> $msg </script>");

                                                unset($_SESSION["msg"]);
                                            }
                                        }
                                    ?>
                                    
                            </tr>  
                        </tbody>   
                    </table>
                            <?php include '../../model/Modals/ModalVen.php' ?>

                            <div class="paginacion">

                                <?php if ($paginaActual > 1): ?>
                                    <a href="?pagina=<?php echo $paginaActual - 1; ?>">
                                        <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior">
                                    </a>

                                    <?php else: ?>
                                        <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                                    
                                    <?php if ($paginaActual < $totalPaginas): ?>
                                        <a href="?pagina=<?php echo $paginaActual + 1; ?>">
                                            <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente">
                                        </a>
                                    
                                    <?php else: ?>
                                        <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                            </div>
                            
                </div>
            </div>
        </div>
    </section>
    
    <?php include '../../view/inc/footer.php' ?>