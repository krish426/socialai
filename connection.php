<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "social_share";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

define('HOST', 'http://localhost/SocialPoster/');
define('BASE_TITLE', 'Social POSTER');
define('BASE_SERVER', 'http://localhost:3000/');