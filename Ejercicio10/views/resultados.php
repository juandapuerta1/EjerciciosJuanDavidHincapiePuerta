<?php 
/** @var array $encuesta */ 
/** @var int $total_votos */ 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 500px; margin: auto; }
        .barra-bg { background: #e9ecef; border-radius: 3px; margin-top: 5px; overflow: hidden; height: 25px; border: 1px solid #ddd;}
        .barra-fill { background: #28a745; height: 100%; color: white; text-align: right; font-size: 13px; line-height: 25px; padding-right: 8px; box-sizing: border-box; white-space: nowrap;}
        .opcion-stat { margin-bottom: 20px; }
        a { display: block; text-align: center; margin-top: 20px; color: #555; text-decoration: none;}
    </style>
</head>
<body>
    <h2>Resultados: <?php echo htmlspecialchars($encuesta['pregunta']); ?></h2>
    <p>Total de votos recibidos: <strong><?php echo $total_votos; ?></strong></p>
    
    <?php foreach ($encuesta['opciones'] as $op): 
        $porcentaje = $total_votos > 0 ? round(($op['votos'] / $total_votos) * 100) : 0;
    ?>
        <div class="opcion-stat">
            <div><strong><?php echo htmlspecialchars($op['texto_opcion']); ?></strong> (<?php echo $op['votos']; ?> votos)</div>
            <div class="barra-bg">
                <div class="barra-fill" style="width: <?php echo $porcentaje; ?>%; min-width: 8%;">
                    <?php echo $porcentaje; ?>%
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="index.php">⬅ Volver al inicio</a>
</body>
</html>