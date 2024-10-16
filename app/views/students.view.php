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
}