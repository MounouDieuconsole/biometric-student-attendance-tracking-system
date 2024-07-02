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
    $lecturer_id = $_POST['lecturer_id'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM `lecturer` WHERE `lecturer_name` = ? AND `lecturer_id` = ? ";
    $stmt = mysqli_prepare($conn, $sql);

     // Check if the statement was prepared successfully
     if ($stmt === false) {
        die("Error: Unable to prepare statement. " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "ss", $admin_id, $lecturer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // If the result is not empty, start a new session
        if ($row) {
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row['lecturer_id'];
            $_SESSION["username"] = $row['lecturer_name'];                            
            // Redirect user to welcome page
            header("location: index2.php");
        } else {
            // Display an error message if the lecturer name or ID is not valid
            die("The lecturer name or ID you entered was not valid.");
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
</div>
      <div class="log">
        <h2>Login</h2>
        <form action="" method="post">
          <label for="AdminId">Name</label>
          <input type="text" id="AdminId" name="AdminId" placeholder="Enter your Name">
          <label for="password">Lecturer ID</label>
          <input type="text" id="lecturer_id" name="lecturer_id" placeholder="Enter your ID">
          <input type="submit" name="login" value="Login">
        </form>
        <div class="signup">
          <p>Don't have an account? <a class="a" href="Signin.php">Sign up</a></p>
      </div>
      <div class="signup">
           <a class="a" href="login.php">Log in as Admin</a>
      </div>
      <div style="text-align: center;">
          <a href ="forgotpass.php">Forgot password?</a></p>
      </div>
       </div>
    </body>
</html>