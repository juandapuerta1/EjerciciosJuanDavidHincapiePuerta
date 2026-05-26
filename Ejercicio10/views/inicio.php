<?php /** @var array $encuestas */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Encuestas</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 10px; }
        input, button { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px; }
        .encuesta-item { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px;}
        a.btn { display: inline-block; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; margin-top: 10px; }
        a.btn-res { background: #28a745; }
        a.btn-del { background: #dc3545; float: right; }
    </style>
</head>
<body>
    <h2>Crear Nueva Encuesta</h2>
    <form action="index.php?action=crear" method="POST" style="background: #e9ecef; padding: 15px; border-radius: 5px;">
        <div class="form-group"><input type="text" name="pregunta" placeholder="¿Cuál es tu pregunta?" required></div>
        <p style="margin: 5px 0; font-size: 0.9em;">Opciones de respuesta:</p>
        <div class="form-group"><input type="text" name="opciones[]" placeholder="Opción 1" required></div>
        <div class="form-group"><input type="text" name="opciones[]" placeholder="Opción 2" required></div>
        <div class="form-group"><input type="text" name="opciones[]" placeholder="Opción 3 (Opcional)"></div>
        <button type="submit" style="background: #007bff; color: white; border: none; cursor:pointer;">Publicar Encuesta</button>
    </form>

    <h3>Encuestas Activas</h3>
    <?php foreach ($encuestas as $e): ?>
        <div class="encuesta-item">
            <a href="index.php?action=eliminar&id=<?php echo $e['id']; ?>" class="btn btn-del">Eliminar</a>
            <h4 style="margin-top: 0;"><?php echo htmlspecialchars($e['pregunta']); ?></h4>
            <a href="index.php?action=ver&id=<?php echo $e['id']; ?>" class="btn">Votar</a>
            <a href="index.php?action=resultados&id=<?php echo $e['id']; ?>" class="btn btn-res">Ver Resultados</a>
        </div>
    <?php endforeach; ?>
</body>
</html>