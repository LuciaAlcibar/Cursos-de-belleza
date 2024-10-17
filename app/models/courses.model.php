<?php
require_once 'config.php';
class coursesModel{

    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }
    private function deploy(){
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
		END;
            $this->db->query($sql);
        }
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
    public function addNewCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo){
        $query = $this->db->prepare ('INSERT INTO cursos (categoria, nombre, descripcion, duracion, profesor, costo) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo]);

        $id= $this->db->lastInsertId();

        return $id;
    }
    public function updateCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $id) {
        $query = $this->db->prepare('
            UPDATE cursos 
            SET 
                categoria = ?, 
                nombre = ?, 
                descripcion = ?, 
                duracion = ?, 
                profesor = ?, 
                costo = ?
            WHERE ID_curso = ?'
        );
    
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $id]);
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