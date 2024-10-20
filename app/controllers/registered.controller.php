<?php
require_once './app/models/registered.model.php';
require_once './app/views/registered.view.php';
require_once './app/models/db.model.php';

class courseEnrollmentController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new courseEnrollmentModel();
        $this->view = new courseEnrollmentView($res->user);
        
    }
    public function showStudentsByCourse($id_curso){
        $students = $this->model->getStudentsByCourse($id_curso);
        if(!empty($students)){
            return $this->view->showStudentsByCourse($students);
        }
        else{
            return $this->view->showError('No existe un curso con ese id');
        }
    }
    public function showError($error){
        return $this->view->showError($error);
    }

}