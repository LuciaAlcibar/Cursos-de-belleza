<?php
require_once 'config.php';
require_once 'app/models/db.model.php';
class courseEnrollmentModel{

    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
    }

    public function getStudentsByCourse($course_id) {
        $query = $this->db->prepare('SELECT cursos.nombre AS curso_nombre, alumnos.nombre AS alumno_nombre, alumnos.apellido 
        FROM inscriptos 
        JOIN alumnos ON inscriptos.ID_alumno = alumnos.ID_alumno 
        JOIN cursos ON inscriptos.ID_curso = cursos.ID_curso 
        WHERE inscriptos.ID_curso = ?');
        $query->execute([$course_id]);
    
        $students = $query->fetchAll(PDO::FETCH_OBJ);

        return $students;
    }
}