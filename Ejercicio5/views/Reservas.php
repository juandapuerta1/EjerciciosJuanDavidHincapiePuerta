<?php 
/** @var array $reservas */ 
/** @var string $mensaje */ 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 10px; }
        input, select, button { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h2>Reservar una Cita</h2>
    
    <?php if ($mensaje): ?>
        <div class="alert <?php echo ($_GET['msg'] == 'ok') ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=crear" method="POST">
        <div class="form-group">
            <input type="text" name="nombre_cliente" placeholder="Tu Nombre Completo" required>
        </div>
        <div class="form-group">
            <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <select name="hora" required>
                <option value="">Selecciona una hora</option>
                <option value="09:00:00">09:00 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="11:00:00">11:00 AM</option>
                <option value="14:00:00">02:00 PM</option>
                <option value="15:00:00">03:00 PM</option>
                <option value="16:00:00">04:00 PM</option>
            </select>
        </div>
        <button type="submit">Confirmar Reserva</button>
    </form>

    <h3>Citas Programadas</h3>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $r): ?>
                <tr>
                    <td><?php echo htmlspecialchars($r['fecha']); ?></td>
                    <td><?php echo date('h:i A', strtotime($r['hora'])); ?></td>
                    <td><?php echo htmlspecialchars($r['nombre_cliente']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>