<?php
include_once("header.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to see this page";
}else{
    ?>
    <center><h2>Battle Players</h2></center>
</br>
<table cellpadding="2" cellspacing ="2">
    </tr>
        <td width="50px"><b>Rank</b></td>
        <td width="50px"><b>Username</b></td>
        <td width="50px"><b>Gold</b></td>
    </tr>

    <?php
    $sql = " SELECT id, overall FROM ranking WHERE overall > 0 ORDER BY overall ASC";
    $result = mysqli_query($con,$sql);
    
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $row['overall'] . "</td>";
        $userid = $row['id'];
        $sql = "SELECT username FROM user WHERE id = '$userid'";
        $getUser = mysqli_query($con,$sql);
        $rank_name = mysqli_fetch_assoc($getUser);
        echo "<td><a href=\game\stats.php?id=" . $row['id']. "\">" . $rank_name['username'] . "</a></td>";

        $sql1 = "SELECT gold FROM stats WHERE id = '$userid'";
        $getGold = mysqli_query($con,$sql1);
        $rank_gold = mysqli_fetch_assoc($getGold);
        echo "<td>" . number_format($rank_gold['gold']) . "</td>";
        echo "<tr>";

    }
    ?>
</table>


    <?php

}
include("footer.php");
?>