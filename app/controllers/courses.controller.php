<?php
require_once './app/models/courses.model.php';
require_once './app/views/courses.view.php';
require_once './app/models/db.model.php';

class coursesController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new coursesModel();
        $this->view = new coursesView($res->user);
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
        if (!empty($course)){
            return $this->view->showCourse($course);
        }
        else{
            return $this->view->showError('no existe un curso con ese id');
        }
        
    }
    public function showCoursesByCategory($category){
        $courses = $this->model->getCoursesByCategory($category);
        return $this->view->showCoursesByCategory($courses);
    }
    public function showForm(){
       return $this->view->showForm();
    }
    public function showError($error){
        return $this->view->showError($error);
    }
    public function addNewCourse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['categoria']) || empty($_POST['categoria'])) {
                $this->view->showError('ERROR: falta completar la categoría del curso');
                return;
            }
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                $this->view->showError('ERROR: falta completar el nombre del curso');
                return;
            }
            if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
                $this->view->showError('ERROR: falta completar la descripción del curso');
                return;
            }
            if (!isset($_POST['duracion']) || empty($_POST['duracion'])) {
                $this->view->showError('ERROR: falta completar la duración del curso');
                return;
            }
            if (!isset($_POST['profesor']) || empty($_POST['profesor'])) {
                $this->view->showError('ERROR: falta completar el nombre del profesor');
                return;
            }
            if (!isset($_POST['costo']) || empty($_POST['costo'])) {
                $this->view->showError('ERROR: falta completar el costo del curso');
                return;
            }
            if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
                $this->view->showError('ERROR: falta agregar una imagen');
                return;
            }
    
            // Asignar variables
            $categoria = $_POST['categoria'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $duracion = $_POST['duracion'];
            $profesor = $_POST['profesor'];
            $costo = $_POST['costo'];
            $imagen = $_POST['imagen'];
    
            // Llamar al modelo para agregar el nuevo curso
            $id = $this->model->addNewCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen);
      
            header('Location: listarCursos');

        } else {
            // Mostrar el formulario para agregar un nuevo curso
            $this->view->showForm();
        }
    }
    public function showEditForm($id) {
        $curso = $this->model->getCourse($id); 
        $this->view->showEditForm($curso); 
    }
    
    public function updateCourse($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario enviados a través de POST
            $categoria = $_POST['categoria'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $duracion = $_POST['duracion'];
            $profesor = $_POST['profesor'];
            $costo = $_POST['costo'];
            $imagen = $_POST['imagen'];
    
            // Llamar al modelo para actualizar el curso
            $this->model->updateCourse($categoria, $nombre, $descripcion, $duracion, $profesor, $costo, $imagen, $id);
    
            // Redirigir después de actualizar
            header('Location: ' . BASE_URL . 'listarCursos');
        } else {
            // Mostrar el formulario de edición
            $this->view->showEditForm($id);
        }
    }
    public function deleteCourse($id){
        $this->model->deleteCourse($id);
        header('Location: ' . BASE_URL . 'listarCursos');
    }
    
}