<?php
require_once 'config.php';
require_once 'app/models/db.model.php';
class coursesModel{
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
    }

    public function getCourses(){
        //ejecuto la consulta 
        $query = $this->db->prepare('SELECT * FROM cursos');
        $query->execute();

       //obtengo los datos en un arreglo de objetos
       $courses = $query->fetchAll(PDO::FETCH_OBJ);
       return $courses; 
    }

    public function getCourse($id){
        $query = $this->db->prepare('SELECT * FROM cursos WHERE ID_curso = ?');
        $query->execute([$id]);
        
        $course = $query -> fetch(PDO::FETCH_OBJ);
        return $course;
    }
  
    public function getCoursesByCategory($category){
        $query = $this->db->prepare('SELECT * FROM cursos WHERE categoria = ?');
        $query->execute([$category]);

        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }
    public function addNewCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen){
        $query = $this->db->prepare ('INSERT INTO cursos (categoria, nombre, descripcion, duracion, profesor, costo, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen]);

        $id= $this->db->lastInsertId();

        return $id;
    }
    public function updateCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id) {
        $query = $this->db->prepare('
            UPDATE cursos 
            SET 
                categoria = ?, 
                nombre = ?, 
                descripcion = ?, 
                duracion = ?, 
                profesor = ?, 
                costo = ?,
                imagen = ?
            WHERE ID_curso = ?'
        );
    
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id]);
    }
    public function deleteInscriptionsByCourse($id) {
        $query = $this->db->prepare('DELETE FROM inscriptos WHERE ID_curso = ?');
        $query->execute([$id]);
    }
    public function deleteCourse($id){
        $this->deleteInscriptionsByCourse($id);
        $query = $this->db->prepare('DELETE FROM cursos WHERE ID_curso = ?');

        $query->execute([$id]);
    }
    
}