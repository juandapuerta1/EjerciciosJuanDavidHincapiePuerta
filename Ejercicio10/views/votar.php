<?php /** @var array $encuesta */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Votar</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 500px; margin: auto; }
        .opcion { display: block; background: #f4f4f4; padding: 10px; margin-bottom: 5px; border-radius: 3px; cursor: pointer; }
        button { width: 100%; padding: 10px; margin-top: 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        a { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
    </style>
</head>
<body>
    <h2><?php echo htmlspecialchars($encuesta['pregunta']); ?></h2>
    <form action="index.php?action=votar" method="POST">
        <input type="hidden" name="encuesta_id" value="<?php echo $encuesta['id']; ?>">
        <?php foreach ($encuesta['opciones'] as $op): ?>
            <label class="opcion">
                <input type="radio" name="opcion_id" value="<?php echo $op['id']; ?>" required>
                <?php echo htmlspecialchars($op['texto_opcion']); ?>
            </label>
        <?php endforeach; ?>
        <button type="submit">Enviar Voto</button>
    </form>
    <a href="index.php">⬅ Volver al inicio</a>
</body>
</html>