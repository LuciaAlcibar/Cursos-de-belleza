<?php
require_once '../TPE/config.php';

class Model {

    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy() {
        $query = $this->db->query("SHOW TABLES");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                CREATE TABLE alumnos (
                    ID_alumno int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    nombre varchar(45) NOT NULL,
                    apellido varchar(45) NOT NULL,
                    dni int(11) NOT NULL,
                    celular bigint(20) NOT NULL,
                    domicilio varchar(45) NOT NULL
                );
                CREATE TABLE cursos (
                    ID_curso int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    categoria varchar(45) NOT NULL,
                    nombre varchar(45) NOT NULL,
                    descripcion varchar(1500) NOT NULL,
                    duracion varchar(45) NOT NULL,
                    profesor varchar(45) NOT NULL,
                    costo int(11) NOT NULL,
                    imagen varchar(10000) NOT NULL
                );
                CREATE TABLE inscriptos (
                    ID_alumno int(11) NOT NULL,
                    ID_curso int(11) NOT NULL,
                    PRIMARY KEY (ID_alumno, ID_curso),
                    FOREIGN KEY (ID_alumno) REFERENCES alumnos(ID_alumno),
                    FOREIGN KEY (ID_curso) REFERENCES cursos(ID_curso)
                );
                CREATE TABLE usuario (
                    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    email varchar(250) NOT NULL,
                    password char(60) NOT NULL,
                    role varchar(50) NOT NULL
                );
            END;

            $this->db->exec($sql); 
        }
    }
}
