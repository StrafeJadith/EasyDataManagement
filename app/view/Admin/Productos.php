<?php 
    require_once "../../model/Conexion.php";
    
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
    <title>Productos</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorProductos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">
            
            <?php require_once '../inc/MenuLateral.php' ?>

            <div class="apartadoProductos">

                <div id="tittleDashboard">
                    <h1><strong>Productos</strong></h1>
                </div>

                

                <div id="tablaProductos">

                    <button class="AggProd" data-bs-toggle="modal" data-bs-target="#ModalPro"><strong>Agregar Productos</strong></button>
                    <br><br><br>

                    <div id="Reportes">
                        <a href="./ReportesProductos.php" class="btn" id="generarReportesProd"><strong>Generar reportes de vendedores</strong></a>
                    </div>

                    
                    <table id="tablaProd">
                        <tr>
                            <td><strong>PRODUCTOS</strong></td>
                            <td><strong>ID</strong></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>DESCRIPCION</strong></td>
                            <td><strong>CATEGORIA</strong></td>
                            <td><strong>VALOR UNITARIO</strong></td>
                            <td><strong>CANTIDAD TOTAL</strong></td>
                            <td><strong>CANTIDAD EXISTENTE</strong></td>
                            <td><strong>FECHA ENTRADA</strong></td>
                            <td><strong>FECHA SALIDA</strong></td>
                            <td><strong>EDITAR</strong></td>
                            <td><strong>ELIMINAR</strong></td>
                            
                            
                        </tr>

                        <tbody>
                        
                            <?php
    
                                $query = "SELECT c.Nombre_CAT,p.* FROM productos p, categoria_producto c where p.ID_CAT = c.ID_CAT";
                                $resultado = mysqli_query($conn,$query);
                                
                                
                                while($row = mysqli_fetch_array($resultado)){ ?>
                                <tr>
                                        <td><img src='../<?= $row['Img']; ?>' alt=""></td>
                                        <td><?php echo $row['ID_PRO'] ?></td>
                                        <td><?php echo $row['Nombre_PRO'] ?></td>
                                        <td><?php echo $row['Descripcion_PRO'] ?></td>
                                        <td><?php echo $row['Categoria_PRO'] ?></td>
                                        <td><?php echo $row['Valor_Unitario'] ?></td>
                                        <td><?php echo $row['Cantidad_Total'] ?></td>
                                        <td><?php echo $row['Cantidad_Existente'] ?></td>
                                        <td><?php echo $row['Fecha_Entrada'] ?></td>
                                        <td><?php echo $row['Fecha_Expedicion']?></td>
                                        
                                        <td>
                                            <button id="editPro" class="editarProd" name="EditarProd" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['ID_PRO']; ?>"><img src="../../../public/img/Administrador/Editar.png" alt="Editar" id="editImg"></button></td>
                                        
                                        <td>
                                            <button id="deletePro" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['ID_PRO']; ?>"><img src="../../../public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg"></button>
                                        </td>
                                        
                                        
                                        <?php include("../../model/Modals/ModalEditar.php") ?>
                                        <?php include("../../model/Modals/ModalEliminar.php") ?>
                                <?php } ?>    
                                    
                        </tr>  
                        </tbody>
                                
                    </table>
                    
                    <?php require_once '../../model/Modals/modal_agregar_productos.php' ?>

                    <?php 
                        
                        if(isset($_SESSION["msg"])){
                            $msg = $_SESSION["msg"];
                            if($msg){
                                echo("<script> $msg </script>");
                                unset($_SESSION["msg"]);
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </section>

        
    <?php include '../../view/inc/footer.php' ?>