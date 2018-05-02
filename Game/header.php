<?php
session_start();
include_once('dbconnect.php');
?>
<html>
<head>
<title>BasicCraft</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="header">BasicCraft</div>
<div id="container">
<div id="navigation"><div id="nav_div">
<?php
if(isset($_SESSION['uid'])){
    include("safe.php");
    ?>
    &raquo; <a href="main.php">Your Stats</a></br></br>
    &raquo; <a href="rankings.php">Battle Player</a></br></br>
    &raquo; <a href="units.php">Your Units</a></br></br>
    &raquo; <a href="weapons.php">Your Weapons</a></br></br>
    &raquo; <a href="logout.php">Logout</a>
    <?php  
}
else{
    ?>
    <form action="login.php" method="POST">
        Username: <input type="text" name="username"/></br>
        Password: <input type="password" name="password"/></br>
        <input type="submit" name="login" value="Login"/>

    </form>
    <?php
}
?>
</div></div>
<div id="content"><div id="con_div">