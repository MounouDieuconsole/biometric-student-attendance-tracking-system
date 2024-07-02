<?php
include "dbconn.php";
$id = $_GET['id'];
$sql = "DELETE FROM lecturer  WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
header("Location: lecturers.php?msg= Lecturer deleted successfully");
}
else {
echo "Failed: " .mysqli_error($conn);
}
?>