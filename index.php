<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<div class='error'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
    <h2>Login<h2>
    <form action="process.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
    </form>
    </div>
</body>
</html>