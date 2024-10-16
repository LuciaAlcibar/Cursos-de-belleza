<?php

class coursesModel{

    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host=localhost;dbname=db_cursos_belleza;charset=utf8', 'root' , '');
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
        $query = $this->db->prepare ("INSERT INTO cursos (categoria, nombre, descripcion, duracion, profesor, costo, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen]);

        $id= $this->db->lastInsertId();

        return $id;
    }
    public function updateCourse($id, $categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen) {
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
            WHERE id_curso = ?'
        );
    
        $query->execute([$categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id]);
    }
    
}