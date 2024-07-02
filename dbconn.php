<?php
$servername="localhost";
$username="root";
$password="";
$dbname="bsats";

$conn =mysqli_connect($servername, $username, $password, $dbname);
// Attempt to create a PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If connection fails, output an error message
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit(); // Terminate further execution
}


if(!$conn){
    die("Connection failed" . mysqli_connect_errot());
}

