<?php
require_once("../model/Conexion.php");
require_once("../model/userModel.php");

$conexion = new conexion();
$userConn = new Usuario($conexion->getConexion());
$conn = $conexion->getConexion();

//*Pago de monto efectivo
if (isset($_POST["monto"])) {
    $correo = $_SESSION['correo'];
    $monto = $_POST["monto"];

    $montoUs = $userConn->abonoEfectivo($monto, $correo);

    if (!$rowCr) {
        $_SESSION["msg"] = "error('Sin solicitud','No ha solicitado un credito aun.')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }

    if (!$resp) {
        $_SESSION["msg"] = "error('Digite un monto aceptable','Solo se aceptan multiplos de 100')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if (!$ver2) {
        $_SESSION["msg"] = "error('¡Monto excedido!','el monto limite a pagar es: $creditoTotal')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if (!$ver3) {
        $_SESSION["msg"] = "error('Credito no Aceptado','Su credito sigue en procceso de admision');";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if (!$ver4) {
        $_SESSION["msg"] = "error('Error','No se enviaron los datos');";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if ($ver5) {
        $_SESSION["msg"] = "success('¡Pagado!','Haz pagado por completo tu credito.')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }

    $_SESSION["msg"] = "success('¡Enviado exitosamente!','Se han enviado correctamente los datos');";
    header("location: ../view/Usuario/metodo_abono.php");
}

?>