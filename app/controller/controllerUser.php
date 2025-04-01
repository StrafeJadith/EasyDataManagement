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

    if ($montoUs["ver0"] === False) {
        $_SESSION["msg"] = "error('Sin solicitud','No ha solicitado un credito aun.')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }

    if ($montoUs["ver1"] === False) {
        $_SESSION["msg"] = "error('Digite un monto aceptable','Solo se aceptan multiplos de 100')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if ($montoUs["ver2"] === False) {
        $_SESSION["msg"] = "error('¡Monto excedido!','el monto limite a pagar es:{$montoUs['valor']}')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if ($montoUs["ver3"] === False) {
        $_SESSION["msg"] = "error('Credito no Aceptado','Su credito sigue en procceso de admision');";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if ($montoUs["ver4"] === False) {
        $_SESSION["msg"] = "error('Error','No se enviaron los datos');";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }
    if ($montoUs["ver5"] === True) {
        $_SESSION["msg"] = "success('¡Pagado!','Haz pagado por completo tu credito.')";
        header("location: ../view/Usuario/metodo_abono.php");
        return;
    }

    $_SESSION["msg"] = "success('¡Enviado exitosamente!','Se han enviado correctamente los datos');";
    header("location: ../view/Usuario/metodo_abono.php");
}

?>