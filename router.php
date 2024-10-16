<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';

require_once './app/controllers/students.controller.php';
require_once './app/controllers/courses.controller.php';
require_once './app/controllers/registered.controller.php';

require_once 'app/controllers/auth.controller.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname ($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listarCursos';
if (!empty ($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode ('/', $action);

switch($params[0]){
    case 'home':
        echo ('hola');
    break;
    case 'listarAlumnos':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $studentsController->showStudents();
    break;
    case 'listarAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $id = $params[1];
        $studentsController->showStudent($id);
    break;
    case 'listarCursos':
        sessionAuthMiddleware($res);
        $coursesController = new coursesController($res);
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
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        $coursesController->showCourse($params[1]);
    break;
    case 'inscriptos':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if(!empty($params[1])){
            $enrollmentController = new courseEnrollmentController($res);
            $enrollmentController->showStudentsByCourse($params[1]);
        }else{
            echo ('ingrese id del curso');
        }
    break;
    case 'formNuevoCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        $coursesController->showForm();
    break;
    case 'formEdit':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        $id = $params[1];
        $coursesController->showEditForm($id);
    break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'login':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    break;
    default:
        echo ('404 page not found');
    break;
}
?>
