<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css2.css">
    <title> Biometric Attendance System </title>
</head>
<body>

  <?php
  include "dbconn.php";
    // Fetch student count
    $sql = "SELECT COUNT(*) as count FROM student";
    $result = $conn->query($sql);
    $registeredStudents = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registeredStudents = $row["count"];
    }
    //Fetch course count
    $sql = "SELECT COUNT(*) as count FROM course";
    $result = $conn->query($sql);
    $savedcource = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $savedcource = $row["count"];
    }
    //Fecth lecturer count
    $sql = "SELECT COUNT(*) as count FROM lecturer";
    $result = $conn->query($sql);
    $registeredlecturer = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registeredlecturer = $row["count"];
    }
    //Fecth enrolled count
    $sql = "SELECT COUNT(*) as count FROM enrolled";
    $result = $conn->query($sql);
    $registeredstudent = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $enrolledstudent = $row["count"];
    }
    ?>
   
<!-------navigation------->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="">
                <span class="icon"> <ion-icon name="finger-print-outline"></ion-icon></span>
              <span class="title">CUEA BSATS </span>
            </a>
            </li>
             
            <li>
                <a href="index.php">
                <span class="icon"> <ion-icon name="home-outline"></ion-icon></span>
              <span class="title">Dashboard</span>
            </a>
            </li>
<div>Manage</div>
            <li>
                <a href="student.php">
                <span class="icon"> <ion-icon name="school-outline"></ion-icon></span>
              <span class="title"> Students</span>
            </a>
            </li>

            <li>
                <a href="courses.php">
                <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
              <span class="title">Courses</span>
            </a>
            </li>

            <li>
                <a href="lecturers.php">
                <span class="icon"> <ion-icon name="person-outline"></ion-icon></span>
              <span class="title">Lecturers</span>
            </a>
            </li>
<div>Report</div>
            <li>
                <a href="attendance.php">
                <span class="icon"><ion-icon name="list-outline"></ion-icon></span>
              <span class="title">Attendance List</span>
            </a>
            </li>
           
     
        </ul>
    </div>
    <!--the main-->
    <div class="main">
      <div class="topbar">
        <div class="toggle" >
          <ion-icon name="menu-outline"></ion-icon>
        </div>
        <?php
include "dbconn.php";
session_start();
?>
        <div class="user">
        <span class="user-name"></span>
  <a href="logout.php"><button id="logoutButton" class="logout-button">Logout</button></a>
      </div>
    </div>
    <!--cards-->
    <div class="cardBox">
      <div class="card">
         <div>
       <div class="numbers"><?php echo $registeredStudents; ?></div>
          <a href="student.php"><div class="cardName">Registered Students</div></a>
         </div>

         <div class="iconBx">
          <ion-icon name="school-outline"></ion-icon>
         </div>
      </div>
    
      <div class="card">
         <div>
         <div class="numbers"><?php echo $enrolledstudent; ?></div>
          <a href="enrolled.php"><div class="cardName">Enrolled Students</div></a>
         </div>

         <div class="iconBx">
          <ion-icon name="finger-print-outline"></ion-icon>
         </div>
      </div>
   
      <div class="card">
         <div>
         <div class="numbers"><?php echo $savedcource; ?></div>
         <a href="courses.php"> <div class="cardName">Courses</div></a>
         </div>

         <div class="iconBx">
          <ion-icon name="book-outline"></ion-icon>
         </div>
      </div>

      <div class="card">
        <div>
        <div class="numbers"><?php echo $registeredlecturer; ?></div>
        <a href="lecturers.php"> <div class="cardName">Lecturers</div></a>
        </div>

        <div class="iconBx">
          <ion-icon name="person-outline"></ion-icon>
        </div>
     </div>
      </div>
    </div>
</div>

<script src="java.js"></script>
      <!---Icon link-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
