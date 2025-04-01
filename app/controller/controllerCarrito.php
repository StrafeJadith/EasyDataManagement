<?php
require_once("../model/Conexion.php");
require_once("../model/carritoModel.php");

$conexion = new conexion();
$carritoConn = new Carrito($conexion->getConexion());
$conn = $conexion->getConexion();

//! Guardar productos en el carrito
if (isset($_POST["guardar"])) {
    $correo = $_POST["correo"];
    $ID = intval($_POST['ID_PRO']);
    $nombre = $_POST['Nombre_PRO'];
    $precio = intval($_POST['Precio']);
    $cantidad = intval($_POST['Cantidad']);

    if (empty($_SESSION['correo'])) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Iniciar sesion','Debe iniciar sesion primero');";
        header("location: ../view/productos.php");
        return;

    }
    $carritoUs = $carritoCon->guardarProducto($correo, $ID, $nombre, $precio, $cantidad);

    if ($resul1) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Error en la consulta','Test')";
        header("location: ../view/productos.php");
        return;
    }

    if ($cants[0] > $cants[1]) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Error','La cantidad escogida $cants[0] es mayor a la cantidad existente $cants[1] del producto' );";
        header("location: ../view/productos.php");
        return;

    }

    if ($cantidad) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Campo vacio','Por favor llene el campo cantidad con la cantidad de producto que quiera comprar del producto')";
        header("location: ../view/productos.php");
        return;
    }

    if ($result) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Error','No se pudo añadir el producto al carrito')";
        header("location: ../view/productos.php");
        return;
    }

    if ($re4) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "error('Error','Error en buscar cantidad')";
        header("location: ../view/productos.php");
        return;
    }

    if ($result1) {
        echo ("<script>console.log('Hola')</script>");
        $_SESSION["msg"] = "success('¡Producto agregado exitosamente!','El producto $nombre fue agregado al carrito, dirijase a el para aceptar la compra')";
        header("location: ../view/productos.php");
        return;
    }
    echo ("<script>console.log('Hola')</script>");
}

?>