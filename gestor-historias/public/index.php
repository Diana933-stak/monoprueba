<?php
session_start();
require_once __DIR__ . '/../controllers/SprintController.php';
require_once __DIR__ . '/../controllers/HistoriaController.php';
require_once __DIR__ . '/../controllers/ReporteController.php';

$route = $_GET['route'] ?? 'dashboard';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($route) {
    case 'dashboard':
        require_once __DIR__ . '/../models/Sprint.php';
        $sprints = (new Sprint())->withStats();
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/dashboard/index.php';
        require __DIR__ . '/../views/layouts/footer.php';
        break;
    case 'sprints': (new SprintController())->index(); break;
    case 'sprints/create': (new SprintController())->create(); break;
    case 'sprints/store': (new SprintController())->store(); break;
    case 'sprints/edit': (new SprintController())->edit($id); break;
    case 'sprints/update': (new SprintController())->update($id); break;
    case 'sprints/delete': (new SprintController())->destroy($id); break;
    case 'historias': (new HistoriaController())->index(); break;
    case 'historias/create': (new HistoriaController())->create(); break;
    case 'historias/store': (new HistoriaController())->store(); break;
    case 'historias/edit': (new HistoriaController())->edit($id); break;
    case 'historias/update': (new HistoriaController())->update($id); break;
    case 'historias/delete': (new HistoriaController())->destroy($id); break;
    case 'reportes': (new ReporteController())->index(); break;
    default: http_response_code(404); echo 'Ruta no encontrada';
}
