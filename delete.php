<?php
include "dbconn.php";
$id = $_GET['id'];
$sql = "DELETE FROM student  WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
header("Location: student.php?msg= Student deleted successfully");
}
else {
echo "Failed: " .mysqli_error($conn);
}
?>