<?php
session_start();
include "modelo/conexion.php";

// Validar que el usuario está autenticado y tiene un rol permitido (mecánico o admin) para modificar vehículos
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'mecanico' && $_SESSION['user_role'] != 'admin')) {
    header("Location: index.php"); // Redirigir a la página de inicio si no tiene permiso
    exit();
}

// Obtener el ID del vehículo de la URL
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM usuarios WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>FIRE CAR CONTROL</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark" id="navbar">
       <div class="container">
           <a class="navbar-brand">Datos de vehículos</a>
       </div>
   </nav>

   <section class="bg-login d-flex align-items-center">
       <div class="container">
           <div class="row justify-content-center mt-4">
               <div class="col-lg-4">
                   <div class="text-center page-heading">
                       <h1 class="text-white">Modificar vehículo</h1>
                   </div>
                   <div class="bg-white p-4 rounded">
                       <form class="login-form" method="POST" action="controlador/modificar_car.php">
                           <input type="hidden" name="id" value="<?= $id ?>"> <!-- Asegúrate de tener el ID aquí -->

                           <?php 
                           if ($datos = $sql->fetch_object()) { ?>
                               <div class="row">
                                   <div class="col-lg-12 mt-2">
                                       <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre" value="<?= $datos->nombre ?>" required>
                                   </div>
                                   <div class="col-lg-12 mt-2">
                                       <input type="text" class="form-control" placeholder="Ingrese apellido" name="apellido" value="<?= $datos->tipo ?>" required>
                                   </div>
                                   <div class="col-lg-12 mt-2">
                                       <input type="text" class="form-control" placeholder="Ingrese email" name="email" value="<?= $datos->modelo ?>" required>
                                   </div>
                                   <div class="col-lg-12 mt-2">
                                    <label for="rol">Rol de Usuario:</label>
                                    <select id="rol" name="rol" class="form-control" required>
                                        <option value="">Selecciona un rol</option>
                                        <option value="2">Bombero</option>
                                        <option value="3">Mecánico</option>
                                    </select>
                                </div>
                               </div>
                           <?php } else { ?>
                               <p class="text-danger">Error: No se encontraron los datos del vehículo.</p>
                           <?php } ?>

                           <div class="col-lg-12 mt-3 mb-4">
                               <button type="submit" class="btn btn-primary w-100" name="btnregistrar" value="ok">Modificar</button>
                           </div>
                           <div class="text-center">
                               <p class="mb-0 mt-2 text-center">
                                   <a href="vehiculo.php" class="text-dark fw-bold">Regresar</a>
                               </p>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
</body>
</html>