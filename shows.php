<?php
require_once "includes/header.php";

$preview = new PreviewProvider($con, $userLoggedIn);

echo $preview->createTVShowPreviewVideo();

$category = new CategoryContainer($con, $userLoggedIn);

echo $category->showTVShowCategories();
