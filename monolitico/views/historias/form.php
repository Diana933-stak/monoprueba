<h1><?= $historia ? 'Editar' : 'Crear' ?> Historia</h1>
<form method="post" action="index.php?route=<?= $historia ? 'historias/update&id=' . $historia['id'] : 'historias/store' ?>">
<label>Título <input name="titulo" required value="<?= $historia['titulo'] ?? '' ?>"></label>
<label>Descripción <textarea name="descripcion" required><?= $historia['descripcion'] ?? '' ?></textarea></label>
<label>Responsable <input name="responsable" required value="<?= $historia['responsable'] ?? '' ?>"></label>
<label>Puntos <input type="number" min="1" name="puntos" required value="<?= $historia['puntos'] ?? 1 ?>"></label>
<label>Estado <select name="estado" required><?php foreach (['nueva','activa','finalizada','impedimento'] as $e): ?><option value="<?= $e ?>" <?= (($historia['estado'] ?? 'nueva')===$e)?'selected':'' ?>><?= $e ?></option><?php endforeach; ?></select></label>
<label>Sprint <select name="sprint_id" required><?php foreach ($sprints as $s): ?><option value="<?= $s['id'] ?>" <?= (($historia['sprint_id'] ?? 0)==$s['id'])?'selected':'' ?>><?= htmlspecialchars($s['nombre']) ?></option><?php endforeach; ?></select></label>
<button type="submit">Guardar</button>
</form>
