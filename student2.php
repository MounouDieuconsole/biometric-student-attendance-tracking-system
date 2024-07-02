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
                <a href="index2.php">
                <span class="icon"> <ion-icon name="home-outline"></ion-icon></span>
              <span class="title">Dashboard</span>
            </a>
            </li>
<div>Manage</div>
            <li>
                <a href="student2.php">
                <span class="icon"> <ion-icon name="school-outline"></ion-icon></span>
              <span class="title"> Students</span>
            </a>
            </li>
<div>Report</div>
            <li>
                <a href="attendance2.php">
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
    <form action="searchStu2.php" method="get">
    <div class="search-container">
        <input type="text" placeholder="Search.." name="searchStu">
        <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
    </div>
</form>
        <div class="topTable"> 
        </div>
        <div class="table-container">
    <?php
if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="custom-alert">
            <span class="alert-message">' . $msg . '</span>
            <button type="button" class="alert-close" id="closeAlert">&times;</button>
          </div>';
}
?>
        <table id="studentListTable">
            <thead>
                <tr>
                   <!-- <th>No.</th>-->
                    <th>Student Name</th>
                    <th>Reg. No.</th>
                    <th>Course</th>
                    <th>Semester</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Students will be added here dynamically -->
                <?php
            include "dbconn.php";  
   $sql = "SELECT * FROM student ";
   $result=mysqli_query($conn,$sql);
   while ($row= mysqli_fetch_assoc($result)){
       ?>
        <tr>
                  <!--<td><?php echo $row['id'] ?></td>-->
                  <td><?php echo $row['student_name'] ?></td>
                   <td><?php echo $row['reg_no'] ?></td>
                   <td><?php echo $row['course'] ?></td>
                   <td><?php echo $row['semester'] ?></td>                     
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
