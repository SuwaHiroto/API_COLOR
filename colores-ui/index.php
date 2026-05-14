<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColorUI | Creador de Paletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="index-body">

    <div class="bg-glow"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="glass-card text-center">

                    <h2 class="fw-bold mb-2">ColorUI</h2>
                    <p class="text-muted mb-4">Elige un color base y descubre tu próxima interfaz matemática.</p>

                    <form action="generate.php" method="POST">
                        <div class="mb-4">
                            <label class="form-label text-muted fw-semibold mb-3 d-block">Haz clic en el círculo</label>
                            <input type="color" class="custom-color-picker" id="colorPicker" value="#6f42c1" title="Elige tu color">
                        </div>

                        <div class="divider">O INGRESA EL HEX</div>

                        <div class="mb-4">
                            <input type="text" class="form-control hex-input text-center mx-auto" id="colorHex" name="hex_color" value="#6F42C1" pattern="^#[0-9a-fA-F]{6}$" required placeholder="#000000" maxlength="7" style="max-width: 250px;">
                        </div>

                        <button type="submit" class="btn btn-generate w-100 mt-2">Generar Sistema de Diseño</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const picker = document.getElementById('colorPicker');
        const hexText = document.getElementById('colorHex');
        const root = document.documentElement;

        function updateLiveTheme(color) {
            root.style.setProperty('--brand-color', color);
        }

        picker.addEventListener('input', function() {
            hexText.value = this.value.toUpperCase();
            updateLiveTheme(this.value);
        });

        hexText.addEventListener('input', function() {
            let val = this.value;
            if (val.length > 0 && val[0] !== '#') {
                val = '#' + val;
                this.value = val;
            }
            if (/^#[0-9A-F]{6}$/i.test(val)) {
                picker.value = val;
                updateLiveTheme(val);
            }
        });
    </script>

</body>

</html>