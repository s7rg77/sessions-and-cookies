<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        if (!empty($phone) && !empty($email)) {
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
        }
    } elseif (isset($_POST['delete'])) {
        session_unset();
        session_destroy();
        setcookie('schedule', '', time() - 3600);
        header("location: login.php");
        exit();
    }
}
$phone_session = $_SESSION['phone'] ?? '';
$email_session = $_SESSION['email'] ?? '';
$schedule_cookie = $_COOKIE['schedule'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_schedule'])) {
    $schedule_seleccionado = $_POST['schedule'] ?? '';
    setcookie('schedule', $schedule_seleccionado, time() + (86400));
    $schedule_cookie = $schedule_seleccionado;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sessions and cookies</title>
    <style>
    body {
        background-color: black;
        color: #00FF00;
        font-family: monospace;
        font-size: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1,
    h2 {
        color: #FFFFFF;
        font-weight: normal;
    }

    #head {
        margin-top: 10px;
        margin-right: 10px;
        display: flex;
        justify-content: flex-end;
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

    #form {
        margin-bottom: 10px;
    }

    label {
        padding: 5px;
    }

    input {
        margin-top: 5px;
        padding: 5px;
        width: 80%;
        border: 1px solid #00FF00;
        background-color: black;
        color: #00FF00;
    }

    button {
        margin: 5px;
        padding: 5px;
        width: 40%;
        border: none;
        background-color: #006400;
        color: #00FF00;
        cursor: pointer;
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
        bottom: 0px;
        width: 100%;
        background-color: #006400;
        color: #00FF00;
        text-align: center;
        position: fixed;
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
    <div id="head">
        <button class="doc" onclick="goDoc()">doc</button>
        <button class="git" onclick="goGit()">git</button>
        <button class="home" onclick="goHome()">back</button>
    </div>
    <h1>sessions and cookies</h1>
    <h2>sergio lópez</h2>
    <h2>session</h2>
    <form method="post" action="session.php" id="form">
        <label for="phone">phone</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo $phone_session; ?>" required><br>
        <label for="email">email</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email_session; ?>" required><br>
        <button type="submit" name="save">save</button>
        <button type="submit" name="delete">delete</button>
    </form>
    <form method="post" action="session.php">
        <label for="schedule">schedule:</label>
        <select id="schedule" name="schedule">
            <option value="morning" <?php echo ($schedule_cookie === 'morning') ? 'selected' : ''; ?>>morning</option>
            <option value="evening" <?php echo ($schedule_cookie === 'evening') ? 'selected' : ''; ?>>evening</option>
            <option value="night" <?php echo ($schedule_cookie === 'night') ? 'selected' : ''; ?>>night</option>
        </select>
        <button type="submit" name="save_schedule">save schedule</button>
    </form>
</body>

<footer>
    <h3>desarrollo web entorno servidor</h3>
</footer>

</html>