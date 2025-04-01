<?php


if (isset($_POST["BuscarCliente"])) {
    $id = $_POST["Id"];


    if (empty($id)) {
        $_SESSION["msg"] = "answer('¡ Error de Busqueda!','Llenar todos los campos')";
        $sql = ("SELECT * FROM credito");


    } else {
        $sql = ("SELECT * FROM credito WHERE ID_CR = $id");
        $resultado = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resultado)) {
            $_SESSION["msg"] = "success('¡Busqueda exitosa!','Persona encontarda satisfactoriamente')";

        } else {
            $_SESSION["msg"] = "error('¡ Error de Busqueda!','Persona no encontarda')";
            $sql = ("SELECT * FROM credito");

        }

    }
} else if (isset($_POST["Reiniciar"])) {

    $sql = ("SELECT * FROM credito");

} else {
    $sql = ("SELECT * FROM credito");
}



?>