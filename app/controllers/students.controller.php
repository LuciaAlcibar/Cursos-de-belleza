<?php
require_once 'app/models/students.model.php';
require_once 'app/views/students.view.php';

class studentsController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new studentsModel();
        $this->view = new studentsView();
    }
    public function showStudents(){
        //obtengo los alumnos de la db
        $students = $this->model->getStudents();
        //mando los alumnos a la vista
        return $this->view->showStudents($students);
    }
    public function showStudent($id){
        //obtengo el alumno de la db
        $student = $this->model->getStudent($id);
        //mando el alumno a la vista
        return $this->view->showStudent($student);
    }
    
}