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

    // Obtener total de usuarios para calcular total de páginas
    $totalUsuariosQuery = "SELECT COUNT(*) as total FROM usuarios WHERE ID_TU = 3";
    $totalResult = mysqli_query($conn, $totalUsuariosQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalPaginas = ceil($totalRow['total'] / $usuariosPorPagina);
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
                         $query = "SELECT * FROM usuarios WHERE ID_TU = 3 LIMIT $usuariosPorPagina OFFSET $offset";
                         $resultado = mysqli_query($conn,$query);

                        while ($rowusu = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $rowusu['ID_US']; ?></td>
            <td><?php echo $rowusu['Nombre_US']; ?></td>
            <td><?php echo $rowusu['Correo_US']; ?></td>
            <td><?php echo $rowusu['Dirección_US']; ?></td>
            <td><?php echo $rowusu['Telefono_US']; ?></td>

            <td>
                <button class="editarProd" data-bs-toggle="modal" data-bs-target="#ModalEditUs<?php echo $rowusu['ID_US']; ?>">
                    <img src="../../../public/img/Administrador/Editar.png" alt="Editar" id="editarImg">
                </button>
            </td>

            <td>
                <button data-bs-toggle="modal" data-bs-target="#ModalDeleteUs<?php echo $rowusu['ID_US']; ?>">
                    <img src="../../../public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg">
                </button>
            </td>

            <?php include '../../model/Modals/ModalEliminarUs.php'; ?>
            <?php include '../../model/Modals/ModalEditarUs.php'; ?>
        </tr>
    <?php } ?>
</table>

<!-- Flechas de paginación -->
<div class="paginacion">
    <!-- Flecha izquierda -->
    <?php if ($paginaActual > 1): ?>
        <a href="?pagina=<?php echo $paginaActual - 1; ?>">
            <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior">
        </a>
    <?php else: ?>
        <!-- Imagen deshabilitada -->
        <img src="../../../public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior" style="opacity: 0.5; cursor: default;">
    <?php endif; ?>

    <!-- Flecha derecha -->
    <?php if ($paginaActual < $totalPaginas): ?>
        <a href="?pagina=<?php echo $paginaActual + 1; ?>">
            <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente">
        </a>
    <?php else: ?>
        <!-- Imagen deshabilitada -->
        <img src="../../../public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente" style="opacity: 0.5; cursor: default;">
    <?php endif; ?>
</div>


<?php 
// Mostrar mensajes de sesión si existen
if (isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
    if ($msg) {
        echo "<script> $msg </script>";
        unset($_SESSION["msg"]);
    }
}
?>
                
            </div>    
            </div>
            </div>  
    </section>
    
    <?php include '../../view/inc/footer.php' ?>