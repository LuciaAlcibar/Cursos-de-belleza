<?php

class coursesView{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showCourses($courses){
        require_once 'templates/coursesList.phtml';
    }

    public function showCourse($course){
        require_once 'templates/showCourse.phtml';
    }
    
    public function showCoursesByCategory($courses){
        require_once 'templates/coursesByCategory.phtml';
    }
    public function showError($error){
        require_once 'templates/error.phtml';
    }
    public function showForm(){
        require_once 'templates/formNewCourse.phtml';
    }
    public function showEditForm($curso){
        require_once 'templates/formEditCourse.phtml';
    }
}