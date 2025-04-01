<div class="modal fade" id="ModalPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Productos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../../controller/controllerAdministrador.php" enctype="multipart/form-data" method="post">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">ID</label>
                                    <input type="text" class="form-control" id="recipient-name" name="ID_PRO" pattern="[0-9]+">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nombre</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Nombre_PRO">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Descripcion</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Descripcion_PRO">
                                </div>
                                <div class="mb-3">
                                    <!-- 
                                       <label for="recipient-name" class="col-form-label">Categoria</label>
                                       <input type="text" class="form-control" id="recipient-name" name="Categoria_PRO">
                                    -->
                                    <label for="recipient-name" class="col-form-label">Categoria</label>
                                    <select name="Categoria_PRO"class="form-control" id="recipient-name">
                                        <option value="0" class="option"></option>
                                        <?php 
                                            $sql = "SELECT ID_CAT, Nombre_CAT from categoria_producto";
                                            $result = mysqli_query($conn, $sql);
                    
                                            if($result ->num_rows > 0){
                                                while($fila = $result ->fetch_assoc()){
                                                    $selectec = ( $fila['ID_CAT'] == $Categoria_Prod) ? 'selected' : '';
                                                    echo '<option class="option" value="'.$fila['ID_CAT'].'" '.$selectec.'>'.$fila['Nombre_CAT'].'</option>';
                                                }
                                            }else{
                                                echo'<option class="option" value="">no seleccionaste niguna opcion</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Valor Unitario</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Valor_Unitario" pattern="[0-9]+">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Cantidad Total</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Cantidad_Total" pattern="[0-9]+">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Cantidad Existente</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Cantidad_Existente" pattern="[0-9]+">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Fecha Entrada</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Fecha_Entrada">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Fecha Salida</label>
                                    <input type="text" class="form-control" id="recipient-name" name="Fecha_Expedicion">
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Insertar Imagen</label>
                                    <input type="file" class="form-control" id="recipient-name" name="imagen">
                                </div>
                                    <button type="submit" class="btn btn-primary" name="GuardarProd">Guardar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="ActProd">Cerrar</button>
                                
                            </div>
                        </div>
                    </div>
</div>