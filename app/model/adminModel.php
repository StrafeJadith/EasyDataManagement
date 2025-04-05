<?php 

    session_start();
    require_once 'Conexion.php';

class Administrador{

        public $conn;

        public function __construct($conexion){
            $this->conn = $conexion;
            
        }

        //                                                         USUARIOS

        //EDITAR USUARIOS
        public function editUser($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US){

            $query1 = "UPDATE usuarios SET Nombre_US = '$Nombre_US', Correo_US = '$Correo_US', Dirección_US = '$Direccion_US', Telefono_US = $Telefono_US WHERE ID_US = $ID_US";
            $result1 = mysqli_query($this->conn,$query1);
            
            return $result1;
        }


        //ELIMINAR USUARIOS
        public function searchUser($ID_US){

            $searchQuery = "SELECT * FROM usuarios WHERE ID_US = $ID_US";
            $resultSearch = mysqli_query($this->conn,$searchQuery);
            $row = mysqli_fetch_array($resultSearch,MYSQLI_ASSOC);
            $NOMBRE = $row['Nombre_US'];
            $_SESSION['Nombre'] = $NOMBRE;

            $sql1 = "SELECT ID_US FROM abono_credito WHERE ID_US = $ID_US";
            $sql1Result = mysqli_query($this->conn,$sql1);
            $row1 = mysqli_fetch_array($sql1Result,MYSQLI_ASSOC);
            $abonoCr = $row1['ID_US'];
            $_SESSION['ID'] = $abonoCr;

            $sql2 = "SELECT ID_US FROM credito WHERE ID_US = $ID_US";
            $sql2Result = mysqli_query($this->conn,$sql2);
            $row2 = mysqli_fetch_array($sql2Result,MYSQLI_ASSOC);
            $credito = $row2['ID_US'];
            $_SESSION['ID2'] = $credito;

            $sql3 = "SELECT ID_US FROM detalle_de_venta WHERE ID_US = $ID_US";
            $sql3Result = mysqli_query($this->conn,$sql3);
            $row3 = mysqli_fetch_array($sql3Result,MYSQLI_ASSOC);
            $detalleV = $row3['ID_US'];
            $_SESSION['ID3'] = $detalleV;

            $sql4 = "SELECT ID_US FROM gasto_credito WHERE ID_US = $ID_US";
            $sql4Result = mysqli_query($this->conn,$sql4);
            $row4 = mysqli_fetch_array($sql4Result,MYSQLI_ASSOC);
            $_SESSION['ID4'] = $row4['ID_US'];

            $sql5 = "SELECT ID_US FROM ventas WHERE ID_US = $ID_US";
            $sql5Result = mysqli_query($this->conn,$sql5);
            $row5 = mysqli_fetch_array($sql5Result,MYSQLI_ASSOC);
            $_SESSION['ID5'] = $row5['ID_US'];

            return null;
            }

        public function deleteUser($ID_US){
            $queryDel = "DELETE FROM usuarios WHERE ID_US = $ID_US";
            $resultDel = mysqli_query($this->conn, $queryDel);

            return $resultDel;
        }


        //                                                          VENDEDORES

        //AGREGAR VENDEDORES

        public function aggVend($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US,$Contraseña_US){

            $consultarVend = "SELECT * FROM usuarios WHERE ID_US = $ID_US";
            $resultVen = mysqli_query( $this->conn, $consultarVend);
            $rowVend = mysqli_fetch_array($resultVen, MYSQLI_ASSOC);
            if($rowVend){
                return false;
            }
            //encriptar contraseña
            $ContraEncrip = password_hash($Contraseña_US, PASSWORD_DEFAULT);

            $queryVend = "INSERT INTO usuarios (ID_US,Nombre_US,Correo_US,Dirección_US,Telefono_US,Contraseña_US,ID_TU) VALUES ($ID_US,'$Nombre_US','$Correo_US','$Direccion_US',$Telefono_US,'$ContraEncrip',2)";
            return mysqli_query($this->conn,$queryVend);
        }

        //EDITAR VENDEDORES

        public function editVend($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US){


            $query2 = "UPDATE usuarios SET Nombre_US = '$Nombre_US', Correo_US = '$Correo_US', Dirección_US = '$Direccion_US', Telefono_US = $Telefono_US WHERE ID_US = $ID_US";
            return mysqli_query($this->conn,$query2);

        }

        public function deleteVend($ID_US){

            $queryDel = "DELETE FROM usuarios WHERE ID_US = $ID_US";
            return mysqli_query($this->conn, $queryDel);

        
        }

        //                                                          CATEGORIAS

        //AGREGAR CATEGORIAS
        public function addCategory($ID_CAT,$nombre_Cat){

            $consultCat = "SELECT * FROM categoria_producto WHERE ID_CAT = $ID_CAT OR Nombre_CAT = '$nombre_Cat'";
            $resultCat = mysqli_query($this->conn,$consultCat);
            $rowResultCat = mysqli_fetch_array($resultCat,MYSQLI_ASSOC);
            if($rowResultCat){
                return false;
            }

            $queryAddCategory = "INSERT INTO categoria_producto(ID_CAT,NOMBRE_CAT) VALUES ($ID_CAT,'$nombre_Cat')";
            return mysqli_query($this->conn,$queryAddCategory);
        }

        //EDITAR CATEGORIAS

        public function editCategory($ID_CAT,$nombre_Cat){

            $consultNameCategory = "SELECT Nombre_CAT FROM categoria_producto WHERE Nombre_CAT = '$nombre_Cat'";
            $resultNameCategory = mysqli_query($this->conn,$consultNameCategory);
            $rowCategory = mysqli_fetch_array($resultNameCategory,MYSQLI_ASSOC);
            if($rowCategory){
                return false;
            }
            
                $queryEditCategory = "UPDATE categoria_producto set Nombre_CAT = '$nombre_Cat' WHERE ID_CAT = $ID_CAT";
                return mysqli_query($this->conn,$queryEditCategory);
            
        }

        //ELIMINAR CATEGORIAS
        public function deleteCategory($ID_CAT){

            $consultRelacion = "SELECT ID_CAT FROM productos WHERE ID_CAT = $ID_CAT";
            $resultConsultRelacion = mysqli_query($this->conn,$consultRelacion);
            $rowConsultRelacion = mysqli_fetch_array($resultConsultRelacion,MYSQLI_ASSOC);
            if($rowConsultRelacion){
                return false;
            }

            $queryDeleteCategory = "DELETE FROM categoria_producto WHERE ID_CAT = $ID_CAT";
            return mysqli_query($this->conn,$queryDeleteCategory);
        }


        //                                                          PRODUCTOS

        //AGREGAR PRODUCTOS
        public function addProducts($ID_PRO,$Nombre_PRO,$Descripcion_PRO,$Valor_Unitario,$Cantidad_Total,$Cantidad_Existente,$Fecha_Entrada,$Fecha_Expedicion,$Categoria_id,$imagen,$ruta){

            $consultarProductos = "SELECT * FROM productos WHERE ID_PRO = $ID_PRO";
            $resultConsProductos = mysqli_query( $this->conn, $consultarProductos);
            $rowProductos = mysqli_fetch_array($resultConsProductos, MYSQLI_ASSOC);
            if($rowProductos){
                return false;
            }

            $consultarCategoria = "SELECT Nombre_CAT FROM categoria_producto WHERE ID_CAT = $Categoria_id";
            $resultConsCategoria = mysqli_query($this->conn, $consultarCategoria);
            $rowCat = mysqli_fetch_array($resultConsCategoria,MYSQLI_ASSOC);
            $Nombre_CAT = $rowCat['Nombre_CAT'];

            $GuardarProductos = "INSERT INTO productos(ID_PRO,Nombre_PRO,Descripcion_PRO,Categoria_PRO,Valor_Unitario,Cantidad_Total,Cantidad_Existente,Fecha_Entrada,Fecha_Expedicion,ID_US,ID_CAT,Img) 
            VALUES ($ID_PRO,'$Nombre_PRO','$Descripcion_PRO','$Nombre_CAT',$Valor_Unitario,$Cantidad_Total,$Cantidad_Existente,'$Fecha_Entrada','$Fecha_Expedicion',11223344,$Categoria_id,'$ruta');";
            
            if(move_uploaded_file($imagen,$ruta)){
                return mysqli_query($this->conn,$GuardarProductos);
            }
        
        }

        //EDITAR PRODUCTOS 

        public function editProducts($ID_PRO,$Nombre_PRO,$Descripcion_PRO,$Categoria_PRO,$Valor_Unitario,$Cantidad_Total,$Cantidad_Existente,$Fecha_Entrada,$Fecha_Expedicion){
            $query2 = "SELECT Nombre_CAT FROM categoria_producto WHERE ID_CAT = $Categoria_PRO";
            $result2 = mysqli_query($this -> conn, $query2);
            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
            $CategoriaNombre = $row2['Nombre_CAT'];

            $query = "UPDATE productos SET Nombre_PRO ='$Nombre_PRO', Descripcion_PRO ='$Descripcion_PRO', Categoria_PRO='$CategoriaNombre', Valor_Unitario=$Valor_Unitario,Cantidad_Total = $Cantidad_Total,Cantidad_Existente = $Cantidad_Existente,Fecha_Entrada='$Fecha_Entrada',Fecha_Expedicion = '$Fecha_Expedicion' WHERE ID_PRO = $ID_PRO";
            return mysqli_query($this -> conn,$query);

        }

        //ELIMINAR PRODUCTOS

        public function deleteProducts($ID_PRO){
            
            $queryDel = "DELETE FROM productos WHERE ID_PRO = $ID_PRO";
            return  mysqli_query($this -> conn, $queryDel);
        }



        //                                             CREDITOS
        // ACEPTAR CREDITOS

        public function aceptarCredito($valor,$ID,$ID_US ){
            $query = "UPDATE credito set Estado_CR = 'Aceptado', Valor_Total = $valor, Estado_ACT = 1 WHERE ID_CR = '$ID' AND ID_US = $ID_US";
            return  mysqli_query($this -> conn, $query);

        }


       // TRAER DATOS DE CREDITOS  EDITAR || ELIMINAR
        public function validarCredito(){
            $query = "SELECT c.ID_CR, u.ID_US, c.Nombre_CR, c.Apellido_CR, c.Telefono_CR, c.Direccion_CR, c.Estado_CR, c.Fecha_CR,
            c.Valor_CR FROM credito c, usuarios u WHERE c.ID_US = u.ID_US";

        return mysqli_query($this -> conn, $query);
        }
         // EDITAR CREDITOS
        public function editarCredito($ID){
            $query2 = "SELECT Estado_CR FROM credito WHERE ID_CR = $ID AND Estado_CR = 'Aceptado'";
            return mysqli_query($this -> conn, $query2);
        }


        // ELIMINAR CREDITOS

        public function eliminarCredito($ID){
            $eliminar = "DELETE FROM credito WHERE ID_CR = '$ID'";
            return mysqli_query($this -> conn, $eliminar);
        }

}

?>