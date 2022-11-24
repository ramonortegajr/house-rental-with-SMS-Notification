<?php
require 'db_connect.php';
$id = $_GET['id'];
$query = "DELETE FROM gcash";
$result = mysqli_query($conn, $query);
if ($result) {
    mysqli_close($conn);
    header("location: index.php?page=paymentsetup");
    exit();
} else {
    echo "<script type='text/javascript'>alert('Error in declining data please try again!')</script>";
}
?>