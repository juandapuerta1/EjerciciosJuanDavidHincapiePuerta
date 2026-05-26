<?php /** @var array|null $resultado */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Propinas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 400px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        input, select, button { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .resultado { background-color: #f4f4f4; padding: 15px; margin-top: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Calculadora de Propinas</h2>
    
    <form action="index.php" method="POST">
        <div class="form-group">
            <label>Monto de la cuenta ($):</label>
            <input type="number" step="0.01" name="monto" required>
        </div>
        <div class="form-group">
            <label>Porcentaje de propina:</label>
            <select name="porcentaje">
                <option value="10">10%</option>
                <option value="15">15%</option>
                <option value="20">20%</option>
            </select>
        </div>
        <button type="submit">Calcular</button>
    </form>

    <?php if ($resultado): ?>
        <div class="resultado">
            <p><strong>Monto original:</strong> $<?php echo number_format($resultado['monto_original'], 2); ?></p>
            <p><strong>Propina (<?php echo $resultado['porcentaje']; ?>%):</strong> $<?php echo number_format($resultado['total_propina'], 2); ?></p>
            <hr>
            <p><strong>Total a pagar:</strong> $<?php echo number_format($resultado['total_pagar'], 2); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>