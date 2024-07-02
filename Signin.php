<?php
include "dbconn.php";
$name = '';
$admin_id = '';
$email = '';
$phone_number = '';
$password = '';
$password2 = '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validation
    if (empty($name) || empty($admin_id) || empty($email) || empty($phone_number) || empty($password) || empty($password2)) {
        echo "All fields are required. Please fill them.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please enter a valid email address.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone_number)) {
        echo "Invalid phone number format. Please enter a 10-digit number.";
    } 
    elseif(!isset($_POST["password"]) || 
    strlen($_POST["password"]) < 6 || 
    !preg_match("/[a-z]/i", $_POST["password"]) || 
    !preg_match("/\d/", $_POST["password"])) {
        die("Password must not be empty, must contain 6 characters with at least one digit and one letter.");
    }
    elseif ($password != $password2) {
        echo "Passwords do not match. Please try again.";
    } elseif (!preg_match("/^[0-9]{7}$/", $admin_id)) {
        echo "Invalid Admin Id. Please enter a 7-digit number.";
    } else {
        // Hash the password
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statement
        $stmt = mysqli_prepare($conn, "INSERT INTO `signup` (`name`, `admin_id`, `email`, `phone_number`, `password`) 
                                       VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $name, $admin_id, $email, $phone_number, $hashedpassword);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect after successful insertion
           
            
session_start();
// Set the message in the session variable
$_SESSION['success_message'] = "New Admin Created successfully";
// Redirect to login page
header("Location: login.php");
exit;
            exit;
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Student Attendance </title>
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      </head>
    <body>
        <div class="sign">
            <h2>Sign Up</h2>
            <form method="post" action="">
                <input type="text" id="name" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($name); ?>">
                <input type="text" id="admin_id" name="admin_id" placeholder="Admin Id" value="<?php echo htmlspecialchars($admin_id); ?>" >
                <input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($email); ?>">
                <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone_number); ?>">
                <input type="password" id="password" name="password" placeholder="Create Password" value="<?php echo htmlspecialchars($password); ?>">
                <input type="password" id="password2" name="password2" placeholder=" Enter Password Created" value="<?php echo htmlspecialchars($password2); ?>" >
                 <input type="submit" name="submit" value="Submit">
                <a href="login.php">Cancel</a>
            </form>
          </div>
    </body>
</html>