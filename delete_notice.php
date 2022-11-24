<?php
require 'db_connect.php';
$id = $_GET['id'];
$query = "DELETE FROM notice WHERE id = '$id';";
$result = mysqli_query($conn, $query);
if ($result) {
    mysqli_close($conn);
    header("location: index.php?page=notice_admin");
    exit();
} else {
    echo "<script type='text/javascript'>alert('Error in declining data please try again!')</script>";
}
?>