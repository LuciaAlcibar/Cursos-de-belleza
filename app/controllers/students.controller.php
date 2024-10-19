<?php
require_once 'app/models/students.model.php';
require_once 'app/views/students.view.php';

class studentsController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new studentsModel();
        $this->view = new studentsView($res->user);
    }
    public function showStudents(){
        //obtengo los alumnos de la db
        $students = $this->model->getStudents();
        //mando los alumnos a la vista
        return $this->view->showStudents($students);
    }
    public function showStudent($id){
        //obtengo el alumno de la db
        $student = $this->model->getStudent($id);
        if (!empty($student)){
            return $this->view->showStudent($student);
        }
        else{
            return $this->view->showError('no existe un alumno con ese id');
        }
    }
    public function showError($error){
        $this->view->showError($error);
    }
    public function addNewStudent(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                    $this->view->showError('ERROR: falta completar el nombre del alumno');
                    return;
                }
                if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
                    $this->view->showError('ERROR: falta completar el apellido del alumno');
                    return;
                }
                if (!isset($_POST['dni']) || empty($_POST['dni'])) {
                    $this->view->showError('ERROR: falta completar el DNI del alumno');
                    return;
                }
                if (!isset($_POST['celular']) || empty($_POST['celular'])) {
                    $this->view->showError('ERROR: falta completar el celular del alumno');
                    return;
                }
                if (!isset($_POST['domicilio']) || empty($_POST['domicilio'])) {
                    $this->view->showError('ERROR: falta completar el domicilio del alumno');
                    return;
                }
        
                // Asignar variables
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $dni = $_POST['dni'];
                $celular = $_POST['celular'];
                $domicilio = $_POST['domicilio'];
        
                // Llamar al modelo para agregar el nuevo alumno
                $id = $this->model->addNewStudent($nombre, $apellido, $dni, $celular, $domicilio);
          
                header('Location: ' . BASE_URL . 'listarAlumnos');
            } else {
                $this->view->showForm();
            }
    }
    public function showForm(){
        return $this->view->showForm();
    }
    public function showEditForm($id){
        $alumno = $this->model->getstudent($id); 
        $this->view->showEditForm($alumno); 
    }
    public function updateStudent($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario enviados a través de POST
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $celular = $_POST['celular'];
            $domicilio = $_POST['domicilio'];
    
            // Llamar al modelo para actualizar el alumno
            $this->model->updateStudent($nombre, $apellido, $dni, $celular, $domicilio, $id);
    
            // Redirigir después de actualizar
            header('Location: ' . BASE_URL . 'listarAlumnos');
        } else {
            // Mostrar el formulario de edición
            $this->view->showEditForm($id);
        }
    }
    public function deleteStudent($id){
        $this->model->deleteStudent($id);
        header('Location: ' . BASE_URL . 'listarAlumnos');
    }
}