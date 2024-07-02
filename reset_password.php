<?php
$token = $_GET["token"];
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <h2>Reset Password</h2>
<div class="pass">
    <form method="post" action="process_reset_password.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label for="password">New password</label>
        <input type="password" id="password" name="password">
        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>
</div>
</body>
</html>