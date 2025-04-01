
<?php
    include "../../model/Conexion.php";
    $conexion = new conexion();
    $conn = $conexion->getConexion();
    session_start();

    if(isset($_POST['ActualizarDatosUs'])){

        $ID_US = $_POST['ID_US'];
        $NOMBRE_US = $_POST['NOMBRE_US'];
        $CORREO_US = $_POST['CORREO_US'];
        $DIRECCION_US = $_POST['DIRECCION_US'];
        $TELEFONO_US = $_POST['TELEFONO_US'];
        $CONTRASEÑA_US = $_POST['CONTRASEÑA_US'];

        if(!empty( $ID_US ) && !empty($NOMBRE_US) && !empty($CORREO_US) && !empty($DIRECCION_US) && !empty($TELEFONO_US)){

            if(empty($CONTRASEÑA_US)){

                echo "<script> alert('Debe ingresar una contraseña,si no desea cambiar la contraseña actual, puede ingresar la misma.'); </script>";
            }

            else{

                //Encriptar contraseña

                $encripPassUser = password_hash($CONTRASEÑA_US, PASSWORD_DEFAULT);

                $Actualizar = "UPDATE usuarios SET ID_US = $ID_US, Nombre_US = '$NOMBRE_US', Correo_US = '$CORREO_US', Dirección_US = '$DIRECCION_US'
                , Telefono_US = '$TELEFONO_US', Contraseña_US = '$encripPassUser' WHERE ID_US = $ID_US";

                $resultActualizar = mysqli_query($conn,$Actualizar);

                if($resultActualizar){
                    echo "<script> alert('Datos actualizados correctamente'); </script>";
                }
                else{
                    echo "<script> alert('Hubo un error al actualizar los datos'); </script>";
                }
            }
        }

        else{

            echo "<script> alert('Por favor llene los campos requeridos'); </script>";
        }

    }
?>