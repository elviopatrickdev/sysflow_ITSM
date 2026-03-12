<?php

include("../config/database.php");

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE tickets 
SET status='$status'
WHERE id=$id";

mysqli_query($conn,$sql);

header("Location: ../helpdesk/index.php");

?>