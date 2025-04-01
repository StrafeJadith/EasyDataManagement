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
    <title>Clientes</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorUsuarios.css">
    <script src="../../../public/js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body>
    
    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">

            <?php require_once '../inc/MenuLateral.php' ?>

            <div class="apartadoClientes">

                <div id="tittleDashboard">
                    <h1><strong>Usuarios</strong></h1>
                </div>

                <div id="tablaUsers">

                    <div id="Reportes">
                        <a href="./ReportesUsuarios.php" class="btn" id="generarReportesUs"><strong>Generar reportes de usuarios</strong></a>
                    </div>

                    <br>
                    <table id="Cl">
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

                                
                                    
                                    $query = "SELECT * FROM usuarios WHERE ID_TU = 3";
                                    $resultadousu = mysqli_query($conn,$query);
                                    
                                    while($rowusu = mysqli_fetch_array($resultadousu)){ ?>
                                    <tr>
                                            <td><?php echo $rowusu['ID_US'] ?></td>
                                            <td><?php echo $rowusu['Nombre_US'] ?></td>
                                            <td><?php echo $rowusu['Correo_US'] ?></td>
                                            <td><?php echo $rowusu['Dirección_US'] ?></td>
                                            <td><?php echo $rowusu['Telefono_US'] ?></td>
                                        
                                            
                                            <td>
                                                <button class="editarProd" id="editarUs" name="Editar" data-bs-toggle="modal" data-bs-target="#ModalEditUs<?php echo $rowusu['ID_US']; ?>"><img src="../../../public/img/Administrador/Editar.png" alt="Editar" id="editarImg"></button>
                                            </td>
                                            
                                            <td>
                                            <button id="deleteUs" data-bs-toggle="modal" data-bs-target="#ModalDeleteUs<?php echo $rowusu['ID_US']; ?>"><img src="../../../public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg"></button>
                                            </td>
                                            <?php include '../../model/Modals/ModalEliminarUs.php' ?>
                                            <?php include '../../model/Modals/ModalEditarUs.php' ?>
                                            
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
                </div> 
            </div>  
        </div>
    </section>
    
    <?php include '../../view/inc/footer.php' ?>