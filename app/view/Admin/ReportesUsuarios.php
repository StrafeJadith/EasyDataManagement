<?php

    include("../../model/Conexion.php");
    $conexion = new Conexion();
    $conn = $conexion->getConexion();
  
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= Usuarios.xls");
    
?>
            
            <table id="Cl">
                <tr>
                    <td><strong>IDENTIFICACION</strong></td>
                    <td><strong>NOMBRE</strong></td>
                    <td><strong>CORREO</strong></td>
                    <td><strong>DIRECCION</strong></td>
                    <td><strong>TELEFONO</strong></td>
                    
                    
                </tr>                  
                 <tbody>          
                        <?php

                           
                            
                            $query = "SELECT * FROM usuarios WHERE ID_TU = 3";
                            $resultadousu = mysqli_query($conn,$query);
                            
                            while($rowusu = mysqli_fetch_array($resultadousu)){ ?>
                               <tr>
                                    <td><?php echo $rowusu['ID_US'] ?></td>
                                    <td><?php echo $rowusu['Nombre_US'] ?></td>
                                    <td><?php echo $rowusu['Correo_US'] ?></td>
                                    <td><?php echo $rowusu['Dirección_US'] ?></td>
                                    <td><?php echo $rowusu['Telefono_US'] ?></td>
                                   
                            <?php } ?> 
                    </tr>  
                </tbody>   
            </table>
            
     

   
   
    
