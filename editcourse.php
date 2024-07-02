<?php
include "dbconn.php";
$id = $_GET['id'];
if(isset($_POST['submit'])){
    $course_code = $_POST['course_code'];
    $course_title = $_POST['course_title'];
    $semester = $_POST['semester'];

    // Check if a course with the same course_code and course_title exists
    $check_existing_query = "SELECT * FROM `course` WHERE 
        `course_code`='$course_code' AND `course_title`='$course_title'";
    $check_existing_result = mysqli_query($conn, $check_existing_query);

    if(mysqli_num_rows($check_existing_result) > 0) {
        // Course with the same course_code and course_title found
        // Check if any course with the same course_code, course_title, and different semester exists
        $check_semester_query = "SELECT * FROM `course` WHERE 
            `course_code`='$course_code' AND `course_title`='$course_title' AND `semester`='$semester' AND `id` != $id";
        $check_semester_result = mysqli_query($conn, $check_semester_query);

        if(mysqli_num_rows($check_semester_result) == 0) {
            // No course with the same course_code, course_title, and semester found
            // Proceed with update
            $sql = "UPDATE `course` SET 
                    `course_code`='$course_code',
                    `course_title`='$course_title',
                    `semester`='$semester' 
                    WHERE id=$id";

            $result = mysqli_query($conn, $sql);

            if($result){
                header("Location: courses.php?msg=Course updated successfully");
                exit(); // Terminate script execution after redirection
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        } else {
            // Course with the same course_code, course_title, and semester found
            // Do not proceed with update
            header("Location: courses.php?msg=Course with same code, title, and semester already exists.");
            exit(); // Terminate script execution after redirection
        }
    } else {
        // No course with the same course_code and course_title found
        // Proceed with update
        $sql = "UPDATE `course` SET 
                `course_code`='$course_code',
                `course_title`='$course_title',
                `semester`='$semester' 
                WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: courses.php?msg=Course updated successfully");
            exit(); // Terminate script execution after redirection
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Edit existing Course</title>
</head>
<body>
<div class="addstudent">
<h2 >Edit Course</h2>
<?php

$sql = "SELECT * FROM `course` WHERE `id` =$id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<form action="" method="post">
    <label for="studentName">Course code:</label>
    <select id="course_code" name="course_code" required>
            <option value="DIT001">DITOO1</option>
            <option value="DIT002">DIT002</option>
            <option value="CMT127">CMT127</option>
            <option value="DMAT200">DMAT200</option>
            <option value="GS103">GS103</option>
        </select>
    <label for="regNo">Course Title:</label>
    <select id="course_title" name="course_title" required>
            <option value="ACCOUNTING">DITOO1</option>
            <option value="HARDWARE TECHNOLOGY">DIT002</option>
            <option value="LINUX">CMT127</option>
            <option value="BASIC MATH">DMAT200</option>
            <option value="INTRODUCTION TO BIBLE">GS103</option>
        </select>
    <label for="semester">Semester:</label>
    <select id="semester" name="semester" required>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    <input type="submit" name="submit" value="Submit">
   <a href="courses.php"> Cancel</a>
</form>
</div>
</body>
</html>
