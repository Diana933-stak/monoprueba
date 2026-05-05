<h1>Dashboard</h1>
<div class="grid">
<?php foreach ($sprints as $s): $tot=(int)$s['total_historias']; $fin=(int)$s['finalizadas']; $p=$tot?round($fin*100/$tot):0; ?>
<div class="card"><h3><?= htmlspecialchars($s['nombre']) ?></h3><p><?= $s['fecha_inicio'] ?> - <?= $s['fecha_fin'] ?></p><p>Historias: <?= $tot ?> | Finalizadas: <?= $fin ?></p><p>Progreso: <?= $p ?>%</p><small>Nuevas: <?= (int)$s['nuevas'] ?>, Activas: <?= (int)$s['activas'] ?>, Impedimentos: <?= (int)$s['impedimentos'] ?></small></div>
<?php endforeach; ?>
</div>
