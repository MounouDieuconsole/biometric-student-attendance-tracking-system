<?php
include "dbconn.php";
$id = $_GET['id'];
if(isset($_POST['submit'])){
    $student_name = $_POST['studentName'];
    $reg_no = $_POST['regNo'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    // Retrieve existing student data
    $existing_student_query = "SELECT * FROM `student` WHERE id=$id";
    $existing_student_result = mysqli_query($conn, $existing_student_query);

    if(mysqli_num_rows($existing_student_result) > 0) {
        $existing_student_data = mysqli_fetch_assoc($existing_student_result);

        // Compare existing data with new data
        if ($existing_student_data['student_name'] != $student_name ||
            $existing_student_data['reg_no'] != $reg_no ||
            $existing_student_data['course'] != $course ||
            $existing_student_data['semester'] != $semester) {
            
            // Check if there exists a student with exactly the same data
            $check_duplicate_query = "SELECT * FROM `student` WHERE 
                `student_name`='$student_name' AND 
                `reg_no`='$reg_no' AND 
                `course`='$course' AND 
                `semester`='$semester' AND 
                id != $id";
            $check_duplicate_result = mysqli_query($conn, $check_duplicate_query);

            if(mysqli_num_rows($check_duplicate_result) == 0) {
                // No student with exactly the same data found, proceed with the update
                $sql = "UPDATE `student` SET 
                        `student_name`='$student_name',
                        `reg_no`='$reg_no',
                        `course`='$course',
                        `semester`='$semester' 
                        WHERE id=$id";

                $result = mysqli_query($conn, $sql);

                if($result){
                    header("Location: student.php?msg=Student updated successfully");
                    exit(); // Terminate script execution after redirection
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            } else {
                // A student with exactly the same data already exists, do not proceed with the update
                header("Location: student.php?msg=Student with same data already exists.");
                exit(); // Terminate script execution after redirection
            }
        } else {
            // No changes detected, redirect with a message
            header("Location: student.php?msg=No changes made.");
            exit(); // Terminate script execution after redirection
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Edit existing student</title>
</head>
<body>
<div class="addstudent">
<h2 >Edit Student</h2>
<?php

$sql = "SELECT * FROM student WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<form action="" method="post">
   
    <label for="studentName">Student Name:</label>
    <input type="text" id="studentName" name="studentName" value="<?php echo $row['student_name'] ?>">
    <label for="regNo">Reg. No:</label>
    <input type="text" id="regNo" name="regNo" value="<?php echo $row['reg_no'] ?>">
    <label for="course">Course:</label>
    <select id="course" name="course" required>
        <?php
        // Database connection
        include "dbconn.php";
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // SQL query
        $sql = "SELECT course_title FROM course";
        $result = $conn->query($sql);
        // Fetch results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["course_title"] . "'>" . $row["course_title"] . "</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </select>
    <label for="semester">Semester:</label>
    <select id="semester" name="semester" required>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    <input type="submit" name="submit" value="update">
   <a href="student.php"> Cancel</a>
</form>
</div>
</body>
</html>
