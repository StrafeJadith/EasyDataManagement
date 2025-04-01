<?php

session_start();
require_once("Conexion.php");



class Registro
{
    private $conn;

    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }


    public function guardarPersona($usuario, $correo, $telefono, $direccion, $cedula, $contraseña)
    {

        $sql = "SELECT 1 FROM usuarios WHERE ID_US = $cedula";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return false; //cedula ya registrada

        } else {

            $contraecrip = password_hash($contraseña, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios (ID_US, Nombre_US, Correo_US, Dirección_US, Telefono_US, Contraseña_US, ID_TU) VALUE ($cedula, '$usuario', '$correo', '$direccion', $telefono, '$contraecrip',3) ";
            return mysqli_query($this->conn, $query); //datos guardados
        }
    }

    public function InicioDeSesion($correo, $contraseña)
    {

        $sql = " SELECT * FROM usuarios WHERE Correo_US = '$correo'";
        $resultado = mysqli_query($this->conn, $sql);

        if ($resultado->num_rows) {
            // se usa la funcion para extraer todo los datos de una fila en una base de datos SQL
            $fila = mysqli_fetch_array($resultado);

            if ($auth = password_verify($contraseña, $fila['Contraseña_US'])) {

                if ($fila['ID_TU'] == 1) {
                    return 1;
                } else if ($fila['ID_TU'] == 2) {
                    return 2;
                } else if ($fila['ID_TU'] == 3) {
                    return 3;
                }
            } else {
                return false;
            }
        }
    }

    public function SolicitudCredito($estado, $fecha_credito, $monto)
    {

        // esta consulta es para traerme los datos de la base de datos y solo pedirle al usuario el monto del credito
        $correo = $_SESSION['correo'];
        $consultasql = "SELECT * FROM usuarios WHERE Correo_us = '$correo'";
        $ejecucion = mysqli_query($this->conn, $consultasql);
        while ($datos = mysqli_fetch_array($ejecucion)) {
            $nombre_us = $datos['Nombre_US'];
            $correo_us = $datos['Correo_US'];
            $telefono_us = $datos['Telefono_US'];
            $direccion_us = $datos['Dirección_US'];
            $cedula_us = $datos['ID_US'];
        }

        $verificacion = "SELECT COUNT(*) FROM credito WHERE ID_US = $cedula_us";
        $result = mysqli_query($this->conn, $verificacion);
        // se usa esta funcion para extraer una fila de datos de un cojunto de resultados de una consulta a una base de dato MYSQL y devolverla en forma de array(matriz) 
        $count = mysqli_fetch_array($result)[0];

        if ($count > 0) {
            // Si existe, muestra un mensaje de error
            // echo "<div class='alert alert-danger'> Usted ya solicito un credito </div>";
            return false;
        } else {
            // Si no existe,se procede a hacer la consulta
            $guardar = "INSERT INTO credito (Nombre_CR,Correo_CR, Telefono_CR, Direccion_CR, Estado_CR, Fecha_CR, Valor_CR, ID_US) VALUE ('$nombre_us','$correo_us', $telefono_us,'$direccion_us', '$estado', '$fecha_credito', $monto, $cedula_us) ";

            // se ejecuta la consulta dentro de una condicion y se muestra sus posibles condiciones
            if (mysqli_query($this->conn, $guardar)) {
                // echo "<div class='alert alert-success'> Registro exitoso </div>";
                return true;
            } else {
                // echo "<div class='alert alert-danger'> Error al momento del registro, intentelo de nuevo </div>";         
                return false;
            }
        }
    }


    public function olvidoContraseña($correo, $contraseña, $confirmar)
    {

        $sql = "SELECT 1 FROM usuarios WHERE Correo_US = '$correo'";
        $resultado = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultado) > 0) {

            if ($contraseña == $confirmar) {

                $contraecrip = password_hash($confirmar, PASSWORD_DEFAULT);

                $consulta = "UPDATE usuarios SET Contraseña_US = '$contraecrip' WHERE Correo_US = '$correo'";
                return mysqli_query($this->conn, $consulta);
            }
        } else {
            return false;
        }
    }
}
