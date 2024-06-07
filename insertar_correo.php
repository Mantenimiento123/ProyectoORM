<?php
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Orm.php');
require_once(__DIR__ . '/correo.php');

if (isset($_POST['id']) && isset($_POST['correo'])) {
    $id = $_POST['id'];
    $correo = $_POST['correo'];
    
    $database = new Database();
    $conneccion = $database->getConnection();
    $correoModel = new correo($conneccion);
    
    if ($correoModel->insert(['ID' => $id, 'CORREO' => $correo])) {
        echo 'Correo insertado exitosamente';
    } else {
        header("location:index.php");
    }
} else {
    echo 'ID y Correo deben ser especificados';
}
?>
<a href="index.php">Volver</a>
