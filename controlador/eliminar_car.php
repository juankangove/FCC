<?php
include "C:/xampp/htdocs/FCC/modelo/conexion.php";

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("DELETE FROM vehiculos WHERE id=$id");

    if ($sql) {
        // Redirige a la página principal del CRUD después de eliminar
        header("Location: ../vehiculo.php?mensaje=eliminado"); 
        exit();
    } else {
        echo 'Error al eliminar';
    }
} else {
    echo '';
}
?>