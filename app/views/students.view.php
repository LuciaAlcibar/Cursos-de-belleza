<?php

class studentsView{

    public function showStudents($students){
        require 'templates/studentsList.phtml';
    }
    public function showStudent($student){
        require 'templates/showStudent.phtml';
    }
}