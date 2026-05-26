<?php /** @var array $recetas */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Recetas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: auto; }
        .form-group, .filter-bar { margin-bottom: 10px; }
        input, textarea, select, button { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px; }
        .receta { border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 15px; background: #fff; }
        .receta h3 { margin-top: 0; color: #d35400; }
        .etiqueta { display: inline-block; background: #f39c12; color: white; padding: 3px 8px; border-radius: 12px; font-size: 0.8em; margin-bottom: 10px; }
        .btn-eliminar { color: red; text-decoration: none; font-size: 0.9em; float: right; }
        .filter-bar { display: flex; gap: 10px; align-items: center; background: #f4f4f4; padding: 10px; border-radius: 5px; }
        .filter-bar select, .filter-bar button, .filter-bar a { width: auto; margin: 0; }
        .btn-limpiar { background: #ddd; color: black; padding: 8px 15px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>Plataforma de Recetas 🍳</h2>
    
    <form action="index.php?action=crear" method="POST" style="background: #fff3e0; padding: 15px; border-radius: 5px; border: 1px solid #ffe0b2;">
        <div class="form-group"><input type="text" name="titulo" placeholder="Nombre de la receta" required></div>
        <div class="form-group">
            <select name="tipo_comida" required>
                <option value="">Selecciona el tipo de comida</option>
                <option value="Desayuno">Desayuno</option>
                <option value="Almuerzo">Almuerzo</option>
                <option value="Cena">Cena</option>
                <option value="Postre">Postre</option>
                <option value="Bebida">Bebida</option>
            </select>
        </div>
        <div class="form-group"><textarea name="ingredientes" rows="3" placeholder="Ingredientes (separados por comas)..." required></textarea></div>
        <div class="form-group"><textarea name="instrucciones" rows="4" placeholder="Pasos de preparación..." required></textarea></div>
        <button type="submit" style="background: #d35400; color: white; border: none;">Guardar Receta</button>
    </form>

    <hr style="margin: 30px 0;">

    <form action="index.php" method="GET" class="filter-bar">
        <strong>Filtrar por:</strong>
        <select name="tipo">
            <option value="">Todos los tipos</option>
            <option value="Desayuno" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Desayuno') ? 'selected' : ''; ?>>Desayuno</option>
            <option value="Almuerzo" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Almuerzo') ? 'selected' : ''; ?>>Almuerzo</option>
            <option value="Cena" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Cena') ? 'selected' : ''; ?>>Cena</option>
            <option value="Postre" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Postre') ? 'selected' : ''; ?>>Postre</option>
            <option value="Bebida" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'Bebida') ? 'selected' : ''; ?>>Bebida</option>
        </select>
        <button type="submit">Filtrar</button>
        <a href="index.php" class="btn-limpiar">Limpiar</a>
    </form>

    <div class="lista-recetas">
        <?php foreach ($recetas as $r): ?>
            <div class="receta">
                <a href="index.php?action=eliminar&id=<?php echo $r['id']; ?>" class="btn-eliminar">Eliminar</a>
                <h3><?php echo htmlspecialchars($r['titulo']); ?></h3>
                <span class="etiqueta"><?php echo htmlspecialchars($r['tipo_comida']); ?></span>
                <p><strong>Ingredientes:</strong><br> <?php echo nl2br(htmlspecialchars($r['ingredientes'])); ?></p>
                <p><strong>Preparación:</strong><br> <?php echo nl2br(htmlspecialchars($r['instrucciones'])); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>