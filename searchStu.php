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
        
        <div><a href="student.php"><button id="logoutButton" class="logout-button">Cancel</button></a></div>
        <form action="searchStu.php" method="get" style="position=center">
    <div class="search2">
        <input type="text" placeholder="Search.." name="searchStu">
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
                    <th>Tools</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include "dbconn.php";  
                $search = $_GET['searchStu'];
                $sql = "SELECT * FROM student WHERE student_name LIKE '%$search%' OR reg_no LIKE '%$search%'";
                $result=mysqli_query($conn,$sql);
                while ($row= mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo $row['student_name'] ?></td>
                        <td><?php echo $row['reg_no'] ?></td>
                        <td><?php echo $row['course'] ?></td>
                        <td><?php echo $row['semester'] ?></td>
                       
                        <td>
                  <a href="edit.php?id=<?php echo $row['id']?>" class="icon2"><ion-icon name="create-outline"> </ion-icon></a>
                
                   <a href="delete.php?id=<?php echo $row['id']?>" class="icon2"><ion-icon name="trash-outline"></ion-icon></a>
                   </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <script src="java.js"></script>
        <!---Icon link-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>