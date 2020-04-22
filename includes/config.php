<?php

ob_start(); //turns on output buffering

session_start(); //starts a session(saving variable and value in browsers).

date_default_timezone_set("America/New_York"); //set timezone

try {
    $con = new PDO("mysql:host=localhost;dbname=damianflix", "root", ""); //connect database (connection string; hostname, username, password)

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //set error reporting mode
} catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
