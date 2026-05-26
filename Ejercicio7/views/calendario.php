<?php /** @var array $eventos */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 700px; margin: auto; }
        .form-group { margin-bottom: 10px; }
        input, textarea, button { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px; }
        .evento { border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 10px; background: #fff; border-left: 5px solid #007bff; }
        .evento.hoy { border-left-color: #28a745; background-color: #e8f5e9; }
        .evento.pasado { border-left-color: #6c757d; opacity: 0.7; }
        .badge { background: #28a745; color: white; padding: 3px 8px; border-radius: 12px; font-size: 0.8em; margin-left: 10px; }
        .btn-eliminar { color: red; text-decoration: none; font-size: 0.9em; float: right; }
        .fecha-hora { color: #555; font-size: 0.9em; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Calendario de Eventos</h2>
    
    <form action="index.php?action=crear" method="POST" style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
        <div class="form-group"><input type="text" name="titulo" placeholder="Título del evento" required></div>
        <div class="form-group"><textarea name="descripcion" rows="3" placeholder="Descripción detallada..."></textarea></div>
        <div style="display: flex; gap: 10px;">
            <div class="form-group" style="flex: 1;"><input type="date" name="fecha" required></div>
            <div class="form-group" style="flex: 1;"><input type="time" name="hora" required></div>
        </div>
        <button type="submit">Agendar Evento</button>
    </form>

    <h3 style="margin-top: 30px;">Mis Eventos</h3>
    <div class="lista-eventos">
        <?php 
        $hoy = date('Y-m-d');
        foreach ($eventos as $e): 
            $clase = '';
            $badge = '';
            if ($e['fecha'] == $hoy) {
                $clase = 'hoy';
                $badge = '<span class="badge">¡Es Hoy!</span>';
            } elseif ($e['fecha'] < $hoy) {
                $clase = 'pasado';
            }
        ?>
            <div class="evento <?php echo $clase; ?>">
                <a href="index.php?action=eliminar&id=<?php echo $e['id']; ?>" class="btn-eliminar">Eliminar</a>
                <h4 style="margin: 0 0 5px 0;">
                    <?php echo htmlspecialchars($e['titulo']); ?>
                    <?php echo $badge; ?>
                </h4>
                <p class="fecha-hora">📅 <?php echo $e['fecha']; ?> | ⏰ <?php echo date('h:i A', strtotime($e['hora'])); ?></p>
                <p style="margin: 5px 0 0 0;"><?php echo nl2br(htmlspecialchars($e['descripcion'])); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>