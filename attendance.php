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
<div>Reports</div>
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

  <a href="logout.php"><button id="logoutButton" class="logout-button">Logout</button></a>
      </div>
      </div>
      <form action="search.php" method="get">
    <div class="search-container">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
    </div>
</form>
<div class="table-container">
        <table id="studentListTable">
            <thead>
            <tr>
    <th>Student Name</th>
    <th>Reg. No.</th>
    <th>Course Code</th>
    <th>Semester</th>
    <th>Date In</th>
    <th>Time In</th>
    <th>Status</th>
  </tr>
            </thead>
            <tbody>
            <?php
            include "dbconn.php";  
   $sql = "SELECT * FROM attendance ";
   $result=mysqli_query($conn,$sql);
   while ($row= mysqli_fetch_assoc($result)){
       ?>
        <tr>
                 
                  <td><?php echo $row['fname'] ?></td>
                   <td><?php echo $row['reg_no'] ?></td>
                   <td><?php echo $row['course_code'] ?></td>
                   <td><?php echo $row['semester'] ?></td>
                   <td><?php echo $row['date']?></td>
                   <td><?php echo $row['time_in']?></td>
                   <td>Present</td>
                   
               </tr>
       <?php
   }
               ?>
            </tbody>
        </table>
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
