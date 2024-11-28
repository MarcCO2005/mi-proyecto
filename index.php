<?php
session_start();

// Lista de palabras para el juego
$palabras = ['elefante', 'jirafa', 'hipopotamo', 'rinoceronte', 'cocodrilo', 'camello', 'chimpance'];

// Inicializar el juego
if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = $palabras[array_rand($palabras)];
    $_SESSION['vidas'] = 6; // Número máximo de vidas
    $_SESSION['letras_acertadas'] = str_repeat('?', strlen($_SESSION['palabra']));
    $_SESSION['letras_usadas'] = [];
}

// Procesar la letra enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['letra'])) {
    $letra = strtolower($_POST['letra']);

    // Verificar si la letra ya se ha usado
    if (in_array($letra, $_SESSION['letras_usadas'])) {
        echo "Ya has usado la letra '$letra'. Intenta con otra.<br>";
    } else {
        // Añadir la letra a las usadas
        $_SESSION['letras_usadas'][] = $letra;

        // Verificar si la letra está en la palabra secreta
        if (strpos($_SESSION['palabra'], $letra) !== false) {
            for ($i = 0; $i < strlen($_SESSION['palabra']); $i++) {
                if ($_SESSION['palabra'][$i] == $letra) {
                    $_SESSION['letras_acertadas'][$i] = $letra;
                }
            }
        } else {
            $_SESSION['vidas']--;
        }
    }
}

// Comprobar si se ha ganado o perdido
if ($_SESSION['letras_acertadas'] == $_SESSION['palabra']) {
    echo "¡Enhorabuena! Has ganado :) La palabra era: " . $_SESSION['palabra'] . "<br>";
    session_destroy();
    echo '<a href="">Jugar de nuevo</a>';
    exit();
} elseif ($_SESSION['vidas'] <= 0) {
    echo "Lo siento, has perdido :( La palabra era: " . $_SESSION['palabra'] . "<br>";
    session_destroy();
    echo '<a href="">Jugar de nuevo</a>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ahorcado</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e1e2f;
            color: #e4e4e7;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            color: #ff6b6b;
            font-size: 3rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.5rem;
            margin: 10px 0;
        }
        form {
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        label {
            font-size: 1.2rem;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: #2d2d44;
            color: #fff;
        }
        button {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #e63946;
        }
        a {
            color: #4fc3f7;
            text-decoration: none;
            font-size: 1.2rem;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            text-align: center;
            width: 90%;
            max-width: 500px;
            background-color: #252536;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>Juego del Ahorcado</h1>
    <p>Palabra secreta: <?php echo $_SESSION['letras_acertadas']; ?></p>
    <p>Vidas restantes: <?php echo $_SESSION['vidas']; ?></p>
    <form method="post">
        <label for="letra">Introduce una letra:</label>
        <input type="text" name="letra" id="letra" maxlength="1" required>
        <button type="submit">Adivinar</button>
    </form>
    <p>Letras usadas: <?php echo implode(', ', $_SESSION['letras_usadas']); ?></p>
</body>
</html>