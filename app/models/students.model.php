<?php
require_once 'config.php';
require_once 'app/models/db.model.php';
class studentsModel{

    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
    }

    public function getStudents(){
        $query = $this->db->prepare('SELECT * FROM alumnos');
        $query->execute();

       $students = $query->fetchAll(PDO::FETCH_OBJ);
       return $students; 
    }

    public function getStudent($id){
        $query = $this->db->prepare('SELECT * FROM alumnos WHERE ID_alumno = ?');
        $query->execute([$id]);
        
        $student = $query->fetch(PDO::FETCH_OBJ);
        return $student;
    }

    public function addNewStudent($nombre, $apellido, $dni, $celular, $domicilio) {
        $query = $this->db->prepare('INSERT INTO alumnos (nombre, apellido, dni, celular, domicilio) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $apellido, $dni, $celular, $domicilio]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
    public function updateStudent($nombre, $apellido, $dni, $celular, $domicilio, $id){
        $query = $this->db->prepare('
            UPDATE alumnos 
            SET 
                nombre = ?, 
                apellido = ?, 
                dni = ?, 
                celular = ?, 
                domicilio = ?
            WHERE ID_alumno = ?'
        );
        $query->execute([$nombre, $apellido, $dni, $celular, $domicilio, $id]);

    }
    public function deleteStudent($id){
        $query = $this->db->prepare('DELETE FROM alumnos WHERE ID_alumno = ?');

        $query->execute([$id]);
    }
}
    
