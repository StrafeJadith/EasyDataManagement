<?php 

    require_once '../model/Conexion.php';
    require_once '../model/adminModel.php';
    include '../../public/js/alerts.js';

 

    $conexion = new conexion();
    $AdminConnect = new Administrador($conexion->getConexion());
    $conn = $conexion->getConexion();


    //                                                               USUARIOS

    //ACTUALIZAR USUARIOS
    if(isset($_POST["ActUs"])){

        $ID_US = $_POST["ID_US"];
        $Nombre_US = $_POST["Nombre_US"];
        $Correo_US = $_POST["Correo_US"];
        $Direccion_US = $_POST["Direccion_US"];
        $Telefono_US = $_POST["Telefono_US"];


        
            $editUs = $AdminConnect -> editUser($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US);
            

         
            $_SESSION['msg'] = "success('¡Actualizacion exitosa!','Usuario Actualizado.')";
            //$_SESSION['msg'] = "Actualizacion Exitosa";
            header("location: ../view/Admin/TablaClientes.php"); 
        
    }

    //ELIMINAR USUARIOS
    if(isset($_POST["EliminarUs"])){

        $ID_US = $_POST["ID_US"];
        

        $search = $AdminConnect -> searchUser($ID_US);

        $Nombre = $_SESSION['Nombre'];
        if($_SESSION['ID'] == $ID_US){
            $_SESSION["msg"] = "error('Error','El usuario $Nombre no se puede eliminar porque se encuentra activo en la tabla de Abono credito.');";
        }
        else if($_SESSION['ID2'] == $ID_US){
            $_SESSION["msg"] = "error('Error','El usuario $Nombre no se puede eliminar porque se encuentra activo en la tabla de credito.');";
        }
        else if( $_SESSION['ID3'] == $ID_US){
            $_SESSION["msg"] = "error('Error','El usuario $Nombre no se puede eliminar porque se encuentra activo en la tabla de detalle de venta.');";
        }
        else if($_SESSION['ID4'] == $ID_US){
            $_SESSION["msg"] = "error('Error','El usuario $Nombre no se puede eliminar porque se encuentra activo en la tabla de gasto de creditos.');";
        }
        else if($_SESSION['ID5'] == $ID_US){
            $_SESSION["msg"] = "error('Error','El usuario $Nombre no se puede eliminar porque se encuentra activo en la tabla de ventas.');";
        }
        else{

            $deleteUser = $AdminConnect -> deleteUser($ID_US);

            if($deleteUser){
                $_SESSION["msg"] = "success('Eliminado','Usuario eliminado');";
            }
            else{
                $_SESSION["msg"] = "error('Error','Hubo un problema al eliminar');";
            }
        }
     
        header("location: ../view/Admin/TablaClientes.php"); 
    }

    //                                                                    VENDEDORES

    //AGREGAR VENDEDORES

    if(isset($_POST["aggVend"])){

        $ID_US = $_POST["ID_US"];
        $Nombre_US = $_POST["Nombre_US"];
        $Correo_US = $_POST["Correo_US"];
        $Direccion_US = $_POST["Direccion_US"];
        $Telefono_US = $_POST["Telefono_US"];
        $Contraseña_US = $_POST["Contraseña_US"];

        if(!empty($ID_US) && !empty($Nombre_US) && !empty($Correo_US) && !empty($Direccion_US) && !empty($Telefono_US) && !empty($Contraseña_US)){

            $aggSaler = $AdminConnect -> aggVend($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US,$Contraseña_US);

            if($aggSaler){

                $_SESSION["msg"] = "success('Datos Guardados','Usuario guardado satisfactoriamente.');";
            }
            else{

                $_SESSION["msg"] = "error('Error','Ya existe un usuario con esta identificacion');";
            }
        }
        else{

            $_SESSION["msg"] = "error('Error','Por favor llene todos los campos.');";  
        }

        header("location: ../view/Admin/Vendedores.php"); 
    }

    //EDITAR VENDEDORES

    if(isset($_POST["ActVen"])){

        $ID_US = $_POST["ID_US"];
        $Nombre_US = $_POST["Nombre_US"];
        $Correo_US = $_POST["Correo_US"];
        $Direccion_US = $_POST["Direccion_US"];
        $Telefono_US = $_POST["Telefono_US"];

        $editSaler = $AdminConnect -> editVend($ID_US,$Nombre_US,$Correo_US,$Direccion_US,$Telefono_US);

        if($editSaler){

            $_SESSION["msg"] = "success('Datos Actualizados','Usuario actualizado satisfactoriamente.');";
        }
        else{

            $_SESSION["msg"] = "error('Error','Los datos no se pudieron actualizar');";
        }

        header("location: ../view/Admin/Vendedores.php"); 

    }

    //ELIMINAR VENDEDORES

    if(isset($_POST['EliminarVend'])){

        $ID_US = $_POST["ID_US"];

        $deleteSaler = $AdminConnect -> deleteVend($ID_US);

        if($deleteSaler){

            $_SESSION["msg"] = "success('Eliminado','Usuario eliminado');";
        }

        header("location: ../view/Admin/Vendedores.php"); 
    }

    //                                                                    CATEGORIAS                                          

    //AGREGAR CATEGORIAS
    if(isset($_POST["AgregarCat"])){

        $ID_CAT = $_POST['idcat'];
        $nombre_Cat = $_POST['categoriaN'];

        if(!empty($ID_CAT) && !empty($nombre_Cat)){

            $addCat = $AdminConnect -> addCategory($ID_CAT,$nombre_Cat);

        if($addCat){
            $_SESSION["msg"] = "success('Datos Guardados','Categoria guardada satisfactoriamente.');";
        }
        else{
            $_SESSION["msg"] = "error('Error','No se puede agregar una categoria con la misma identificacion o el mismo nombre');";
        }
        }else{
            $_SESSION["msg"] = "error('Error','Campos vacios, por favor llene todos los campos.');";
        }
        

        header("location: ../view/Admin/Categoria.php"); 
    }

    //EDITAR CATEGORIAS
    if(isset($_POST['ActualizarCat'])){
        $ID_CAT = $_POST['idcat'];
        $nombre_Cat = $_POST['nombrecat'];

        $editCat = $AdminConnect -> editCategory($ID_CAT,$nombre_Cat);

        if($editCat){
            $_SESSION["msg"] = "success('Datos Actualizados','Categoria actualizada satisfactoriamente.');";
        }
        else{
            $_SESSION["msg"] = "error('Error','No se puede actualizar, el nombre ya existe.');";
        }

        header("location: ../view/Admin/Categoria.php"); 
    }

    //ELIMINAR CATEGORIAS
    if(isset($_POST['DeleteCat'])){

        $ID_CAT = $_POST['idcat'];
        $nombre_Cat = $_POST['nombrecat'];

        $deleteCat = $AdminConnect -> deleteCategory($ID_CAT);

        if($deleteCat){
            $_SESSION["msg"] = "success('Datos eliminados','Categoria eliminada satisfactoriamente.');";
        }
        else{
            $_SESSION["msg"] = "error('Error','No se puede eliminar la categoria porque esta en uso en la tabla Productos');";
        }

        header("location: ../view/Admin/Categoria.php"); 
        
    }

    //                                                                    PRODUCTOS

    //AGREGAR PRODUCTOS

    if(isset($_POST['GuardarProd'])){

        $ID_PRO = $_POST["ID_PRO"];
        $Nombre_PRO = $_POST["Nombre_PRO"];
        $Descripcion_PRO = $_POST["Descripcion_PRO"];
        $Valor_Unitario = $_POST["Valor_Unitario"];
        $Cantidad_Total = $_POST["Cantidad_Total"];
        $Cantidad_Existente = $_POST["Cantidad_Existente"];
        $Fecha_Entrada = $_POST["Fecha_Entrada"];
        $Fecha_Expedicion = $_POST["Fecha_Expedicion"];
        $Categoria_id = $_POST['Categoria_PRO'];

        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = $_FILES["imagen"]["name"];
        $tipoImagen = strtolower(pathinfo($nombreImagen,PATHINFO_EXTENSION));
        $sizeImagen = $_FILES["imagen"]["size"];
        $directorio = '../../public/img/Administrador/Productos/';
        $ruta = $directorio.$ID_PRO.".".$tipoImagen;


        if(!empty($ID_PRO) && !empty($Nombre_PRO) && !empty($Descripcion_PRO) && !empty($Valor_Unitario) && !empty($Cantidad_Total) && !empty($Cantidad_Existente) && !empty($Fecha_Entrada) && !empty($Fecha_Expedicion) && !empty($Categoria_id) && !empty($imagen)){

            $saveProd = $AdminConnect -> addProducts($ID_PRO,$Nombre_PRO,$Descripcion_PRO,$Valor_Unitario,$Cantidad_Total,$Cantidad_Existente,$Fecha_Entrada,$Fecha_Expedicion,$Categoria_id,$imagen,$ruta); 

            if($saveProd){
                $_SESSION["msg"] = "success('Producto Guardado','Productos agregados satisfactoriamente.');";
            }
            else{
                $_SESSION["msg"] = "error('Error','ERROR: Ya existe un producto con esta clave.');";
            }
        }
        else{

            $_SESSION["msg"] = "error('Error','Campos vacios, por favor llene todos los campos.');";
        }

        header("location: ../view/Admin/Productos.php"); 
    }


    //EDITAR PRODUCTOS

    if(isset($_POST["ActProd"])){

        $ID_PRO = $_POST["ID_PRO"];
        $Nombre_PRO = $_POST["Nombre_PRO"];
        $Descripcion_PRO = $_POST["Descripcion_PRO"];
        $Categoria_PRO = $_POST["Categoria_PRO"];
        $Valor_Unitario = $_POST["Valor_Unitario"];
        $Cantidad_Total = $_POST["Cantidad_Total"];
        $Cantidad_Existente = $_POST["Cantidad_Existente"];
        $Fecha_Entrada = $_POST["Fecha_Entrada"];
        $Fecha_Expedicion = $_POST["Fecha_Expedicion"];

        $editProd = $AdminConnect -> editProducts($ID_PRO,$Nombre_PRO,$Descripcion_PRO,$Categoria_PRO,$Valor_Unitario,$Cantidad_Total,$Cantidad_Existente,$Fecha_Entrada,$Fecha_Expedicion);

        if($editProd){
            $_SESSION["msg"] = "success('Producto Actualizado','Producto actualizado satisfactoriamente.');";
        }
        else{
            $_SESSION["msg"] = "error('Error','No se pudo actualizar el producto.');";
        }
        
        header("location: ../view/Admin/Productos.php"); 

    }

    //ELIMINAR PRODUCTOS

    if(isset($_POST["Eliminar"])){
        
        $ID_PRO = $_POST["ID_PRO"];
        
        $deleteProd = $AdminConnect -> deleteProducts($ID_PRO);

        if($deleteProd){

            $_SESSION["msg"] = "success('Producto Eliminado','Producto eliminado satisfactoriamente.');";
        }
        else{
            $_SESSION["msg"] = "error('Error','No se pudo eliminar el producto.');";
        }

        header("location: ../view/Admin/Productos.php"); 
    }





    //                                               CREDITOS
    //ACEPTAR CREDITOS

    if(isset($_POST['Aceptar'])){
        $ID = $_POST['ID_CR'];
        $ID_US = $_POST['ID_US'];
        $correo = $_POST['Correo_CR'];
        $valor = $_POST['Valor_CR'];
        $correous = $_SESSION['correo'];

        $acepCredito = $AdminConnect -> aceptarCredito($valor, $ID, $ID_US );

        if($acepCredito){
            $_SESSION["msg"] = "success('¡Credito aceptado!','Credito aceptado satisfactoriamente')";
          

        }else{
            $_SESSION["msg"] = "error('Error','No se pudo aceptar credito.');";
        }

        header("location: ../view/Admin/Creditos.php");

    }


    // TRAER DATOS DE CREDITOS  EDITAR || ELIMINAR

    if(isset($_GET['ID_CR'])){
        $ID = $_GET['ID_CR'];

        $valCredito = $AdminConnect -> validarCredito();
                   
        if(mysqli_num_rows($valCredito) == 1){
            $row = mysqli_fetch_array($valCredito);
            $ID = $row['ID_CR'];
            $ID_US = $row['ID_US'];
            $nombre = $row['Nombre_CR'];
            $apellido = $row['Apellido_CR'];
            $telefono = $row['Telefono_CR'];
            $direccion = $row['Direccion_CR'];
            $estado = $row['Estado_CR'];
            $fecha = $row['Fecha_CR'];
            $valor = $row['Valor_CR'];
                             
        }
    }

    // EDITAR CREDITO
                 
    if(isset($_POST['Actualizar'])){
        $ID = $_POST['idcre'];
        $valor = $_POST['valorcre'];

        $editCredito = $AdminConnect -> editarCredito($ID);
    
    
        if(mysqli_num_rows($editCredito) > 0){
            $_SESSION["msg"]= "error('¡Error!','No se puede actualizar un credito ya aceptado')";
            header("location: ../view/Admin/Creditos.php");
    
        }else{
            $query = "UPDATE credito set Valor_CR = '$valor' WHERE ID_CR = '$ID'";
            mysqli_query($conn, $query);
       
            $_SESSION["msg"]= "success('¡Actualizado!','Creditos actualizados satisfactoriamente')";
            header("location: ../view/Admin/Creditos.php");
            }
    
    }

    // ELIMINAR CREDITO

    if (isset($_REQUEST['delete'])) { 
        $ID = $_REQUEST['idcre']; 
                    
        $eliminarCR = $AdminConnect -> eliminarCredito($ID);

        if($eliminarCR){
            $_SESSION["msg"] = "success('¡Eliminado!','Registro eliminado satisfactoriamente')";
           
        }else{
            $_SESSION["msg"] = "answer('¡Campos vacios!','Por favor digite el numero de id al cual desea eliminar')";
        }
        header("location: ../view/Admin/Creditos.php");
                           
    }

?>