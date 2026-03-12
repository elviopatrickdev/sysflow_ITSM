<?php

include("../config/database.php");

$title = $_POST['title'];
$description = $_POST['description'];
$priority = $_POST['priority'];

$sql = "INSERT INTO tickets (title, description, priority)
VALUES ('$title','$description','$priority')";

mysqli_query($conn,$sql);

header("Location: ../helpdesk/index.php");

?>