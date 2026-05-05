<?php
require_once __DIR__ . '/BaseModel.php';

class Historia extends BaseModel
{
    public function allWithSprint(): array
    {
        $sql = 'SELECT h.*, s.nombre AS sprint_nombre FROM historias h JOIN sprints s ON h.sprint_id = s.id ORDER BY h.created_at DESC';
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM historias WHERE id=:id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO historias (titulo, descripcion, responsable, estado, puntos, fecha_creacion, fecha_finalizacion, sprint_id)
                VALUES (:titulo, :descripcion, :responsable, :estado, :puntos, :fecha_creacion, :fecha_finalizacion, :sprint_id)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE historias
                SET titulo=:titulo, descripcion=:descripcion, responsable=:responsable, estado=:estado, puntos=:puntos,
                    fecha_finalizacion=:fecha_finalizacion, sprint_id=:sprint_id
                WHERE id=:id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM historias WHERE id=:id');
        return $stmt->execute(['id' => $id]);
    }

    public function groupedBySprint(): array
    {
        $sql = "SELECT s.id AS sprint_id, s.nombre AS sprint_nombre, h.*
                FROM sprints s
                LEFT JOIN historias h ON h.sprint_id = s.id
                ORDER BY s.fecha_inicio DESC, h.created_at DESC";
        $rows = $this->db->query($sql)->fetchAll();
        $result = [];
        foreach ($rows as $row) {
            $key = $row['sprint_id'];
            if (!isset($result[$key])) {
                $result[$key] = ['sprint_nombre' => $row['sprint_nombre'], 'historias' => []];
            }
            if (!empty($row['id'])) {
                $result[$key]['historias'][] = $row;
            }
        }
        return $result;
    }

    public function updateEstado(int $id, string $estado): bool
    {
        $fechaFinalizacion = $estado === 'finalizada' ? date('Y-m-d') : null;
        $stmt = $this->db->prepare('UPDATE historias SET estado=:estado, fecha_finalizacion=:fecha_finalizacion WHERE id=:id');
        return $stmt->execute(['id' => $id, 'estado' => $estado, 'fecha_finalizacion' => $fechaFinalizacion]);
    }
}
