<?php
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Orm.php');
require_once(__DIR__ . '/correo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $database = new Database();
    $conneccion = $database->getConnection();
    $correoModel = new correo($conneccion);
    
    if ($correoModel->deleteById($id)) {
        echo 'Correo eliminado exitosamente';
    } else {
        header("location:index.php");
    }
} else {
    echo 'ID no especificado';
}
?>
<a href="index.php">Volver</a>
