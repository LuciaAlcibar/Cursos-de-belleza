<?php

class coursesView{
    public function showCourses($courses){
        require_once 'templates/coursesList.phtml';
    }

    public function showCourse($id){
        require_once 'templates/showCourse.phtml';
    }

    public function showAvailableCourses($courses){
        require_once 'templates/availableCourses.phtml';
    }
    public function showCoursesByCategory($courses){
        require_once 'templates/coursesByCategory.phtml';
    }
}