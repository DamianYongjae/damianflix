<?php
if (isset($_POST["submitButton"])) {
    echo $_POST["firstName"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />

    <title>Welcome to DamianFlix</title>
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <img src="assets/images/logo.png" title="logo" alt="Site logo">
            <h1>Sign In</h1>
            <span class="mediumText">to continue to Damianflix</span>

            <form method="POST">

                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>

            <a href="register.php" class="mediumText">Need an account? Sign up here!</a>

        </div>
    </div>

</body>

</html>
