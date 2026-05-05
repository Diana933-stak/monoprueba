<h1>Reportes</h1>
<section class="card"><h2>Reporte general</h2>
<ul><li>Total historias: <?= (int)$general['total'] ?></li><li>Finalizadas: <?= (int)$general['finalizadas'] ?></li><li>Pendientes: <?= (int)$general['pendientes'] ?></li><li>Impedimento: <?= (int)$general['impedimentos'] ?></li></ul>
</section>
<section class="card"><h2>Por responsable</h2><table><tr><th>Responsable</th><th>Total</th><th>Finalizadas</th><th>Pendientes</th><th>Impedimentos</th></tr><?php foreach($porResponsable as $r): ?><tr><td><?= htmlspecialchars($r['responsable']) ?></td><td><?= $r['total'] ?></td><td><?= $r['finalizadas'] ?></td><td><?= $r['pendientes'] ?></td><td><?= $r['impedimentos'] ?></td></tr><?php endforeach; ?></table></section>
<section class="card"><h2>Por sprint</h2><table><tr><th>Sprint</th><th>Total</th><th>Completadas</th><th>No completadas</th><th>Progreso</th></tr><?php foreach($porSprint as $s): $p = $s['total']?round($s['completadas']*100/$s['total']):0; ?><tr><td><?= htmlspecialchars($s['nombre']) ?></td><td><?= $s['total'] ?></td><td><?= $s['completadas'] ?></td><td><?= $s['no_completadas'] ?></td><td><?= $p ?>%</td></tr><?php endforeach; ?></table></section>
