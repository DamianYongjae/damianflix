<?php
require_once "includes/config.php";
require_once "includes/classes/FormSanitizer.php"; //include class
require_once "includes/classes/Constants.php";
require_once "includes/classes/Account.php";

$account = new Account($con);

if (isset($_POST["submitButton"])) {

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]); //invoke class static member method
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if ($success) {
        //store session

        $_SESSION["userLoggedIn"] = $username; //storing session variable(userLoggedIn) as $username

        header("Location: index.php"); //redirect page
    }
}

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
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
            <h1>Sign Up</h1>
            <span class="mediumText">to continue to Damianflix</span>

            <form method="POST">
                <input type="text" name="firstName" placeholder="First name" value="<?php getInputValue("firstName");?>" required>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>

                <input type="text" name="lastName" placeholder="Last name" value="<?php getInputValue("lastName");?>" required>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>

                <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username");?>" required>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>

                <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email");?>" required>
                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>

                <input type="email" name="email2" placeholder="Confirm email" value="<?php getInputValue("email2");?>" required>

                <input type="password" name="password" placeholder="Password" required>
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>

                <input type="password" name="password2" placeholder="Confirm Password" required>

                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="login.php" class="mediumText">Already have an account? Sign in here!</a>

        </div>
    </div>

</body>

</html>
