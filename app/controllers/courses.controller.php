<?php
require_once 'app/models/courses.model.php';
require_once 'app/views/courses.view.php';

class coursesController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new coursesModel();
        $this->view = new coursesView();
    }
    public function showCourses(){
        //obtengo los cursos de la db
        $courses = $this->model->getCourses();
        //mando los cursos a la vista
        return $this->view->showCourses($courses);
    }
    public function showCourse($id){
        //obtengo el curso de la db
        $course = $this->model->getCourse($id);
        //mando el curso a la vista
        return $this->view->showCourse($course);
    }
    public function showAvailableCourses(){
        $courses = $this->model->getAvailableCourses();
        return $this->view->showAvailableCourses($courses);
    }
    public function showCoursesByCategory($category){
        $courses = $this->model->getCoursesByCategory($category);
        return $this->view->showCoursesByCategory($courses);
    }
    
}