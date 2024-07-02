<?php
include "dbconn.php";
$id = $_GET['id'];
$sql = "DELETE FROM course  WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
header("Location: courses.php?msg= Course deleted successfully");
}
else {
echo "Failed: " .mysqli_error($conn);
}
?>