<h1>Historias por Sprint</h1>
<a class="btn" href="index.php?route=historias/create">+ Nueva historia</a>

<?php foreach ($data as $sprintId => $block):
    $historias = $block['historias'];
    $total = count($historias);
    $fin = count(array_filter($historias, fn($h) => $h['estado'] === 'finalizada'));
    $nuevas = count(array_filter($historias, fn($h) => $h['estado'] === 'nueva'));
    $activas = count(array_filter($historias, fn($h) => $h['estado'] === 'activa'));
    $imp = count(array_filter($historias, fn($h) => $h['estado'] === 'impedimento'));
    $prog = $total ? round($fin * 100 / $total) : 0;
?>
<section class="card">
    <div class="row between">
        <h2><?= htmlspecialchars($block['sprint_nombre']) ?></h2>
        <span class="badge"><?= $prog ?>% completado</span>
    </div>
    <p class="muted">Total: <?= $total ?> | Nuevas: <?= $nuevas ?> | Activas: <?= $activas ?> | Finalizadas: <?= $fin ?> | Impedimentos: <?= $imp ?></p>

    <table>
        <tr><th>Título</th><th>Responsable</th><th>Puntos</th><th>Estado</th><th>Creación</th><th>Finalización</th><th>Acciones</th></tr>
        <?php if (!$historias): ?>
            <tr><td colspan="7">Sin historias en este sprint.</td></tr>
        <?php endif; ?>
        <?php foreach ($historias as $h): ?>
            <tr>
                <td><?= htmlspecialchars($h['titulo']) ?></td>
                <td><?= htmlspecialchars($h['responsable']) ?></td>
                <td><?= (int)$h['puntos'] ?></td>
                <td><span class="estado <?= $h['estado'] ?>"><?= $h['estado'] ?></span></td>
                <td><?= $h['fecha_creacion'] ?></td>
                <td><?= $h['fecha_finalizacion'] ?: '-' ?></td>
                <td>
                    <a href="index.php?route=historias/edit&id=<?= $h['id'] ?>">Editar</a> |
                    <a href="index.php?route=historias/delete&id=<?= $h['id'] ?>" onclick="return confirm('¿Eliminar historia?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php endforeach; ?>
