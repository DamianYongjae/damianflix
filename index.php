<?php
require_once "includes/header.php";

$preview = new PreviewProvider($con, $userLoggedIn);

echo $preview->createPreviewVideo(null);

$category = new CategoryContainer($con, $userLoggedIn);

echo $category->showAllCategories();
