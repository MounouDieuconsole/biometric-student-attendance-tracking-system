<!DOCTYPE html>
<?php
// Include the database connection file (dbconn.php)
include "dbconn.php";

// Start the session
session_start();
// Check if message exists in session
if (isset($_SESSION['success_message'])) {
    // Display the message
    echo $_SESSION['success_message'];
    // Clear the message from the session
    unset($_SESSION['success_message']);
}
if (isset($_POST['login'])) {
    $admin_id = $_POST['AdminId'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM `signup` WHERE `admin_id` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $admin_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Valid login, store user information in the session
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['name'] = $row['name'];

                // Redirect to the dashboard or perform other actions
                header("Location: index.php");
                exit();
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "Invalid admin ID. Please try again.";
        }
    } else {
        // Handle database query error gracefully
        die("Error: " . mysqli_error($conn));
    }
}
?>
<html>
    <head>
        <title>Student Attendance</title>
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      </head>
    <body>
      <div>
    <?php
if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="custom-alert">
            <span class="alert-message">' . $msg . '</span>
            <button type="button" class="alert-close" id="closeAlert">&times;</button>
          </div>';
}
?> 
</div>
      <div class="log">
        <h2>Login</h2>
        <form action="" method="post">
          <label for="AdminId">Admin Id</label>
          <input type="text" id="AdminId" name="AdminId" placeholder="Enter your ID">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password">
          <input type="submit" name="login" value="Login">
        </form>
        <div class="signup">
          <p>Don't have an account? <a class="a" href="Signin.php">Sign up</a></p>
      </div>
      <div class="signup">
           <a class="a" href="loginLec.php">Log in as Lecturer</a>
      </div>
      <div style="text-align: center;">
          <a href ="forgotpass.php">Forgot password?</a></p>
      </div>
       </div>
    </body>
</html>