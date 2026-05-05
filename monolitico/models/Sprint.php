<?php
require_once __DIR__ . '/BaseModel.php';

class Sprint extends BaseModel
{
    public function all(): array
    {
        $stmt = $this->db->query('SELECT * FROM sprints ORDER BY fecha_inicio DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM sprints WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO sprints (nombre, fecha_inicio, fecha_fin) VALUES (:nombre, :fecha_inicio, :fecha_fin)');
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare('UPDATE sprints SET nombre=:nombre, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin WHERE id=:id');
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM sprints WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function withStats(): array
    {
        $sql = "SELECT s.*, 
                    COUNT(h.id) AS total_historias,
                    SUM(CASE WHEN h.estado = 'finalizada' THEN 1 ELSE 0 END) AS finalizadas,
                    SUM(CASE WHEN h.estado = 'nueva' THEN 1 ELSE 0 END) AS nuevas,
                    SUM(CASE WHEN h.estado = 'activa' THEN 1 ELSE 0 END) AS activas,
                    SUM(CASE WHEN h.estado = 'impedimento' THEN 1 ELSE 0 END) AS impedimentos
                FROM sprints s
                LEFT JOIN historias h ON h.sprint_id = s.id
                GROUP BY s.id
                ORDER BY s.fecha_inicio DESC";
        return $this->db->query($sql)->fetchAll();
    }
}
