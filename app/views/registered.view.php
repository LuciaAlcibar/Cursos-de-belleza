<?php
class courseEnrollmentView{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showStudentsByCourse($students){
        require_once 'templates/studentsByCourse.phtml';
    }
    public function showError($error){
        require_once 'templates/error.phtml';
    }
}