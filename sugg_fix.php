<?php
require 'db_connect.php';
$id = $_GET['id'];
$query = "UPDATE suggestion SET status = 'Complete' WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if ($result) {
    mysqli_close($conn);
    header("location: index.php?page=suggestions");
    exit();
} else {
    echo "<script type='text/javascript'>alert('Error please try again!')</script>";
}
?>