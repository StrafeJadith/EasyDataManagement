<div class="menu">
                <br>
                <div class="imagen1">
                    <img src="../../../public/img/Administrador/UsuarioLogo.png" alt="">
                </div>
                <div class="correo">
                    <?php

                        $correo = $_SESSION['correo'];
                        $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'";
                        $resultado = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $nombre = $row['Nombre_US'];
                        }

                        echo "Bienvenido ".$nombre."<br>";
                        echo $correo;

                    ?>
                </div>
                <br>
                <br>
                <div class="subtitulomenu">
                    <h3>Menú</h3>
                </div>
                <br>

                <div class="Dashboard">
                    <div class="imagenusuarios">
                        <img src="../../../public/img/Administrador/Dashboard.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <h4><a href="Administrador.php">Dashboard</a></h4>
                    </div>
                </div>

                
                <div class="usuarios">
                    <div class="imagenusuarios">
                        <img src="../../../public/img/Administrador/Usuarios.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <details>
                            <summary>Tipos de usuarios</summary>
                            <ul>
                                <li><a href="TablaClientes.php">Usuarios</a></li>
                                <li><a href="Vendedores.php">Vendedores</a></li>
                            </ul>
                        </details>
                        
                    </div>
                </div>

                <div class="productos">
                    <div class="imagenproductos">
                        <img src="../../../public/img/Administrador/Productos.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Productos</summary>
                            
                            <ul>
                                <li><a href="Categoria.php">Categorias</a></li>
                                <li><a href="Productos.php">Productos</a></li>
                                
                            </ul>

                        </details>
                    </div>
                </div>
                <div class="creditos">
                    <div class="imagencreditos">
                        <img src="../../../public/img/Administrador/Creditos.png" alt="">
                    </div>
                    <div class="creditossubtitulo">
                        <h4><a href="Creditos.php">Creditos</a></h4>
                    </div>
                </div>
                <div class="ventas">
                    <div class="imagenproductos">
                        <img src="../../../public/img/Administrador/Ventas.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Ventas</summary>
                            
                            <ul>
                                <li><a href="ventas.php">Ventas</a></li>
                                <li><a href="detalle_de_venta.php">Detalles_de_Ventas</a></li>
                            </ul>

                        </details>
                    </div>
                </div>
                <a href="../../controller/controladorcerrarsesion.php" style="color: white; position: relative; left:40px; text-decoration: none;">Cerrar Sesión</a>
                
</div>