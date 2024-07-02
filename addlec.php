<?php
// PHP code to create a lecturer
include "dbconn.php";
if(isset($_POST['submit'])){
    $lecturer_name = $_POST['lecturername'];
    $lecturer_id = $_POST['lecturerid'];

    // Validate lecturer name
    if(preg_match('/^[a-zA-Z\s]+$/', $lecturer_name) && !empty($lecturer_name)) {
        // Validate lecturer ID
        if(preg_match('/^\d{7}$/', $lecturer_id)) {
            // Check if a lecturer with the same ID already exists
            $check_existing_query = "SELECT * FROM `lecturer` WHERE `lecturer_id` = '$lecturer_id'";
            $check_existing_result = mysqli_query($conn, $check_existing_query);

            if(mysqli_num_rows($check_existing_result) > 0) {
                // Lecturer with the same ID already exists, display an error message
                echo "Lecturer with the same ID already exists.";
            } else {
                // No existing lecturer with the same ID, proceed with insertion
                $sql = "INSERT INTO `lecturer`(`lecturer_name`, `lecturer_id`) 
                        VALUES ('$lecturer_name','$lecturer_id')";
                
                $result = mysqli_query($conn, $sql);

                if($result){
                    header("Location: lecturers.php?msg=New lecturer added successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Invalid lecturer ID. It must be exactly 7 digits.";
        }
    } else {
        echo "Invalid lecturer name. It must not be empty and must contain only letters and spaces.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>New lecturer</title>
</head>
<body>
<div class="addstudent">
<h2 >New Lecturer</h2>

<form action="" method="post">
   
    <label for="studentName">Lecturer Name:</label>
    <input type="text" id="lecturername" name="lecturername" placeholder="Enter lecturer name">
    <label for="regNo">Lecturer Id:</label>
    <input type="text" id="lecturerid" name="lecturerid" placeholder="Enter lecturer id">
    <input type="submit" name="submit" value="Submit">
   <a href="lecturers.php"> Cancel</a>
</form>
</div>
</body>
</html>
