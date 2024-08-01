<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location: session.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_correcto = "foc";
    $password_correcto = "Fdwes!22";
    $user = $_POST['user'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($user === $user_correcto && $password === $password_correcto) {
        $_SESSION['user'] = $user;
        header("location: session.php");
        exit();
    } else {
        $mensaje_error = "incorrect credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sessions and cookies</title>
    <style>
    html,
    body {
        margin: 0px;
        padding: 0px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    body {
        background-color: black;
        color: #00FF00;
        font-family: monospace;
        font-size: 16px;
    }

    h1,
    h2 {
        color: #FFFFFF;
        font-weight: normal;
        text-align: center;
    }

    header {
        margin-top: 10px;
        display: flex;
        justify-content: center;
    }

    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .home,
    .doc,
    .git {
        width: 100px;
    }

    form {
        border: 1px solid #00FF00;
        padding: 5px;
        width: 80%;
        max-width: 400px;
        text-align: center;
    }

    label {
        margin: 5px;
    }

    input {
        margin: 5px;
        padding: 5px;
        width: 80%;
        border: 1px solid #00FF00;
        background-color: black;
        color: #00FF00;
    }

    button {
        margin: 0px 5px;
        padding: 5px;
        width: 40%;
        border: none;
        background-color: #006400;
        color: #00FF00;
        cursor: pointer;
    }

    .button {
            margin: 5px;
    }
    
    p {
        color: #00FF00;
        text-align: center;
    }

    #error {
        color: red;
        text-align: center;
    }

    footer {
            width: 100vw;
            background-color: #006400;
            color: #00FF00;
            text-align: center;
    }
    </style>
    <script>
        function goHome() {

            window.location.href = '/';

        }

        function goGit() {

            window.location.href = 'https://github.com/s7rg77/sessions-and-cookies';

        }

        function goDoc() {

            window.location.href = '/doc';
            
        }
    </script>
</head>

<body>
    <header>
        <button class="doc" onclick="goDoc()">doc</button>
        <button class="git" onclick="goGit()">git</button>
        <button class="home" onclick="goHome()">back</button>
    </header>

    <main>
        <h1>sessions and cookies</h1>
        <h2>sergio lópez</h2>
        <h2>login</h2>
        <form method="post" action="login.php">
            <label for="user">user</label><br>
            <input type="text" id="user" name="user" required><br>
            <label for="password">password</label><br>
            <input type="password" id="password" name="password" required><br>
            <button class="button" type="submit">login</button>
        </form>
        <p>correct user = foc<br>correct password = Fdwes!22</p>
        <?php if (isset($mensaje_error)) : ?>
        <p id="error"><?php echo $mensaje_error; ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <h3>desarrollo web entorno servidor</h3>
    </footer>

</body>

</html>