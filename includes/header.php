<?php
require_once "includes/config.php";
require_once "includes/classes/Entity.php";
require_once "includes/classes/Season.php";
require_once "includes/classes/Video.php";
require_once "includes/classes/CategoryContainer.php";
require_once "includes/classes/PreviewProvider.php";
require_once "includes/classes/EntityProvider.php";
require_once "includes/classes/SeasonProvider.php";
require_once "includes/classes/VideoProvider.php";
require_once "includes/classes/ErrorMessage.php";
require_once "includes/classes/User.php";

if (!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link defer rel="stylesheet" type="text/css" href="assets/style/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <script src="assets/js/script.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Welcome to Damianflix</title>
</head>
<body>
    <div class="wrapper">

<?php
if (!isset($hideNav)) {
    include_once "includes/navBar.php";
}
?>