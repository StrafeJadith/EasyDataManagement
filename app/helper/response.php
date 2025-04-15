<?php
function redireccionarCarrito(string $msg, string $location = "../view/productos.php"){
    $_SESSION["msg"] = $msg;
    header("location: $location");
    exit;

}

?>