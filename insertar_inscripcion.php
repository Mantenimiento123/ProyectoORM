<?php
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Orm.php');
require_once(__DIR__ . '/inscripciones.php');

if (
    isset($_POST['id']) && 
    isset($_POST['carnet']) && 
    isset($_POST['semestre']) && 
    isset($_POST['anio']) && 
    isset($_POST['mes']) && 
    isset($_POST['tipo_inscripcion']) && 
    isset($_POST['mora'])
) {
    $data = [
        'ID_' => $_POST['id_inscripcion'],
        'ID' => $_POST['id'],
        'CARNET' => $_POST['carnet'],
        'SEMESTRE' => $_POST['semestre'],
        'ANIO' => $_POST['anio'],
        'MES' => $_POST['mes'],
        'TIPO_INSCRIPCION' => $_POST['tipo_inscripcion'],
        'MORA' => $_POST['mora']
    ];

    $database = new Database();
    $conneccion = $database->getConnection();
    $inscripcionesModel = new inscripciones($conneccion);

    if ($inscripcionesModel->insert($data)) {
        echo 'Inscripción insertada exitosamente';
    } else {
        header("location:index2_inscripciones.php");
    }
} else {
    echo 'Todos los campos deben ser especificados';
}
?>
<a href="index2_inscripciones.php">Volver</a>
