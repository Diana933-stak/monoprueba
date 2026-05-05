<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Sprint.php';

class SprintController extends BaseController
{
    private Sprint $model;

    public function __construct() { $this->model = new Sprint(); }

    public function index(): void { $this->render('sprints/index', ['sprints' => $this->model->all()]); }
    public function create(): void { $this->render('sprints/form', ['sprint' => null]); }

    public function store(): void {
        if (empty($_POST['nombre']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])) {
            $_SESSION['error'] = 'Todos los campos del sprint son obligatorios';
            $this->redirect('sprints/create');
        }
        $this->model->create(['nombre'=>trim($_POST['nombre']), 'fecha_inicio'=>$_POST['fecha_inicio'], 'fecha_fin'=>$_POST['fecha_fin']]);
        $_SESSION['success'] = 'Sprint creado';
        $this->redirect('sprints');
    }

    public function edit(int $id): void { $this->render('sprints/form', ['sprint' => $this->model->find($id)]); }
    public function update(int $id): void { $this->model->update($id, ['nombre'=>trim($_POST['nombre']), 'fecha_inicio'=>$_POST['fecha_inicio'], 'fecha_fin'=>$_POST['fecha_fin']]); $_SESSION['success']='Sprint actualizado'; $this->redirect('sprints'); }
    public function destroy(int $id): void { $this->model->delete($id); $_SESSION['success']='Sprint eliminado'; $this->redirect('sprints'); }
}
