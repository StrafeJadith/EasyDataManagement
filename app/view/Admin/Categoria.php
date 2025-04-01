<?php  
    include("../../model/Conexion.php");

    session_start();

    if(empty($_SESSION['correo'])){
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
    <title>Categoria</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorCategorias.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">

            <?php require_once '../inc/MenuLateral.php' ?>

            <div class="apartadoCategoria">
                    <div id="tittleDashboard">

                        <h1><strong>Categorias</strong></h1>

                    </div>
            
                <div id="ContenidoCat">

                    <!--modal de agregar categorias -->
                    <button type="button" class="btn1 btn btn-info" data-bs-toggle="modal" data-bs-target="#guardar_cat" id="btnNuevaCat"><strong>Nueva Categoria</strong></button>
                    <br><br>

                    <?php  include('../../model/Modals/modal_guardar_categoria.php'); ?>
                    

                    <table id="tablaCat">
                    
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <Tbody>
                            <?php 
                                $query = "SELECT * FROM categoria_producto";
                                $resul_tareas = mysqli_query($conn, $query);

                                while($row = mysqli_fetch_array($resul_tareas)){
                            ?>

                            <tr>
                                <td><?php echo $row['ID_CAT']?></td>
                                <td><?php echo $row['Nombre_CAT']?></td>
                                <td>
                    
                                    <div id="editCat" data-bs-toggle="modal" data-bs-target="#editar_categoria<?php echo $row['ID_CAT']?>"><img src="../../../public/img/Administrador/Editar.png" alt="" class="btnedit" id="editImg"></div>
                                
                                </td>

                                <td>

                                <div id="deleteCat" data-bs-toggle="modal" data-bs-target="#delete_categoria<?php echo $row['ID_CAT']?>"><img src="../../../public/img/Administrador/Eliminar.png" alt="" class="btnedit" id="deleteImg"></div>
                                    
                                </td>
                            </tr>
                            <?php
                            if(isset($_SESSION["msg"])){
                                $msg = $_SESSION["msg"];

                                if($msg){
                                    echo("<script> $msg </script>");

                                    unset($_SESSION["msg"]);
                                }
                            }


                            ?>
                        <?php
                                include('../../model/Modals/modal_edit_categoria.php');
                                include('../../model/Modals/modal_delete_categoria.php'); }?>
                        </Tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include '../../view/inc/footer.php' ?>