<h1>Sprints</h1>
<a class="btn" href="index.php?route=sprints/create">Nuevo sprint</a>
<table><tr><th>Nombre</th><th>Inicio</th><th>Fin</th><th>Acciones</th></tr>
<?php foreach ($sprints as $s): ?>
<tr><td><?= htmlspecialchars($s['nombre']) ?></td><td><?= $s['fecha_inicio'] ?></td><td><?= $s['fecha_fin'] ?></td>
<td><a href="index.php?route=sprints/edit&id=<?= $s['id'] ?>">Editar</a> | <a href="index.php?route=sprints/delete&id=<?= $s['id'] ?>" onclick="return confirm('¿Eliminar sprint?')">Eliminar</a></td></tr>
<?php endforeach; ?></table>
