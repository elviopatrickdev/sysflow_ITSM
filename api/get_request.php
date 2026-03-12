<?php

include("../config/database.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM requests WHERE id=$id");

$request = mysqli_fetch_assoc($query);

echo json_encode($request);

?>