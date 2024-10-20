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

$action = 'home';
if (!empty ($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode ('/', $action);

switch($params[0]){
    case 'home':
      require_once 'templates/index.phtml';
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
        if(empty($params[1])){
            $studentsController->showError('Ingrese id del alumno que desea ver');
        }else{
            $studentsController->showStudent($params[1]);
        }
       
    break;
    case 'listarCursos': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        if (empty($params[1])) {
            $coursesController->showCourses();
        } else {
            $categoriasValidas = ['Peluqueria', 'peluqueria', 'Uñas', 'uñas', 'Cuidados', 'cuidados', 'Maquillaje', 'maquillaje'];
            if (in_array($params[1], $categoriasValidas)) {
                $coursesController->showCoursesByCategory($params[1]);
            } else {
                echo '404 page not found';
            }
        }
    break;
    case 'listarCurso': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        if(empty($params[1])){
            $coursesController->showError('Ingrese id del curso');
        }
        else{
            $coursesController->showCourse($params[1]);
        }
    break;
    case 'inscriptos':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $enrollmentController = new courseEnrollmentController($res);
        if(empty($params[1])){
            $enrollmentController->showError('Ingrese id del curso para ver sus inscriptos');
        }
        else{
            $enrollmentController->showStudentsByCourse($params[1]);
        }
    break;
    case 'formNuevoAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $studentsController->showForm();
    break;
    case 'agregarNuevoAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $studentsController->addNewStudent(); 
    break;
    case 'formEditarAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $student = $params[1];
        $studentsController->showEditForm($student);
    break;
    case 'editarAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController = new studentsController($res);
        $id = $params[1];
        $studentsController->updateStudent($id);
    break;
    case 'eliminarAlumno':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $studentsController= new studentsController($res);
        $student = $params[1];
        $studentsController->deleteStudent($student);
    break;
    case 'agregarNuevoCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        $coursesController->addNewCourse();
    break;
    case 'formNuevoCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController= new coursesController($res);
        $coursesController->showForm();
    break;
    case 'editarCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController = new coursesController($res);
        $id = $params[1];
        $coursesController->updateCourse($id);
    break;
    case 'formEditarCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController= new coursesController($res);
        $course = $params[1];
        $coursesController->showEditForm($course);
    break;
    case 'eliminarCurso':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $coursesController= new coursesController($res);
        $course = $params[1];
        $coursesController->deleteCourse($course);
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
       $controller = new studentsController($res);
       $controller->showError('404 page not found');
    break;
}
 /* tabla de ruteo 
 home/ -->
 listarAlumnos/ --> showStudents()                            // muestra todos los alumnos
 listarAlumno/:id/ --> showStudent($id)                       // muestra un alumno que se especifica por id
 listarCursos/:id/--> showCourses() o showCoursesByCategory() // muestra o todos los cursos o los cursos de la categoria que se le pase
 listarCurso/:id/ --> showCourse($id)                         // muestra un curso que se especifica por id
 inscriptos/:id/ --> showStudentsByCourse()                   // muestra los alumnnos inscriptos en un curso especificado por id
 formNuevoAlumno --> showForm()                               // muestra el formulario para agregar un nuevo alumno
 agregarNuevoAlumno --> addNewStudent()                       // agrega un alumno
 formEditarAlumno/:id --> showEditForm($id)                   // muestra el formulario para editar un alumno
 editarAlumno/:id --> updateStudent($id)                      // edita alumno especificado por id
 eliminarAlumno/:id --> deleteStudent($id)                    // elimina alumno especificado por id
 formNuevoCurso --> showForm()                                // muestra el form para agregar un nuevo curso
 agregarNuevoCurso --> addNewCourse()                         // agregar un curso
 formEditarCurso/:id --> showEditForm($id)                    // muestra el form para editar un curso especificado por id
 editarCurso/:id --> updateCourse($id)                        // edita un curso especificado por id
 eliminarCurso/:id --> deleteCourse($id)                      // elimina un curso especificado por id
 showLogin --> showLogin()                                    // muestra el formulario para iniciar sesion
 login --> login()                                            // inicia la sesion
 logout --> logout()                                          // cierra la sesion
 */

?>
