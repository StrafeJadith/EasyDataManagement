<?php
require_once("../model/Conexion.php");
require_once("../model/carritoModel.php");

$conexion = new conexion();
$carritoConn = new Carrito($conexion->getConexion());
$conn = $conexion->getConexion();

// Guardar productos en el carrito
if (isset($_POST["Guardar"])) {
    $correo = $_SESSION["correo"];
    $ID = intval($_POST['ID_PRO']);
    $nombre = $_POST['Nombre_PRO'];
    $precio = intval($_POST['Precio']);
    $cantidad = intval($_POST['Cantidad']);

    if (empty($_SESSION['correo'])) {
        $_SESSION["msg"] = "error('Iniciar sesion','Debe iniciar sesion primero');";
        header("location: ../view/productos.php");
        return;

    }
    $carritoUs = $carritoConn->guardarProducto($correo, $ID, $nombre, $precio, $cantidad);

    if ($carritoUs["ver0"] === false) {
        $_SESSION["msg"] = "error('Campo vacio','Por favor llene el campo cantidad con la cantidad de producto que quiera comprar del producto')";
        header("location: ../view/productos.php");
        return;
    }
    if ($carritoUs["ver1"] === false) {
        $_SESSION["msg"] = "error('Error en la consulta','Test')";
        header("location: ../view/productos.php");
        return;
    }

    if ($carritoUs["cantidad"] > $carritoUs["cantex"]) {
        $_SESSION["msg"] = "error('Error','La cantidad escogida {$carritoUs['cantidad']} es mayor a la cantidad existente {$carritoUs['cantex']} del producto' );";
        header("location: ../view/productos.php");
        return;

    }

    if ($carritoUs["ver2"] === false) {
        $_SESSION["msg"] = "error('Error','No se pudo añadir el producto al carrito')";
        header("location: ../view/productos.php");
        return;
    }

    if ($carritoUs["ver3"] === false) {
        $_SESSION["msg"] = "error('Error','Error en buscar cantidad')";
        header("location: ../view/productos.php");
        return;
    }

    $_SESSION["msg"] = "success('¡Producto agregado exitosamente!','El producto $nombre fue agregado al carrito, dirijase a el para aceptar la compra')";
    header("location: ../view/productos.php");
    return;
}

//Cancelar Productos
if (isset($_GET['IDCancelar'])) {
    $ID = $_GET['IDCancelar'];

    $carritoUs = $carritoConn->cancelarProducto($ID);

    if ($carritoUs['mos0'] === false) {

        $_SESSION["msg"] = "success('¡Producto cancelado exitosamente!','El producto $nombre cancelado del carrito de compra')";
        header("location: ../view/Usuario/carrito_compra.php");

    } else {
        echo (" <script>alert('error')</script>");
    }

    header("location: ../view/Usuario/carrito_compra.php");

}
?>