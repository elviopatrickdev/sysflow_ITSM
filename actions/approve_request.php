<?php
include("../config/database.php");

$id = $_GET['id'];

mysqli_query($conn,"UPDATE requests SET status='Aprovado' WHERE id=$id");
?>