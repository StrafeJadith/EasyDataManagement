<div class="modal fade" id="ModalVen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Vendedores</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../../controller/controllerAdministrador.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Identificacion</label>
                                <input type="text" class="form-control" id="recipient-name" name="ID_US" pattern="[0-9]+">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="recipient-name" name="Nombre_US" >
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Correo</label>
                                <input type="email" class="form-control" id="recipient-name" name="Correo_US">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Direccion</label>
                                <input type="text" class="form-control" id="recipient-name" name="Direccion_US">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Telefono</label>
                                <input type="text" class="form-control" id="recipient-name" name="Telefono_US" pattern="[0-9]+">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Contraseña</label>
                                <input type="password" class="form-control" id="recipient-name" name="Contraseña_US">
                            </div>
                        
                            <button type="submit" class="btn btn-primary" name="aggVend">Guardar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="ActProd">Cerrar</button>
                            
                        </div>
                        </div>
    </div>
    </div>