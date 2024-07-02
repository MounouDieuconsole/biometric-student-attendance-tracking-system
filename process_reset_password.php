<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/dbconn.php";
$stmt= mysqli_prepare($conn,"SELECT * FROM `signup` WHERE `reset_token_hash` = ?");
mysqli_stmt_bind_param($stmt, "s", $token_hash);
    mysqli_stmt_execute($stmt);
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user === null) {
    die("token not found");
}
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "UPDATE `signup` SET `password` = ?, `reset_token_hash` = NULL,
            `reset_token_expires_at` = NULL
        WHERE 1");
mysqli_stmt_bind_param($stmt,"s", $password_hash);
mysqli_stmt_execute($stmt);

echo "Password updated. You can now login.";