<?php
session_start();
require_once __DIR__ . "/util.php";
require_once __DIR__ . "/app.php";

$dbConn = mysqli_connect("127.0.0.1", "root","","php_blog_2021")
or die("DB CONNECTION ERROR");