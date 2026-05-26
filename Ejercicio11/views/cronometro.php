<?php /** @var array $tiempos */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cronómetro de Tareas (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; text-align: center; }
        .reloj { font-size: 4em; font-family: monospace; background: #333; color: #0f0; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        button { padding: 10px 20px; font-size: 1.1em; margin: 5px; cursor: pointer; border: none; border-radius: 5px; color: white; }
        .btn-iniciar { background: #28a745; }
        .btn-pausar { background: #ffc107; color: black; }
        .btn-reiniciar { background: #dc3545; }
        .guardar-seccion { background: #f4f4f4; padding: 15px; margin-top: 20px; border-radius: 5px; text-align: left; }
        input[type="text"] { width: calc(100% - 130px); padding: 10px; box-sizing: border-box; }
        .btn-guardar { background: #007bff; width: 120px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; text-align: left; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #eee; }
        .btn-eliminar { color: red; text-decoration: none; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Cronómetro de Actividades ⏱️</h2>

    <div class="reloj" id="pantalla">00:00:00</div>
    
    <div>
        <button class="btn-iniciar" onclick="iniciar()">Iniciar</button>
        <button class="btn-pausar" onclick="pausar()">Pausar</button>
        <button class="btn-reiniciar" onclick="reiniciar()">Reiniciar</button>
    </div>

    <div class="guardar-seccion">
        <h3>Guardar este tiempo</h3>
        <form action="index.php?action=crear" method="POST">
            <input type="hidden" name="tiempo_guardado" id="input-tiempo" value="00:00:00">
            <input type="text" name="actividad" placeholder="¿Qué estabas haciendo?" required>
            <button type="submit" class="btn-guardar">Guardar</button>
        </form>
    </div>

    <h3>Registro de Tiempos</h3>
    <table>
        <tr>
            <th>Actividad</th>
            <th>Tiempo</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($tiempos as $t): ?>
            <tr>
                <td><?php echo htmlspecialchars($t['actividad']); ?></td>
                <td><strong><?php echo htmlspecialchars($t['tiempo_guardado']); ?></strong></td>
                <td style="font-size: 0.8em; color: #666;"><?php echo $t['fecha']; ?></td>
                <td><a href="index.php?action=eliminar&id=<?php echo $t['id']; ?>" class="btn-eliminar">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        let tiempo = 0;
        let intervalo = null;
        const pantalla = document.getElementById('pantalla');
        const inputTiempo = document.getElementById('input-tiempo');

        function actualizarPantalla() {
            let horas = Math.floor(tiempo / 3600);
            let minutos = Math.floor((tiempo % 3600) / 60);
            let segundos = tiempo % 60;

            let textoHora = `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
            pantalla.innerText = textoHora;
            inputTiempo.value = textoHora; // Actualiza el formulario oculto automáticamente
        }

        function iniciar() {
            if (!intervalo) {
                intervalo = setInterval(() => {
                    tiempo++;
                    actualizarPantalla();
                }, 1000);
            }
        }

        function pausar() {
            clearInterval(intervalo);
            intervalo = null;
        }

        function reiniciar() {
            pausar();
            tiempo = 0;
            actualizarPantalla();
        }
    </script>
</body>
</html>