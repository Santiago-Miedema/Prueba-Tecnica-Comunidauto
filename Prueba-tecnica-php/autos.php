<?php
$autos = [
    ['marca' => 'Ford', 'modelo' => 'Focus', 'precio' => 4800000],
    ['marca' => 'Chevrolet', 'modelo' => 'Onix', 'precio' => 3500000],
    ['marca' => 'Toyota', 'modelo' => 'Corolla', 'precio' => 8300000],
    ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'precio' => 9700000],
    ['marca' => 'Peugeot', 'modelo' => '208', 'precio' => 4200000],
    ['marca' => 'Renault', 'modelo' => 'Sandero', 'precio' => 3800000],
    ['marca' => 'Toyota', 'modelo' => 'Hilux', 'precio' => 17000000],
    ['marca' => 'Fiat', 'modelo' => 'Cronos', 'precio' => 4500000],
    ['marca' => 'Volkswagen', 'modelo' => 'Polo', 'precio' => 5200000],
    ['marca' => 'Chevrolet', 'modelo' => 'Tracker', 'precio' => 9500000],
];


// Funciones de filtrado/búsqueda
function normalizar($texto) {
    $texto = mb_strtolower(trim($texto));
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto); 
    $texto = preg_replace('/[^a-z0-9]/', '', $texto); 
    return $texto;
}

function filtrarPorPrecio(array $lista, float $maxPrecio): array {
    return array_filter($lista, fn($auto) => $auto['precio'] < $maxPrecio);
}

function buscarPorTexto(array $lista, string $texto): array {
    $texto = normalizar($texto);
    if ($texto === '') return $lista;

    return array_filter($lista, function($auto) use ($texto) {
        $marca = normalizar($auto['marca']);
        $modelo = normalizar($auto['modelo']);
        return str_contains($marca, $texto) || str_contains($modelo, $texto);
    });
}


// Detectar filtros
$resultados = $autos;
$filtrosAplicados = [];

if (isset($_GET['precio_max']) && $_GET['precio_max'] !== '') {
    $precioMax = (float) $_GET['precio_max'];
    $resultados = filtrarPorPrecio($autos, $precioMax);
    $filtrosAplicados['precio_max'] = "Precio máximo: $" . number_format($precioMax, 0, ',', '.');
}

if (isset($_GET['busqueda']) && $_GET['busqueda'] !== '') {
    $busqueda = $_GET['busqueda'];
    $resultados = buscarPorTexto($resultados, $busqueda);
    $filtrosAplicados['busqueda'] = "Búsqueda: '" . htmlspecialchars($busqueda) . "'";
}


$self = htmlspecialchars($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Autos - Comunidauto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <img src="./img/logo-mobile.png" alt="Logo Comunidauto" class="logo">
    </nav>

    <h1>Listado de Autos</h1>

    <!--Filtro por precio-->
    <form method="get" class="filtros" action="<?= $self ?>">
        <label for="precio_max">Precio máximo:</label>
        <input type="number" name="precio_max" id="precio_max" value="<?php echo isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : ''; ?>">
        <button type="submit">Filtrar</button>
    </form>

    <!--Buscador por texto -->
    <form method="get" class="filtros" action="<?= $self ?>">
        <label for="busqueda">Marca o modelo:</label>
        <input type="text" name="busqueda" id="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>

    
    <div class="reset-container">
        <button type="button" class="reset-btn" onclick="window.location.href='<?= $self ?>'">Reset</button>
    </div>

    <!-- Mostrar filtros aplicados -->
    <div class="filtros-aplicados">
        <?php if (empty($filtrosAplicados)): ?>
            <p><strong>Sin filtros aplicados</strong></p>
        <?php else: ?>
            <p><strong>Filtros aplicados:</strong></p>
            <div class="chips">
                <?php foreach ($filtrosAplicados as $key => $texto): ?>
                    <?php
                        $params = $_GET;
                        unset($params[$key]);
                        $url = $self . (empty($params) ? '' : '?' . http_build_query($params));
                    ?>
                    <a href="<?= $url ?>" class="chip">
                        <?= $texto ?> <span class="cerrar">&times;</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Resultados -->
    <?php if (empty($resultados)): ?>
        <p class="no-resultados">No se encontraron autos que coincidan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $auto): ?>
                <tr>
                    <td data-label="Marca"><?php echo htmlspecialchars($auto['marca']); ?></td>
                    <td data-label="Modelo"><?php echo htmlspecialchars($auto['modelo']); ?></td>
                    <td data-label="Precio">$<?php echo number_format($auto['precio'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

