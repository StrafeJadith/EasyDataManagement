<?php
require_once("../model/Conexion.php");
require_once("../model/carritoModel.php");
require_once("../helper/response.php");
require("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conexion = new conexion();
$carritoConn = new Carrito($conexion->getConexion());
$conn = $conexion->getConexion();

//* Guardar productos en el carrito
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

    if (empty($cantidad)) {
        $_SESSION["msg"] = "error('Campo vacio','Por favor llene el campo cantidad con la cantidad de producto que quiera comprar del producto')";
        header("location: ../view/productos.php");
        return;
    }

    $carritoUs = $carritoConn->guardarProducto($correo, $ID, $nombre, $precio, $cantidad);


    if ($carritoUs["ver1"] === false) {
        redireccionarCarrito("error('Error en la consulta','Test')");
    }

    if ($carritoUs["cantidad"] > $carritoUs["cantex"]) {
        redireccionarCarrito("error('Error','La cantidad escogida {$carritoUs['cantidad']} es mayor a la cantidad existente {$carritoUs['cantex']} del producto');");
    }
    if($carritoUs["ver5"] ===false){
        redireccionarCarrito("error('Digite un numero apto', 'Digite un numero mayor a 0 ')");
    }
    if ($carritoUs["ver2"] === false) {
        redireccionarCarrito("error('Error','No se pudo añadir el producto al carrito');");
    }

    redireccionarCarrito("success('¡Producto agregado exitosamente','El producto $nombre fue agregado al carrito')");
    
}




//*Cancelar Productos
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
//*Pagar producto con credito
if (isset($_POST['mcredito'])) {
    $correo = $_SESSION["correo"];
    $pago = 002;

    $carritoUs = $carritoConn->compraCredito($correo, $pago);

    if ($carritoUs["ver0"] === false) {
        $_SESSION["msg"] = "error('Credito inactivo','No puede pagar con creditos porque no tiene uno activo en la tienda.')";
        header("location: ../view/Usuario/carrito_compra.php");
        return;
    }

    if ($carritoUs["ver1"] === false) {
        $_SESSION["msg"] = "error('Error','No tienes suficiente credito para realizar esta compra')";
        header("location: ../view/Usuario/carrito_compra.php");
        return;
    }


    if ($carritoUs["ver2"] === false) {
        $_SESSION["msg"] = "error('Error','El producto no se encuentra disponible')";
        header("location: ../view/Usuario/carrito_compra.php");
        return;
    }
    if ($carritoUs["ver3"] === false) {
        $_SESSION["msg"] = "error('Error','Producto no disponible')";
        header("location: ../view/Usuario/carrito_compra.php");
        return;
    }
    $_SESSION["msg"] = "success('¡Compra exitosa!','Compra realizada con exito')";
    header("location: ../view/Usuario/carrito_compra.php");
    return;

}


//Pagar con Efectivo

if (isset($_POST['mefectivo'])) {
    $pago = 001;
    $correo = $_SESSION['correo'];


    $carritoUs = $carritoConn->compraEfectivo($correo, $pago);
    if ($carritoUs['mos0'] === false) {
        die('error');
    } else {
        $_SESSION["msg"] = "success('¡Compra exitosa!','Compra realizada con exito')";

    }

    header("location: ../view/Usuario/carrito_compra.php");


}

?>