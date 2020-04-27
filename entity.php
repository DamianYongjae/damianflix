<?php
require_once "includes/header.php";

if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into page");
}

$entityId = $_GET["id"]; //get string from address bar
$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($con, $userLoggedIn);
echo $seasonProvider->create($entity);

$categoryContainer = new CategoryContainer($con, $userLoggedIn);
echo $categoryContainer->showCategory($entity->getCategoryId(), "You might also like");
