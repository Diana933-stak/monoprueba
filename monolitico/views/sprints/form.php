<h1><?= $sprint ? 'Editar' : 'Crear' ?> Sprint</h1>
<form method="post" action="index.php?route=<?= $sprint ? 'sprints/update&id=' . $sprint['id'] : 'sprints/store' ?>">
<label>Nombre <input name="nombre" required value="<?= $sprint['nombre'] ?? '' ?>"></label>
<label>Fecha inicio <input type="date" name="fecha_inicio" required value="<?= $sprint['fecha_inicio'] ?? '' ?>"></label>
<label>Fecha fin <input type="date" name="fecha_fin" required value="<?= $sprint['fecha_fin'] ?? '' ?>"></label>
<button type="submit">Guardar</button>
</form>
