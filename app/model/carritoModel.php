<?php

session_start();
require_once 'Conexion.php';
require("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        for ($i = 0; $i <= 5; $i++) {
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

        if ($sumvent > $valorcr) {
            $verss["ver1"] = false;
            return $verss;
        }

        $gastocre = ($valorcr - $sumvent);
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO gasto_credito(Valor_GC, Fecha_GC, ID_US ) VALUES ($sumvent, '$fecha', $ID_US)";
        $result = mysqli_query($this->conn, $sql);


        $query7 = "SELECT ID_PRO, ID_PRO FROM productos WHERE Nombre_PRO = '$nombre'";
        $result7 = mysqli_query($this->conn, $query7);

        if (!$result7) {
            $verss["ver2"] = false;
            return $verss;
        }


        $row1 = $result7->fetch_array(MYSQLI_NUM);
        $ID_PROO = $row1[0];
        $sql = "SELECT Nombre_US FROM usuarios WHERE ID_US = $ID_US";
        $consulta = mysqli_query($this->conn, $sql);


        //*Se realizan consultas y se guardan los datos necesarios del usuario, producto y tipo de pago
        $row = mysqli_fetch_assoc($consulta);
        $nombre = $row['Nombre_US'];

        $row = mysqli_fetch_assoc($result7);
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

        include("../helper/mails.php");


        $sql = "UPDATE credito SET Valor_CR = $gastocre WHERE Correo_CR = '$correo'";
        $result3 = mysqli_query($this->conn, $sql);


        $query3 = "INSERT INTO detalle_de_venta( FECHA_DV, TOTAL_DV, ID_US, ID_MTP) VALUES ( '$fecha', $sumvent, $ID_US, $pago)";
        $result4 = mysqli_query($this->conn, $query3);

        $query5 = " UPDATE ventas set Estado_VENT = 'Confirmado' where ID_US = $ID_US";
        $result5 = mysqli_query($this->conn, $query5);

        $query77 = "SELECT ID_PRO FROM productos WHERE Nombre_PRO = '$nombre'";
        $result77 = mysqli_query($this->conn, $query7);

        $row22 = $result77->fetch_array(MYSQLI_NUM);
        $ID_PRO = $row22[0];

        $query6 = "SELECT cantidad_existente FROM productos  where ID_PRO = $ID_PRO";
        $result6 = mysqli_query($this->conn, $query6);

        if (!$result6) {
            $verss["ver3"] = false;
            return $verss;
        }

        $row = $result6->fetch_array(MYSQLI_NUM);
        $cantEx = (int) $row[0];


        $CantNueva = (int) ($cantEx - $cantidad);

        $query1 = " UPDATE productos SET cantidad_existente = $CantNueva WHERE ID_PRO = $ID_PRO ";
        $result1 = mysqli_query($this->conn, $query1);

        return $verss;

    }


    //pagar Efectivo
    public function compraEfectivo($correo, $pago)
    {
        for ($i = 0; $i <= 0; $i++) {
            $mostrar["mos$i"] = true;
        }

        $queryid = "SELECT ID_US FROM usuarios Where Correo_US = '$correo' ";
        $resulid = mysqli_query($this->conn, $queryid);
        $fila = mysqli_fetch_array($resulid);
        $iduser = $fila['ID_US'];

        $query = "SELECT * FROM ventas where ID_US = $iduser ";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $nombre = $row['Nombre_VENT'];
            $cantidad = $row['Cantidad_VENT'];
            $estado = $row['Estado_VENT'];

        }
        if ($estado == 'Proceso') {

            $querysum1 = "SELECT sum(Valor_total) as total from ventas WHERE Estado_VENT = '$estado' AND ID_US = $iduser";
            $resultsum1 = mysqli_query($this->conn, $querysum1);
            if ($resultsum1) {
                $rowsum = $resultsum1->fetch_array(MYSQLI_NUM);
                $totalsum = $rowsum[0];

            }

            $query2 = "SELECT ID_PRO FROM productos WHERE Nombre_PRO = '$nombre'";
            $result2 = mysqli_query($this->conn, $query2);
            if ($result2) {
                $row = $result2->fetch_array(MYSQLI_NUM);
                $ID_PRO = $row[0];

            }


            $sql = "SELECT Nombre_US, ID_US FROM usuarios WHERE Correo_us = '$correo'";
            $resultado = mysqli_query($this->conn, $sql);
            while ($row = mysqli_fetch_array($resultado)) {
                $nombre = $row['Nombre_US'];
                $ID_CL = $row['ID_US'];
            }


            $ID_PRO = (int) $ID_PRO;
            $cantidad = (int) $cantidad;
            $fechadv = date("Y-m-d");


            $query3 = "INSERT INTO detalle_de_venta( FECHA_DV, TOTAL_DV, ID_US, ID_MTP) VALUES ( '$fechadv', $totalsum, $ID_CL, $pago)";
            $result3 = mysqli_query($this->conn, $query3);


            if (!$result3) {

                $mostrar["mos0"] = false;
                return $mostrar;

            } else {
                $mostrar["mos0"] = true;


                $sql = "SELECT Nombre_US FROM usuarios WHERE ID_US = $ID_CL";
                $consulta = mysqli_query($this->conn, $sql);
                while ($row = mysqli_fetch_array($consulta)) {
                    $nombre = $row['Nombre_US'];
                }

                $sql2 = "SELECT Nombre_PRO FROM productos WHERE ID_PRO = $ID_PRO";
                $consulta2 = mysqli_query($this->conn, $sql2);
                while ($row = mysqli_fetch_array($consulta2)) {
                    $nombre_producto = $row['Nombre_PRO'];
                }

                $sql3 = "SELECT Tipo_Pago_MTP FROM metodo_pago where ID_MTP = $pago";
                $consulta3 = mysqli_query($this->conn, $sql3);
                while ($row = mysqli_fetch_array($consulta3)) {
                    $nombre_pago = $row['Tipo_Pago_MTP'];
                }



                $mail1 = new PHPMailer(true);

                try {
                    $mail1->isSMTP();
                    $mail1->Host = 'smtp.gmail.com';
                    $mail1->SMTPAuth = true;
                    $mail1->Username = 'tiendalamanodedios08@gmail.com';
                    $mail1->Password = 'cikmzzyygmgprsbn';
                    $mail1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail1->Port = 587;

                    $mail1->setFrom('tiendalamanodedios08@gmail.com', 'EDM');
                    $mail1->addAddress($correo);

                    $mail1->isHTML(true);
                    $mail1->Subject = 'Compra realizada';
                    $mail1->Body = 'Hola, ' . $nombre . '<br> Gracias por tu compra en la tienda, aqui tienes un detalle de tu compra:  <br> Fecha compra: ' . $fechadv . '<br> Nombre del producto: ' . $nombre_producto . '<br> Cantidad comprada: ' . $cantidad . '<br> Metodo de pago: ' . $nombre_pago . '<br> Total Compra: ' . $totalsum;

                    $mail1->send();
                } catch (Exception $e) {
                    echo "Error al enviar el correo: {$mail->ErrorInfo}";
                }

                $query1 = " UPDATE ventas set Estado_VENT = 'Confirmado' where ID_US = $ID_CL";
                $result1 = mysqli_query($this->conn, $query1);


                //CORREO VENDEDORES

                if ($result3) {


                    $sql = "SELECT * FROM usuarios where ID_TU = '2'";
                    $consulta = mysqli_query($this->conn, $sql);
                    while ($row = mysqli_fetch_array($consulta)) {
                        $correovendedor = $row['Correo_US'];
                    }

                    $sql1 = "SELECT Correo_US from usuarios where ID_US = $ID_CL";
                    $consulta1 = mysqli_query($this->conn, $sql1);
                    while ($row = mysqli_fetch_array($consulta1)) {
                        $CORREO_US = $row['Correo_US'];
                    }

                    $sql2 = "SELECT Nombre_PRO FROM productos WHERE ID_PRO = $ID_PRO";
                    $consulta2 = mysqli_query($this->conn, $sql2);
                    while ($row = mysqli_fetch_array($consulta2)) {
                        $NOMBREPRO = $row['Nombre_PRO'];
                    }

                    $sql3 = "SELECT Tipo_Pago_MTP FROM metodo_pago where ID_MTP = $pago";
                    $consulta3 = mysqli_query($this->conn, $sql3);
                    while ($row = mysqli_fetch_array($consulta3)) {
                        $METODO = $row['Tipo_Pago_MTP'];
                    }

                    // $correovendedor = "adriianchoo12@gmail.com";

                    $mail2 = new PHPMailer(true);

                    try {
                        $mail2->isSMTP();
                        $mail2->Host = 'smtp.gmail.com';
                        $mail2->SMTPAuth = true;
                        $mail2->Username = 'tiendalamanodedios08@gmail.com';
                        $mail2->Password = 'cikmzzyygmgprsbn';
                        $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail2->Port = 587;

                        $mail2->setFrom('tiendalamanodedios08@gmail.com', 'EDM');
                        $mail2->addAddress($correovendedor);

                        $mail2->isHTML(true);
                        $mail2->Subject = 'Nueva venta realizada';
                        $mail2->Body = 'Se ha realizado una nueva venta, <br> detalles de la venta: <br> Fecha compra: ' . $fechadv . '<br> Correo del comprador: ' . $CORREO_US . '<br> Nombre del producto: ' . $NOMBREPRO . '<br> Cantidad comprada: ' . $cantidad . '<br> Metodo de pago: ' . $METODO;

                        $mail2->send();
                        echo (" <script>alert('Correo enviado correctamente ')</script>");
                    } catch (Exception $e) {
                        echo "Error al enviar el correo: {$mail->ErrorInfo}";
                    }
                }

            }
        }

    }

}

?>