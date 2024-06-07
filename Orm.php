<?php
include_once 'Database.php';
class orm {
    protected $id;
    protected $table;
    protected $db;

    public function __construct($id, $table, PDO $conneccion) {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conneccion;
    }

    public function getAll() {
        $stm = $this->db->prepare("SELECT * FROM {$this->table}");
        $stm->execute();
        return $stm->fetchAll();
    }

    public function getById($id) {
        $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_={$id}"); 
        $stm->execute();
        return $stm->fetch();
    }
   
 
   
    public function deleteById($id) {
        $stm = $this->db->prepare("DELETE  FROM {$this->table} WHERE id_={$id}");
        $stm->execute();
    }
   


    public function updateById($id, $data) {
        // Inicializamos la consulta SQL con un espacio después de SET
        $sql = "UPDATE `correo` SET ";
    
        // Recorremos los datos y construimos los campos a actualizar
        foreach ($data as $key => $value) {
            $sql .= "`{$key}` = :{$key}, ";
        }
    
        // Quitamos la última coma y espacio
        $sql = rtrim($sql, ', ');
    
        // Añadimos la cláusula WHERE con un espacio antes de WHERE
        $sql .= " WHERE `ID_CORREO` = :id";
    
        // Preparamos la consulta
        $stm = $this->db->prepare($sql);
    
        // Vinculamos los valores
        foreach ($data as $key => $value) {
            $stm->bindValue(":{$key}", $value);
        }
    
        // Vinculamos el id
        $stm->bindValue(":id", $id);
    
        // Ejecutamos la consulta
        $stm->execute();
    }
    

    public function insert($data) {
        $sql = "INSERT INTO `{$this->table}` (";
        foreach ($data as $key => $value) {
            $sql .= "`{$key}`,";
        }
        $sql = rtrim($sql, ',') . ") VALUES (";
        foreach ($data as $key => $value) {
            $sql .= ":{$key},";
        }
        $sql = rtrim($sql, ',') . ")";

        $stm = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
            $stm->bindValue(":{$key}", $value);
        }
        $stm->execute();
    }
  
    
}
?>
