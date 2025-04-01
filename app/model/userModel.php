<?php
session_start();
require_once("conexion.php");


class Usuario
{

    public $conn;
    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }

    public function abonoEfectivo($monto, $correo)
    {

        //*Consulta de credito
        $ConsultaCr = "SELECT * FROM credito WHERE Correo_CR = '$correo' AND Estado_ACT = 1";
        $resultConCr = mysqli_query($this->conn, $ConsultaCr);


        $rowCr = mysqli_fetch_assoc($resultConCr);

        //*Se maneja el error sino existe una cuenta credito
        if (!$rowCr) {
            return $rowCr;
        }
        $creditoTotal = $rowCr['Valor_Total'];
        $ID_US = $rowCr['ID_US'];

        $consultaAbono = "SELECT sum(Monto_AC) as MontoSuma FROM abono_credito WHERE ID_US = '$ID_US'";
        $resultAbono2 = mysqli_query($this->conn, $consultaAbono);
        $rowAbono = mysqli_fetch_array($resultAbono2, MYSQLI_ASSOC);
        $abonoMonto = $rowAbono['MontoSuma'];

        $estadoCr = "";
        $ver2 = false;
        $ver3 = false;
        $ver4 = false;
        $ver5 = false;

        //*Verificacion de monto apto
        $resp = ($monto % 100 == 0);
        $valorLimite = $monto + $abonoMonto;

        $sql = "SELECT us.ID_US FROM usuarios us  WHERE Correo_US = '$correo'";
        $sqlResult = mysqli_query($this->conn, $sql);


        $rowIdUs = mysqli_fetch_assoc($sqlResult);
        $ID_Usuario = $rowIdUs["ID_US"];

        //*Verificaciones de monto aceptable
        if ($resp != true) {
            return $resp;
        }

        if ($valorLimite > $creditoTotal) {
            return $ver2;
        }

        //*Verificaciones de estado de cuenta
        if ($estadoCr == "En espera") {
            $_SESSION["msg"] = "error('Credito no Aceptado','Su credito sigue en procceso de admision');";
            return $ver3;
        }

        //*Consulta de credito
        $queryCredito =
            "SELECT cr.Estado_CR, Valor_Total, Estado_ACT from credito cr 
             join usuarios u on u.ID_us = cr.ID_US 
             where cr.Estado_CR = 'Aceptado' and Correo_Cr = '$correo';";

        $creditResult = mysqli_query($this->conn, $queryCredito);
        $rowCredit = mysqli_fetch_assoc($creditResult);
        $estadoCr = $rowCredit["Estado_CR"];

        //*Insercion del pago en la base de datos
        $query = "INSERT INTO abono_credito(Monto_AC,ID_US) VALUES ($monto,$ID_Usuario)";
        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            return $ver4;

        }

        //*Verificacion de pago total
        if ($monto + $abonoMonto == $creditoTotal) {
            $accoff = "UPDATE credito SET Estado_ACT = 0 WHERE Correo_Cr = '$correo'";
            $aresult = mysqli_query($this->conn, $accoff);
            $ver5 = true;
            return $ver5;

        }
        $_SESSION["msg"] = "success('¡Enviado exitosamente!','Se han enviado correctamente los datos');";
        return true;

    }
}
?>