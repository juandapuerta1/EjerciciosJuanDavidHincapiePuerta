<?php /** @var array $puntajes */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Memoria (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; text-align: center; }
        .tablero { display: grid; gap: 10px; justify-content: center; margin-top: 20px; }
        .carta { width: 80px; height: 80px; background: #007bff; color: transparent; font-size: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer; border-radius: 8px; user-select: none; transition: transform 0.2s; }
        .carta.revelada { background: #fff; border: 2px solid #007bff; color: black; cursor: default; }
        .carta.emparejada { background: #28a745; border-color: #28a745; color: white; cursor: default; }
        #formulario-victoria { display: none; margin-top: 20px; background: #e8f5e9; padding: 20px; border-radius: 8px; border: 1px solid #c8e6c9; }
        input, select, button { padding: 8px; margin: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Juego de Memoria 🧠</h2>

    <div>
        <label>Dificultad:</label>
        <select id="dificultad" onchange="iniciarJuego()">
            <option value="Facil">Fácil (8 cartas)</option>
            <option value="Medio">Medio (12 cartas)</option>
            <option value="Dificil">Difícil (16 cartas)</option>
        </select>
        <p>Movimientos: <strong id="contador-movimientos">0</strong></p>
    </div>

    <div id="tablero" class="tablero" style="grid-template-columns: repeat(4, 80px);"></div>

    <div id="formulario-victoria">
        <h3>¡Felicidades! Ganaste en <span id="movimientos-finales"></span> movimientos.</h3>
        <form action="index.php?action=guardar" method="POST">
            <input type="hidden" name="movimientos" id="input-movimientos">
            <input type="hidden" name="dificultad" id="input-dificultad">
            <input type="text" name="nombre_jugador" placeholder="Ingresa tu nombre..." required>
            <button type="submit" style="background: #28a745; color: white; border: none; cursor:pointer;">Guardar Puntaje</button>
        </form>
    </div>

    <h3>Top 10 Mejores Puntajes</h3>
    <table>
        <tr>
            <th>Jugador</th>
            <th>Movimientos</th>
            <th>Dificultad</th>
        </tr>
        <?php foreach ($puntajes as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['nombre_jugador']); ?></td>
                <td><?php echo $p['movimientos']; ?></td>
                <td><?php echo htmlspecialchars($p['dificultad']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        const todosLosEmojis = ['🍎', '🍌', '🍇', '🍉', '🍓', '🍒', '🍍', '🥝'];
        let cartas = [], primeraCarta = null, segundaCarta = null, movimientos = 0, paresEncontrados = 0, bloqueado = false;

        function iniciarJuego() {
            const dificultad = document.getElementById('dificultad').value;
            let pares = dificultad === 'Facil' ? 4 : (dificultad === 'Medio' ? 6 : 8);
            let emojisUsados = todosLosEmojis.slice(0, pares);
            
            // Duplicar y mezclar
            cartas = [...emojisUsados, ...emojisUsados].sort(() => Math.random() - 0.5);

            const tablero = document.getElementById('tablero');
            tablero.innerHTML = '';
            document.getElementById('formulario-victoria').style.display = 'none';
            movimientos = 0;
            paresEncontrados = 0;
            actualizarMovimientos();

            cartas.forEach((emoji, index) => {
                const div = document.createElement('div');
                div.classList.add('carta');
                div.dataset.emoji = emoji;
                div.onclick = () => voltearCarta(div);
                tablero.appendChild(div);
            });
        }

        function voltearCarta(carta) {
            if (bloqueado || carta === primeraCarta || carta.classList.contains('revelada') || carta.classList.contains('emparejada')) return;

            carta.innerText = carta.dataset.emoji;
            carta.classList.add('revelada');

            if (!primeraCarta) {
                primeraCarta = carta;
            } else {
                segundaCarta = carta;
                movimientos++;
                actualizarMovimientos();
                verificarPar();
            }
        }

        function verificarPar() {
            bloqueado = true;
            if (primeraCarta.dataset.emoji === segundaCarta.dataset.emoji) {
                primeraCarta.classList.replace('revelada', 'emparejada');
                segundaCarta.classList.replace('revelada', 'emparejada');
                paresEncontrados++;
                resetearTurno();
                
                if (paresEncontrados === cartas.length / 2) {
                    mostrarVictoria();
                }
            } else {
                setTimeout(() => {
                    primeraCarta.innerText = '';
                    segundaCarta.innerText = '';
                    primeraCarta.classList.remove('revelada');
                    segundaCarta.classList.remove('revelada');
                    resetearTurno();
                }, 1000);
            }
        }

        function resetearTurno() {
            primeraCarta = null;
            segundaCarta = null;
            bloqueado = false;
        }

        function actualizarMovimientos() {
            document.getElementById('contador-movimientos').innerText = movimientos;
        }

        function mostrarVictoria() {
            document.getElementById('formulario-victoria').style.display = 'block';
            document.getElementById('movimientos-finales').innerText = movimientos;
            document.getElementById('input-movimientos').value = movimientos;
            document.getElementById('input-dificultad').value = document.getElementById('dificultad').value;
        }

        // Iniciar el juego automáticamente al cargar la página
        iniciarJuego(); 
    </script>
</body>
</html>