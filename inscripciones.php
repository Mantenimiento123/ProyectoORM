<?php
include_once 'Orm.php';

class inscripciones extends Orm {
    public function __construct(PDO $conneccion) {
        parent::__construct('ID_INSCRIPCION', 'inscripciones', $conneccion);
    }
}
?>
