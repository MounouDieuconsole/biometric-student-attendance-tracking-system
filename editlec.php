<?php
include "dbconn.php";

$id = $_GET['id'];

if(isset($_POST['submit'])){
    $lecturer_name = $_POST['lecturername'];
    $lecturer_id = $_POST['lecturerid'];

   // Validate lecturer name
if (preg_match('/^[a-zA-Z\s]+$/', $lecturer_name) && !empty($lecturer_name)) {
    // Validate lecturer ID
    if (preg_match('/^\d{7}$/', $lecturer_id)) {
        // Check if the lecturer ID already exists in the database excluding the current record
        $check_sql = "SELECT * FROM `lecturer` WHERE `lecturer_id`='$lecturer_id' AND `id` != $id";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Lecturer ID already exists for another record, display an error message
            echo "Lecturer with the same ID already exists.";
        } else {
            // Proceed with updating the lecturer
            $sql = "UPDATE `lecturer` SET 
                    `lecturer_name`='$lecturer_name',
                    `lecturer_id`='$lecturer_id' 
                    WHERE id=$id";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: lecturers.php?msg=Lecturer updated successfully");
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Invalid lecturer ID. It must be exactly 7 digits.";
    }
} else {
    echo "Invalid lecturer name. It must not be empty and must contain only letters and spaces.";
}}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Edit existing Lecturer</title>
</head>
<body>
<div class="addstudent">
<h2 >Edit Lecturer</h2>
<?php

$sql = "SELECT * FROM `lecturer` WHERE `id` =$id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<form action="" method="post">
   
    <label for="studentName">Lecturer Name:</label>
    <input type="text" id="lecturername" name="lecturername" value="<?php echo $row['lecturer_name'] ?>">
    <label for="regNo">Lecturer Id:</label>
    <input type="text" id="lecturerid" name="lecturerid" value="<?php echo $row['lecturer_id'] ?>">
    <input type="submit" name="submit" value="Update">
   <a href="lecturers.php"> Cancel</a>
</form>
</div>
</body>
</html>
