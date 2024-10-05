<?php
require_once './app/models/registered.model.php';
require_once './app/views/registered.view.php';

class courseEnrollmentController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new courseEnrollmentModel();
        $this->view = new courseEnrollmentView();
    }
    public function showStudentsByCourse($id_curso){
     
        $students = $this->model->getStudentsByCourse($id_curso);
    
        return $this->view->showStudentsByCourse($students);
    }

}