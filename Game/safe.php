<?php
include("dbconnect.php");
$sessid = $_SESSION['uid'];


$sql = "SELECT * FROM stats WHERE id = '$sessid'";
$result = mysqli_query($con, $sql);
$stats = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM units WHERE id = '$sessid'";
$unit_get = mysqli_query($con,$sql2);
$unit = mysqli_fetch_assoc($unit_get);

$sql = "SELECT * FROM user WHERE id = '$sessid'";
$user_get = mysqli_query($con,$sql);
$user = mysqli_fetch_assoc($user_get);

$sql = "SELECT * FROM weapons WHERE id = '$sessid'";
$weapons_get = mysqli_query($con,$sql);
$weapons = mysqli_fetch_assoc($weapons_get);




?>