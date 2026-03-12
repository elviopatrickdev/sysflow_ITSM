<?php

include("../config/database.php");

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM tickets WHERE id=$id");

$ticket = mysqli_fetch_assoc($query);

echo json_encode($ticket);

?>