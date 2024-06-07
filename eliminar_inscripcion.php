<?php
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Orm.php');
require_once(__DIR__ . '/inscripciones.php');

if (isset($_POST['id_inscripcion'])) {
    $id = $_POST['id_inscripcion'];
    
    $database = new Database();
    $conneccion = $database->getConnection();
    $inscripcionModel = new inscripciones($conneccion);
    
    if ($inscripcionModel->deleteById($id)) {
        echo 'Correo eliminado exitosamente';
    } else {
        header("location:index2_inscripciones.php");
    }
} else {
    echo 'ID no especificado';
}
?>
<a href="index.php">Volver</a>
