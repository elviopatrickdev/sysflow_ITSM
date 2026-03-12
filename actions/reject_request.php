<?php

include("../config/database.php");

$id = $_GET['id'];

mysqli_query($conn,"UPDATE requests SET status='Rejeitado' WHERE id=$id");
?>