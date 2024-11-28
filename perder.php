<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Has perdido</title>
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
            background-color: #e53935;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Lo siento, has perdido</h1>
    <a href="index.php">
        <button>Intentar de nuevo</button>
    </a>
</body>
</html>
