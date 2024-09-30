<?php

class studentsModel{

    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host=localhost;dbname=db_cursos_belleza;charset=utf8', 'root' , '');
    }

    public function getStudents(){
        //ejecuto la consulta 
        $query = $this->db->prepare('SELECT * FROM alumnos');
        $query->execute();

       //obtengo los datos en un arreglo de objetos
       $students = $query->fetchAll(PDO::FETCH_OBJ);
       return $students; 
    }

    public function getStudent($id){
        $query = $this->db->prepare('SELECT * FROM alumnos WHERE ID_alumno = ?');
        $query->execute([$id]);
        
        $student = $query -> fetch(PDO::FETCH_OBJ);
        return $student;
    }
    
}