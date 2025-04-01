<?php

//este codigo es para destruir la session y que no sepueda ingresar por los enlaces
session_start();
session_destroy();
header('location: ../view/inicio/inicio.php');
?>