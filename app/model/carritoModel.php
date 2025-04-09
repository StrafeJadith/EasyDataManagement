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


        if (empty($cantidad)) {
            $verss["ver0"] = false;
            return $verss;
        }

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

        //*Se realiza una consulta para verificar la cantidad existentes de productos
        $query4 = " SELECT cantidad_existente FROM productos where ID_PRO = $ID";
        $result4 = mysqli_query($this->conn, $query4);

        //!Si la consulta falla se manejara el error
        if (!$result4) {
            $verss["ver3"] = false;
            return $verss;
        }

        //?Se hacen los procesos de asignacion de valores
        $row = $result4->fetch_array(MYSQLI_NUM);
        $cantEx = (int) $row[0];

        //?Se resta la cantidad existente 
        $CantNueva = (int) ($cantEx - $cantidad);

        //*Se hace una cosulta para actualizar  la nueva cantidad existente
        $query1 = " UPDATE productos SET cantidad_existente = $CantNueva WHERE ID_PRO = $ID ";
        $result1 = mysqli_query($this->conn, $query1);

        $verss["ver4"] = true;
        return $verss;

    }
//funcion cancelar producto
    public function cancelarProducto($ID){
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
            $result2 = mysqli_query($this-> conn, $sql1);
            $row1 = mysqli_fetch_array($result2);
            $cantex = (int) $row1['Cantidad_Existente'];

            $sql2 = "UPDATE productos set Cantidad_Existente = ($cantidad + $cantex) Where Nombre_PRO = '$nombre'";
            $result3 = mysqli_query($this->conn, $sql2);
            $mostrar["mos0"] = false;
            return $mostrar;
         

        }
        return null;

    }

}

?>