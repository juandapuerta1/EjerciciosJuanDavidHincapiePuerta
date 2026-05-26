<?php /** @var string|null $passwordGenerada */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 400px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        .checkbox-group { margin-bottom: 10px; }
        input[type="number"], button { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .resultado { background-color: #e8f5e9; padding: 15px; margin-top: 20px; border-radius: 5px; text-align: center; border: 1px solid #c8e6c9; }
        .password { font-size: 1.2em; font-family: monospace; font-weight: bold; word-break: break-all; }
    </style>
</head>
<body>
    <h2>Generador de Contraseñas</h2>
    
    <form action="index.php" method="POST">
        <div class="form-group">
            <label>Longitud de la contraseña (4-128):</label>
            <input type="number" name="longitud" value="12" min="4" max="128" required>
        </div>
        
        <div class="checkbox-group">
            <label><input type="checkbox" name="mayusculas" checked> Incluir Mayúsculas (A-Z)</label><br>
            <label><input type="checkbox" name="minusculas" checked> Incluir Minúsculas (a-z)</label><br>
            <label><input type="checkbox" name="numeros" checked> Incluir Números (0-9)</label><br>
            <label><input type="checkbox" name="simbolos" checked> Incluir Símbolos (!@#...)</label>
        </div>

        <button type="submit">Generar Contraseña</button>
    </form>

    <?php if ($passwordGenerada): ?>
        <div class="resultado">
            <p>Tu contraseña segura:</p>
            <p class="password"><?php echo htmlspecialchars($passwordGenerada); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>