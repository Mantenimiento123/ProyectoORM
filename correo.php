<?php

 class Correo extends Orm{
    public function __construct(PDO $connecion)
    {
        parent::__construct('ID_CORREO','correo', $connecion);
    }
 }

?>