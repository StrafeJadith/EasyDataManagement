<?php

session_start();
require_once 'Conexion.php';

class Carrito
{

    public $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }

    public function guardarProducto($correo, $ID, $nombre, $precio, $cantidad)
    {

        //?Se crea un array asociativo con valores verdaderos
        for ($i = 0; $i <= 5; $i++) {
            $verss["ver$i"] = true;
        }

        $query1 = "SELECT cantidad_existente FROM productos WHERE ID_PRO = $ID";
        $resul1 = mysqli_query($this->conn, $query1);


        //!Si la consulta falla
        if (!$resul1) {
            $verss["ver1"] = false;
            return $verss;
        }

        $row = $resul1->fetch_array(MYSQLI_NUM);
        $cantex = (int) $row[0];


        //! Si la cantidad pedida es mayor que la cantidad de productos existentes
        if ($cantidad > $cantex) {
            $verss["cantidad"] = $cantidad;
            $verss["cantex"] = $cantex;
            return $verss;
        }

        //?Se obtienen los valores del precio total y fechas de obtencion
        $fecha = date("Y-m-d");
        $valor_total = (int) ($precio * $cantidad);

        //*Se realiza una consulta para traer los datos del usuario
        $queryid = "SELECT ID_US FROM usuarios Where Correo_US = '$correo' ";
        $resulid = mysqli_query($this->conn, $queryid);
        $fila = mysqli_fetch_array($resulid);
        $iduser = $fila['ID_US'];

        //*Se realiza una insercion a la base de datos 
        $query = "INSERT INTO ventas( Fecha_VENT, Nombre_VENT, Precio_VENT, Cantidad_VENT,	Valor_total, Estado_VENT, ID_US) VALUES ('$fecha','$nombre', $precio, $cantidad, $valor_total, 'Proceso', $iduser)";
        $result = mysqli_query($this->conn, $query);

        //!Si falla el guardado de los productos en el carrito se manejara el error
        if (!$result) {
            $verss["ver2"] = false;
            return $verss;
        }

        //?Se resta la cantidad existente 
        $CantNueva = $cantex - $cantidad;

        //*Se hace una cosulta para actualizar  la nueva cantidad existente
        $query1 = " UPDATE productos SET cantidad_existente = $CantNueva WHERE ID_PRO = $ID ";
        $result1 = mysqli_query($this->conn, $query1);

        $verss["ver4"] = true;
        return $verss;

    }
    //funcion cancelar producto
    public function cancelarProducto($ID)
    {
        for ($i = 0; $i <= 0; $i++) {
            $mostrar["mos$i"] = true;
        }
        $sql = "SELECT Nombre_VENT, Cantidad_VENT FROM ventas WHERE ID_VENT = $ID";
        $result1 = mysqli_query($this->conn, $sql);

        while ($row = mysqli_fetch_array($result1)) {

            $nombre = $row['Nombre_VENT'];
            $cantidad = (int) $row['Cantidad_VENT'];
        }
        $query = "DELETE FROM ventas WHERE ID_VENT = $ID";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $sql1 = "SELECT Cantidad_Existente FROM productos Where Nombre_PRO = '$nombre'";
            $result2 = mysqli_query($this->conn, $sql1);
            $row1 = mysqli_fetch_array($result2);
            $cantex = (int) $row1['Cantidad_Existente'];

            $sql2 = "UPDATE productos set Cantidad_Existente = ($cantidad + $cantex) Where Nombre_PRO = '$nombre'";
            $result3 = mysqli_query($this->conn, $sql2);
            $mostrar["mos0"] = false;
            return $mostrar;


        }
        return null;

    }

    public function compraCredito($correo, $pago)
    {
        for ($i = 0; $i <= 10; $i++) {
            $verss["ver$i"] = true;
        }

        //*Se traen los datos desde la base de datos
        $queryval = "SELECT * FROM usuarios WHERE Correo_US = '$correo'";
        $result = mysqli_query($this->conn, $queryval);
        $rowUsu = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $ID_US = $rowUsu['ID_US'];

        $query = "SELECT sum(Valor_total) as sumvent, Cantidad_VENT, Nombre_VENT, Estado_VENT FROM ventas WHERE ID_US = $ID_US AND Estado_VENT = 'Proceso'";
        $result2 = mysqli_query($this->conn, $query);
        $rowVent = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $sumvent = $rowVent['sumvent'];
        $nombre = $rowVent['Nombre_VENT'];
        $cantidad = $rowVent['Cantidad_VENT'];
        $estadoVen = $rowVent['Estado_VENT'];

        //**ver estado y total de credito
        $sqlcr = "SELECT * FROM credito WHERE Correo_CR = '$correo'";
        $resultcr = mysqli_query($this->conn, $sqlcr);
        $rowEstado = mysqli_fetch_array($resultcr, MYSQLI_ASSOC);

        if (empty($rowEstado)) {
            $verss["ver0"] = false;
            return $verss;
        }
        $estado1 = $rowEstado['Estado_CR'];
        $valorcr = $rowEstado['Valor_CR'];

        if ($estado1 != "aceptado") {
            $verss["ver1"] = false;
            return $verss;
        }

        if ($sumvent > $valorcr) {
            $verss["ver2"] = false;
            return $verss;
        }

        $gastocre = ($valorcr - $sumvent);
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO gasto_credito(Valor_GC, Fecha_GC, ID_US ) VALUES ($sumvent, '$fecha', $ID_US)";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            $verss["ver3"] = false;
            return $verss;
        }

        $query7 = "SELECT ID_PRO FROM productos WHERE Nombre_PRO = '$nombre'";
        $result7 = mysqli_query($this->conn, $query7);

        if (!$result7) {
            $verss["ver4"] = false;
            return $verss;
        }

        //! Adrian por favor pon condiciones si el codigo falla me voy a matar si esto sigue asi
        $row1 = $result7->fetch_array(MYSQLI_NUM);
        $ID_PROO = $row1[0];
        $sql = "SELECT Nombre_US FROM usuarios WHERE ID_US = $ID_US";
        $consulta = mysqli_query($this->conn, $sql);

        if (!$consulta) {
            $verss["ver5"] = false;
            return $verss;
        }

        //*Se realizan consultas y se guardan los datos necesarios del usuario, producto y tipo de pago
        $row = mysqli_fetch_assoc($consulta);
        $nombre = $row['Nombre_US'];

        $sql2 = "SELECT Nombre_PRO FROM productos WHERE ID_PRO = $ID_PROO";
        $consulta2 = mysqli_query($this->conn, $sql2);

        $row = mysqli_fetch_assoc($consulta2);
        $nombre_producto = $row['Nombre_PRO'];


        $sql3 = "SELECT Tipo_Pago_MTP FROM metodo_pago where ID_MTP = $pago";
        $consulta3 = mysqli_query($this->conn, $sql3);

        $row = mysqli_fetch_assoc($consulta3);
        $nombre_pago = $row['Tipo_Pago_MTP'];


        $querysum2 = "SELECT sum(Valor_total) as totalVen from ventas WHERE Estado_VENT = '$estadoVen' AND ID_US = $ID_US";
        $resultsum2 = mysqli_query($this->conn, $querysum2);

        if ($resultsum2) {
            $rowsum22 = mysqli_fetch_assoc($resultsum2);
            $totalsum22 = $rowsum22['totalVen'];

        }

    }

}

?>