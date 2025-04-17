<?php
function redireccionarCarrito(string $msg, string $location = "../view/productos.php"){
    $_SESSION["msg"] = $msg;
    header("location: $location");
    exit;

}

function carritoCompra(string $msg, string $location = "../view/Usuario/carrito_compra.php"){
    $_SESSION["msg"] = $msg;
    header("location: $location");
    exit;

}
?>