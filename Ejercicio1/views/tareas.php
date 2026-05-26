<!DOCTYPE html>
<?php /** @var array $tareas */ ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .tarea { display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #eee; }
        .completada { text-decoration: line-through; color: #888; }
        form { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] { flex-grow: 1; padding: 8px; }
        button { padding: 8px 15px; cursor: pointer; }
        a { text-decoration: none; font-size: 14px; margin-left: 10px; }
        .btn-completar { color: green; }
        .btn-eliminar { color: red; }
    </style>
</head>
<body>
    <h2>Mi Lista de Tareas</h2>
    
    <form action="index.php?action=crear" method="POST">
        <input type="text" name="descripcion" placeholder="Escribe una nueva tarea..." required>
        <button type="submit">Agregar</button>
    </form>

    <div class="lista-tareas">
        <?php foreach ($tareas as $t): ?>
            <div class="tarea">
                <span class="<?php echo $t['completada'] ? 'completada' : ''; ?>">
                    <?php echo htmlspecialchars($t['descripcion']); ?>
                </span>
                <div>
                    <?php if (!$t['completada']): ?>
                        <a href="index.php?action=completar&id=<?php echo $t['id']; ?>" class="btn-completar">✔</a>
                    <?php endif; ?>
                    <a href="index.php?action=eliminar&id=<?php echo $t['id']; ?>" class="btn-eliminar">❌</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>