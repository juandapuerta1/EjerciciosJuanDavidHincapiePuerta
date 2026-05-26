<?php /** @var array $notas */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Notas (MVC)</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 800px; margin: auto; }
        .form-group, .search-bar { margin-bottom: 10px; }
        input, textarea, button { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px; }
        .nota-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; margin-top: 20px; }
        .nota { border: 1px solid #ddd; padding: 15px; border-radius: 5px; background: #fafafa; }
        .nota h4 { margin-top: 0; margin-bottom: 5px; }
        .tag { font-size: 0.8em; background: #e0e0e0; padding: 3px 6px; border-radius: 3px; }
        .btn-eliminar { background: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer; text-decoration: none; display: inline-block; margin-top: 10px; border-radius: 3px; }
        .search-bar { display: flex; gap: 10px; align-items: center; }
        .btn-limpiar { background: #ddd; color: black; padding: 8px 15px; text-decoration: none; border-radius: 3px; margin-top: 5px; }
    </style>
</head>
<body>
    <h2>Gestor de Notas</h2>
    
    <form action="index.php?action=crear" method="POST">
        <input type="text" name="titulo" placeholder="Título de la nota" required>
        <input type="text" name="categoria" placeholder="Categoría (ej. Trabajo, Personal)" required>
        <textarea name="contenido" rows="4" placeholder="Escribe tu nota aquí..." required></textarea>
        <button type="submit">Guardar Nota</button>
    </form>

    <hr style="margin: 20px 0;">

    <form action="index.php" method="GET" class="search-bar">
        <input type="text" name="buscar" placeholder="Buscar por título o categoría..." value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
        <button type="submit" style="width: auto;">Buscar</button>
        <a href="index.php" class="btn-limpiar">Limpiar</a>
    </form>

    <div class="nota-grid">
        <?php foreach ($notas as $n): ?>
            <div class="nota">
                <h4><?php echo htmlspecialchars($n['titulo']); ?></h4>
                <span class="tag"><?php echo htmlspecialchars($n['categoria']); ?></span>
                <p><?php echo nl2br(htmlspecialchars($n['contenido'])); ?></p>
                <a href="index.php?action=eliminar&id=<?php echo $n['id']; ?>" class="btn-eliminar">Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>