<?php
// 1. Recibir y limpiar el color
$raw_hex = $_POST['hex_color'] ?? '#0d6efd';
$hex_clean = ltrim($raw_hex, '#');

if (!preg_match('/^[a-fA-F0-9]{6}$/', $hex_clean)) {
    $hex_clean = '0d6efd';
}

// 2. Consumir la API
$apiUrl = "https://color.serialif.com/" . $hex_clean;
$apiError = false;
$response = @file_get_contents($apiUrl);

if ($response === false) {
    $apiError = true;
} else {
    $apiData = json_decode($response, true);
}

// 3. Matemáticas de Color (PHP Backend)
function hexToRgb($hex)
{
    return [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
}
$baseRgb = hexToRgb($hex_clean);
$mainColor = '#' . $hex_clean;

$compR = 255 - $baseRgb[0];
$compG = 255 - $baseRgb[1];
$compB = 255 - $baseRgb[2];
$complementaryColor = sprintf("#%02x%02x%02x", $compR, $compG, $compB);

$bgR = (int)(($baseRgb[0] + 255 * 18) / 19);
$bgG = (int)(($baseRgb[1] + 255 * 18) / 19);
$bgB = (int)(($baseRgb[2] + 255 * 18) / 19);
$bgColor = sprintf("#%02x%02x%02x", $bgR, $bgG, $bgB);

$yiq = (($baseRgb[0] * 299) + ($baseRgb[1] * 587) + ($baseRgb[2] * 114)) / 1000;
$textColor = ($yiq >= 128) ? '#1a1a1a' : '#ffffff';
$bodyTextColor = '#4a4a4a';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Previa | UIForge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <style>
        :root {
            --ui-main: <?php echo $mainColor; ?>;
            --ui-complementary: <?php echo $complementaryColor; ?>;
            --ui-bg: <?php echo $bgColor; ?>;
            --ui-text-on-main: <?php echo $textColor; ?>;
            --ui-body-text: <?php echo $bodyTextColor; ?>;
        }
    </style>
</head>

<body class="generate-body">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold m-0 text-dark">Tu Sistema de Diseño</h3>
                <p class="text-muted m-0">Haz clic en un color para copiar el código HEX.</p>
            </div>
            <a href="index.php" class="btn btn-outline-dark rounded-pill px-4 fw-semibold">Nuevo Color</a>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-6 col-md-3">
                <div class="color-swatch" style="background-color: var(--ui-main); color: var(--ui-text-on-main);" onclick="copyToClipboard('<?= strtoupper($mainColor) ?>')">
                    <span class="swatch-label">Color Principal</span>
                    <span class="swatch-hex"><?= strtoupper($mainColor) ?></span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="color-swatch" style="background-color: var(--ui-complementary); color: #fff;" onclick="copyToClipboard('<?= strtoupper($complementaryColor) ?>')">
                    <span class="swatch-label">Complementario</span>
                    <span class="swatch-hex"><?= strtoupper($complementaryColor) ?></span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="color-swatch" style="background-color: var(--ui-bg); color: #1a1a1a;" onclick="copyToClipboard('<?= strtoupper($bgColor) ?>')">
                    <span class="swatch-label">Fondo App</span>
                    <span class="swatch-hex"><?= strtoupper($bgColor) ?></span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="color-swatch" style="background-color: var(--ui-body-text); color: #fff;" onclick="copyToClipboard('<?= strtoupper($bodyTextColor) ?>')">
                    <span class="swatch-label">Texto Base</span>
                    <span class="swatch-hex"><?= strtoupper($bodyTextColor) ?></span>
                </div>
            </div>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-bold">¡Color copiado al portapapeles!</div>
                </div>
            </div>
        </div>

        <div class="preview-wrapper">
            <nav class="navbar navbar-expand-lg ui-navbar">
                <div class="container px-4">
                    <a class="navbar-brand" href="#">ColorUI</a>
                    <div class="d-none d-lg-flex">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="#">Ipsum</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Dolor Sit</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Amet</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="ui-hero">
                <div class="container px-4">
                    <span class="badge bg-white text-dark shadow-sm mb-3 px-3 py-2 rounded-pill">Lorem Ipsum v2.0</span>
                    <h1 class="display-4 mb-3">Lorem ipsum dolor sit amet.</h1>
                    <p class="lead mb-5 mx-auto opacity-75" style="max-width: 600px;">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    <button class="ui-btn-primary">Pellentesque Habitant</button>
                </div>
            </div>

            <div class="container px-4 pb-5 mb-5">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="ui-card text-center h-100">
                            <div class="ui-icon-wrap">⚡</div>
                            <h5 class="fw-bold mb-3">Lorem Ipsum</h5>
                            <p class="opacity-75 m-0">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ui-card text-center h-100">
                            <div class="ui-icon-wrap">🛡️</div>
                            <h5 class="fw-bold mb-3">Dolor Sit Amet</h5>
                            <p class="opacity-75 m-0">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ui-card text-center h-100">
                            <div class="ui-icon-wrap">🧩</div>
                            <h5 class="fw-bold mb-3">Consectetur</h5>
                            <p class="opacity-75 m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="ui-footer text-center">
                <div class="container">
                    <h4 class="fw-bold mb-3">Excepteur sint occaecat?</h4>
                    <p class="opacity-75 mb-0">&copy; 2026 ColorUI - Nemo enim ipsam voluptatem.</p>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 2000
                });
                toast.show();
            }, function(err) {
                console.error('No se pudo copiar el texto: ', err);
            });
        }
    </script>

</body>

</html>