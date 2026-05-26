<?php 
/** @var array $gastos */ 
/** @var float $totalMes */ 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Gastos (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 10px; }
        input, select, button { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .resumen { background-color: #e3f2fd; padding: 15px; margin-top: 20px; border-radius: 5px; border: 1px solid #bbdefb; }
    </style>
</head>
<body>
    <h2>Gestor de Gastos</h2>
    
    <form action="index.php?action=crear" method="POST">
        <div class="form-group">
            <input type="text" name="descripcion" placeholder="Descripción del gasto..." required>
        </div>
        <div class="form-group">
            <select name="categoria" required>
                <option value="">Selecciona una categoría</option>
                <option value="Alimentación">Alimentación</option>
                <option value="Transporte">Transporte</option>
                <option value="Servicios">Servicios</option>
                <option value="Ocio">Ocio</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" step="0.01" name="monto" placeholder="Monto ($)" required>
        </div>
        <div class="form-group">
            <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <button type="submit">Agregar Gasto</button>
    </form>

    <div class="resumen">
        <strong>Total Gastos del Mes Actual: </strong> $<?php echo number_format($totalMes, 2); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $g): ?>
                <tr>
                    <td><?php echo htmlspecialchars($g['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($g['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($g['categoria']); ?></td>
                    <td>$<?php echo number_format($g['monto'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>