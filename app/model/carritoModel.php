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
        $query1 = "SELECT cantidad_existente FROM productos WHERE ID_PRO = $ID";
        $resul1 = mysqli_query($this->conn, $query1);


        //!Si la consulta falla
        if (!$resul1) {
            return $resul1;
        }

        $row = $resul1->fetch_array(MYSQLI_NUM);
        $cantex = (int) $row[0];

        //! Si la cantidad pedida es mayor que la cantidad de productos existentes
        if ($cantidad > $cantex) {
            $cants = [$cantidad, $cantex];
            return $cants;
        }

        //!Si la cantidad pedida del producto esta vacia
        if (empty($cantidad)) {
            return $cantidad;
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
            return $result;
        }

        //*Se realiza una consulta para verificar la cantidad existentes de productos
        $query4 = " SELECT cantidad_existente FROM productos where ID_PRO = $ID";
        $result4 = mysqli_query($this->conn, $query4);

        //!Si la consulta falla se manejara el error
        if (!$result4) {
            $re4 = "";
            return $re4;
        }

        //?Se hacen los procesos de asignacion de valores
        $row = $result4->fetch_array(MYSQLI_NUM);
        $cantEx = (int) $row[0];

        //?Se resta la cantidad existente 
        $CantNueva = (int) ($cantEx - $cantidad);

        //*Se hace una cosulta para actualizar  la nueva cantidad existente
        $query1 = " UPDATE productos SET cantidad_existente = $CantNueva WHERE ID_PRO = $ID ";
        $result1 = mysqli_query($this->conn, $query1);

        return $result1;

    }

}

?>