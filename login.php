<?php
require_once "includes/config.php";
require_once "includes/classes/FormSanitizer.php"; //include class
require_once "includes/classes/Constants.php";
require_once "includes/classes/Account.php";

$account = new Account($con);

if (isset($_POST["submitButton"])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->logIn($username, $password);

    if ($success) {
        //store session
        //code here

        header("Location: index.php"); //redirect page
    }
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
                <?php echo $account->getError(Constants::$loginFailed); ?>


                <input type="submit" name="submitButton" value="SUBMIT">
            </form>

            <a href="register.php" class="mediumText">Need an account? Sign up here!</a>

        </div>
    </div>

</body>

</html>
