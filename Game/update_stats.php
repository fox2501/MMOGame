<?php

$sessid = $_SESSION['uid'];
$income =  2 * $unit['worker'];
$farming = 5* pow($unit['farmer'],0.5);

$num1 = min($weapons['sword'],$unit['warrior']);

if($num1 == $weapons['sword'] ){
    $attack = (10 * $weapons['sword']) + ($unit['warrior'] - $weapons['sword']);
}else{
    $attack = (10 * $unit['warrior']);
}


$num2 = min($weapons['shield'],$unit['defender']);

if($num1 == $weapons['shield'] ){
    $defense = (10 * $weapons['shield']) + ($unit['defender'] - $weapons['shield']);
}else{
    $defense = (10 * $unit['defender']);
}


$sql = "UPDATE stats SET income = $income, farming = $farming, attack = $attack, defense = $defense  WHERE id = '$sessid'";
$result = mysqli_query($con,$sql);


?>