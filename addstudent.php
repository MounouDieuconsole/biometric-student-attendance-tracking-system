<?php
include "dbconn.php";

if(isset($_POST['submit'])){
    $student_name = $_POST['studentName'];
    $reg_no = $_POST['regNo'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    // Validate registration number
    if(preg_match('/^\d{7}$/', $reg_no)) {
        // Validate student name
        if(preg_match('/^[A-Za-z\s]+$/', $student_name) && !empty($student_name)) {
            // Validate course
            if(!empty($course)) {
                // Validate semester
                if(!empty($semester)) {
                    // Check if student already exists
                    $check_sql = "SELECT * FROM `student` WHERE `reg_no` = '$reg_no'";
                    $check_result = mysqli_query($conn, $check_sql);

                    if(mysqli_num_rows($check_result) > 0) {
                        // Student already exists, compare the details
                        $existing_student = mysqli_fetch_assoc($check_result);

                        if($existing_student['student_name'] == $student_name && $existing_student['course'] == $course && $existing_student['semester'] == $semester) {
                            echo "Student is already registered with the same details.";
                        } else {
                            // At least one field is different, proceed with registration
                            $sql = "INSERT INTO `student` (`student_name`, `reg_no`, `course`, `semester`) 
                                    VALUES ('$student_name', '$reg_no', '$course', '$semester')";

                            $result = mysqli_query($conn, $sql);

                            if($result){
                                header("Location: student.php?msg=New Student Created successfully");
                            } else {
                                echo "Failed: " . mysqli_error($conn);
                            }
                        }
                    } else {
                        // No existing student, proceed with registration
                        $sql = "INSERT INTO `student` (`student_name`, `reg_no`, `course`, `semester`) 
                                VALUES ('$student_name', '$reg_no', '$course', '$semester')";

                        $result = mysqli_query($conn, $sql);

                        if($result){
                            header("Location: student.php?msg=New Student Created successfully");
                        } else {
                            echo "Failed: " . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "Semester cannot be empty.";
                }
            } else {
                echo "Course cannot be empty.";
            }
        } else {
            echo "Invalid student name. Only letters and spaces are allowed.";
        }
    } else {
        echo "Invalid registration number. It must be exactly 7 digits.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>New Student Registration</title>
</head>
<body>
<div class="addstudent">
<h2 >New Student</h2>

<form action="" method="post">
   
    <label for="studentName">Student Name:</label>
    <input type="text" id="studentName" name="studentName" placeholder="Enter student's name">
    <label for="regNo">Reg. No:</label>
    <input type="text" id="regNo" name="regNo" placeholder="Enter student's registration number">
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
    <input type="submit" name="submit" value="Submit">
   <a href="student.php"> Cancel</a>
</form>
</div>
</body>
</html>
