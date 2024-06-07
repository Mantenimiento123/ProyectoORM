<?php
include_once 'Orm.php';

class estudiantes extends Orm {
    public function __construct(PDO $conneccion) {
        parent::__construct('ID', 'estudiantes', $conneccion);
    }
}
?>
