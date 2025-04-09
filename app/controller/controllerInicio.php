<?php

require_once("../model/Conexion.php");
require_once("../model/modeloInicio.php");



$conexion = new conexion();
$conexionBD = $conexion->getConexion();
$personamodel = new Registro($conexionBD);

//Registro de usuario
if (isset($_POST['registrate'])) {

    $usuario = $_REQUEST['usuario'];
    $correo = $_REQUEST['correo'];
    $telefono = $_REQUEST['telefono'];
    $direccion = $_REQUEST['direccion'];
    $cedula = $_REQUEST['cedula'];
    $contraseña = $_REQUEST['contraseña'];
    define("id_rol", 3);

    if (!empty($usuario) && !empty($correo) && !empty($telefono) && !empty($direccion) && !empty($cedula) && !empty($contraseña)) {

        $guardarPersonasql = $personamodel->guardarPersona($usuario, $correo, $telefono, $direccion, $cedula, $contraseña);

        if ($guardarPersonasql) {
            $_SESSION['msg'] = "success('¡Usuario registrado!','Usuario registrado satisfactoriamente.')";
        } else {
            $_SESSION['msg'] = "error('¡Cedula Existente!','Esta cedula ya esta registrada.')";
        }
    } else {
        $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.');";
    }

    header("location: ../view/inicio/Registro.php");
}

//Iniciar sesion

if (isset($_REQUEST['iniciar'])) {

    $correo = $_REQUEST['correo'];
    $contraseña = $_REQUEST['contraseña'];

    if (!empty($correo) && !empty($contraseña)) {

        $iniciodesesion = $personamodel->InicioDeSesion($correo, $contraseña);

        switch ($iniciodesesion) {
            case '1':
                $_SESSION['correo'] = $correo;
                header("location: ../view/Admin/Administrador.php");
                break;
            case '2':
                $_SESSION['correo'] = $correo;
                header("location: ../view/Vendedor/menu.php");
                break;
            case '3':
                $_SESSION['correo'] = $correo;
                header("location: ../view/Usuario/index_.php");
                break;
            default:
                $_SESSION["msg"] = "error('Usuario o contraseña incorrecta','Ingrese un usuario o contraseña valido');";
                header("location: ../view/inicio/inicio.php");
        }
    } else {

        $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.');";
        header("location: ../view/inicio/inicio.php");
    }
}

//Solicitud credito

if (isset($_REQUEST['solicitarCredito'])) {

    $monto = $_REQUEST['monto'];
    $estado = ("En espera");
    // Obtener la fecha y hora actual en formato MySQL
    $fecha_credito = date("Y-m-d H:i:s");
    $N°DeCredito = 1;

    if (!empty($monto)) {

        $credito = $personamodel->SolicitudCredito($estado, $fecha_credito, $monto, $N°DeCredito);

        if ($credito) {
            $_SESSION['msg'] = "success('¡Solicitud Exitosa!','Ha solicitado un credito satisfactoriamente.')";
        } else {
            $_SESSION['msg'] = "error('¡Credito Existente !','Usted ya ha solicitado un credito')";
        }
    } else {
        $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.')";
    }

    header("location: ../view/inicio/credito.php");
}

//Cambiar contraseña
if (isset($_REQUEST['recuperar'])) {

    $correo = $_REQUEST['correo'];
    $contraseña = $_REQUEST['contraseña'];
    $confirmar = $_REQUEST['confirmar'];

    if (!empty($correo) && !empty($contraseña) && !empty($confirmar)) {

        $cambioContraseña = $personamodel->olvidoContraseña($correo, $contraseña, $confirmar);

        if ($cambioContraseña) {
            $_SESSION['msg'] = "success('¡Actualizacion Exitosa!','Contraseña actualizada correctamente.')";
        } else {
            $_SESSION['msg'] = "error('¡Ocurrio un Error!','La contraseña no se pudo actualizar.')";
        }
    } else {
        $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.')";
    }

    header("location: ../view/inicio/olvido_contraseña.php");
}

//Solicitud de un credito nuevo

if (isset($_REQUEST['SolicitarNC'])) {

    $estado = ("En espera");
    $montoNC = $_REQUEST['monto2'];
    var_dump($montoNC);
    $fechaNC = date("Y-m-d H:i:s");

    if (!empty($monto)) {

        $NuevoCredito = $personamodel->SolicitudNuevaCredito($montoNC, $fechaNC, $estado);

        if ($NuevoCredito) {
            $_SESSION['msg'] = "success('¡Solicitud Exitosa!','Ha solicitado un nuevo credito satisfactoriamente.')";
        } else {
            $_SESSION['msg'] = "error('¡Ocurrio un error !','Error al momento de solicitar un nuevo credito')";
        }
    } else {
        $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.')";
    }

    header("location: ../view/Usuario/nuevoCredito.php");
}
