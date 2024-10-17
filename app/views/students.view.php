<?php

class studentsView{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showStudents($students){
        require 'templates/studentsList.phtml';
    }
    public function showStudent($student){
        require 'templates/showStudent.phtml';
    }
    public function showForm(){
        require_once 'templates/formNewStudent.phtml';
    }
    public function showError($error){
        require_once 'templates/error.phtml';
    }
    public function showEditForm($alumno){
        require_once 'templates/formEditStudent.phtml';
    }
}