<?php
include_once("dbconnect.php");
//turns every 5 minutes 

$get_users = mysqli_query($con,"SELECT * FROM stats");
while($user = mysqli_fetch_assoc($get_users)){
    $update = mysqli_query($con,"UPDATE stats SET gold = gold + $user[income], food = food + $user[farming], turns = turns+5 WHERE id=$user[id] ");
}

?>