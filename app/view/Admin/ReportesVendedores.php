<?php

    

    include("../../model/Conexion.php");
    $conexion = new Conexion();
    $conn = $conexion->getConexion();
  
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= Vendedores.xls");

      
?>

<table id="TableVen">
                    <tr>
                        <td><strong>IDENTIFICACION</strong></td>
                        <td><strong>NOMBRE</strong></td>
                        <td><strong>CORREO</strong></td>
                        <td><strong>DIRECCION</strong></td>
                        <td><strong>TELEFONO</strong></td>
                        
                        
                        
                    </tr>                  
                    <tbody>
                        
                        
                            <?php

                            
                                
                                $queryVen = "SELECT * FROM usuarios WHERE ID_TU = 2";
                                $resultadoVen = mysqli_query($conn,$queryVen);
                                
                                while($rowVen = mysqli_fetch_array($resultadoVen)){ ?>
                                <tr>
                                        <td><?php echo $rowVen['ID_US'] ?></td>
                                        <td><?php echo $rowVen['Nombre_US'] ?></td>
                                        <td><?php echo $rowVen['Correo_US'] ?></td>
                                        <td><?php echo $rowVen['Dirección_US'] ?></td>
                                        <td><?php echo $rowVen['Telefono_US'] ?></td>
                                    

                                        
                                <?php } ?>    
                                
                        </tr>  
                    </tbody>   
                </table>