

<!-- modal guardar categoria -->
<div class="modal" id="guardar_cat" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
                       <div class="modal-dialog">
                           <div class=" m modal-content">
                              <div class=" header modal-header">
                                 <h5 class="modal-title">Agregar Categoria</h5>
                                  <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class=" body modal-body">
                                    <form action="../../controller/controllerAdministrador.php" method = "POST">
                                       <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">ID Categoria</label>
                                          <input type="text" class="form-control" id="recipient-name"name="idcat" pattern="[0-9]+">
                                       </div>
                                       <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Nombre Categoria</label>
                                          <input type="text" class="form-control" id="recipient-name"name="categoriaN">
                                       </div>
                                          

                                       <button type="submit" class="btn btn-primary" name="AgregarCat">Agregar</button>

                                    </form>
                                </div>
                                <div class=" footer modal-footer">
                                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                           </div>
                        </div>
                     </div>