<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Historia.php';
require_once __DIR__ . '/../models/Sprint.php';

class HistoriaController extends BaseController
{
    private Historia $model;
    private Sprint $sprintModel;

    public function __construct()
    {
        $this->model = new Historia();
        $this->sprintModel = new Sprint();
    }

    public function index(): void
    {
        $this->render('historias/index', ['data' => $this->model->groupedBySprint()]);
    }

    public function create(): void
    {
        $this->render('historias/form', ['historia' => null, 'sprints' => $this->sprintModel->all()]);
    }

    public function edit(int $id): void
    {
        $this->render('historias/form', ['historia' => $this->model->find($id), 'sprints' => $this->sprintModel->all()]);
    }

    private function validate(): bool
    {
        $required = ['titulo', 'descripcion', 'responsable', 'estado', 'puntos', 'sprint_id'];
        foreach ($required as $key) {
            if (!isset($_POST[$key]) || trim((string)$_POST[$key]) === '') {
                $_SESSION['error'] = 'Todos los campos obligatorios de historia deben completarse.';
                return false;
            }
        }
        if ((int)$_POST['puntos'] <= 0) {
            $_SESSION['error'] = 'Los puntos deben ser mayores a 0.';
            return false;
        }
        return true;
    }

    private function payload(): array
    {
        $estado = $_POST['estado'];
        return [
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion']),
            'responsable' => trim($_POST['responsable']),
            'estado' => $estado,
            'puntos' => (int)$_POST['puntos'],
            'sprint_id' => (int)$_POST['sprint_id'],
            'fecha_creacion' => date('Y-m-d'),
            'fecha_finalizacion' => $estado === 'finalizada' ? date('Y-m-d') : null,
        ];
    }

    public function store(): void
    {
        if (!$this->validate()) {
            $this->redirect('historias/create');
        }

        $this->model->create($this->payload());
        $_SESSION['success'] = 'Historia creada correctamente.';
        $this->redirect('historias');
    }

    public function update(int $id): void
    {
        if (!$this->validate()) {
            $this->redirect('historias/edit&id=' . $id);
        }

        $data = $this->payload();
        unset($data['fecha_creacion']);
        $this->model->update($id, $data);
        $_SESSION['success'] = 'Historia actualizada correctamente.';
        $this->redirect('historias');
    }

    public function destroy(int $id): void
    {
        $this->model->delete($id);
        $_SESSION['success'] = 'Historia eliminada.';
        $this->redirect('historias');
    }
}
