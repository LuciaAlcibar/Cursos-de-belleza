<?php
require_once './app/controllers/students.controller.php';
require_once './app/controllers/courses.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname ($_SERVER['PHP_SELF']).'/');
$action = 'listarCursos';
if (!empty ($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode ('/', $action);

switch($params[0]){
    case 'listarAlumnos':
        $studentsController = new studentsController();
        $studentsController->showStudents();
    break;
    case 'listarAlumno':
        $studentsController = new studentsController();
        $id = $params[1];
        $studentsController->showStudent($id);
    break;
    case 'listarCursos':
        $coursesController = new coursesController();
        if(empty($params[1])){
            $coursesController->showCourses();
        }elseif($params[1]=='Peluqueria' || $params[1]=='peluqueria'){
            $coursesController->showCoursesByCategory($params[1]);
        }
        elseif($params[1]=='Uñas' || $params[1]=='uñas'){
            $coursesController->showCoursesByCategory($params[1]);
        }
        elseif($params[1]=='Cuidados' || $params[1]=='cuidados'){
            $coursesController->showCoursesByCategory($params[1]);
        }
        elseif($params[1]=='Maquillaje' || $params[1]=='maquillaje'){
            $coursesController->showCoursesByCategory($params[1]);
        }
        else{
            echo ('404 page not found');
        }
        
    break;
    case 'listarCurso':
        $coursesController = new coursesController();
        $id = $params[1];
        $coursesController->showCourse($id);
    break;
    case 'listarCursosDisponibles':
        $coursesController = new coursesController();
        $coursesController->showAvailableCourses();
    break;
    default:
        echo ('404 page not found');
    break;
}
?>
