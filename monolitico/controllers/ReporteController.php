<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../config/database.php';

class ReporteController extends BaseController
{
    public function index(): void
    {
        $db = Database::connect();
        $general = $db->query("SELECT
            COUNT(*) total,
            SUM(CASE WHEN estado='finalizada' THEN 1 ELSE 0 END) finalizadas,
            SUM(CASE WHEN estado IN ('nueva','activa') THEN 1 ELSE 0 END) pendientes,
            SUM(CASE WHEN estado='impedimento' THEN 1 ELSE 0 END) impedimentos
            FROM historias")->fetch();

        $porResponsable = $db->query("SELECT responsable,
            COUNT(*) total,
            SUM(CASE WHEN estado='finalizada' THEN 1 ELSE 0 END) finalizadas,
            SUM(CASE WHEN estado IN ('nueva','activa') THEN 1 ELSE 0 END) pendientes,
            SUM(CASE WHEN estado='impedimento' THEN 1 ELSE 0 END) impedimentos
            FROM historias GROUP BY responsable ORDER BY responsable")->fetchAll();

        $porSprint = $db->query("SELECT s.nombre, COUNT(h.id) total,
            SUM(CASE WHEN h.estado='finalizada' THEN 1 ELSE 0 END) completadas,
            SUM(CASE WHEN h.estado <> 'finalizada' OR h.estado IS NULL THEN 1 ELSE 0 END) no_completadas
            FROM sprints s LEFT JOIN historias h ON h.sprint_id = s.id GROUP BY s.id ORDER BY s.fecha_inicio DESC")->fetchAll();

        $this->render('reportes/index', compact('general','porResponsable','porSprint'));
    }
}
