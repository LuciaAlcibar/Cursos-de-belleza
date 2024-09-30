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
    public function getAvailableCourses() {
        // ejecuto la consulta
        $query = $this->db->prepare('SELECT nombre, descripcion FROM cursos');
        $query->execute();

        // Obtengo los datos en un arreglo de objetos
        $courses = $query->fetchAll(PDO::FETCH_OBJ);
        return $courses;
    }
}