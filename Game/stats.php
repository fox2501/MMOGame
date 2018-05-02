<?php
include_once("header.php");
include_once("functions.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to see this page";
}else{
    if(!isset($_GET['id'])){
        output("You have visited this page incorrectly");
    }else{
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $user_check = mysqli_query($con,$sql);
        if(mysqli_num_rows($user_check)==0){
            output("There is no user with that ID");
        }else{
            $s_user = mysqli_fetch_assoc($user_check);
            $stats_stats = mysqli_query($con,"SELECT * FROM stats WHERE id = '$id'");
            $s_stats = mysqli_fetch_assoc($stats_stats);
            $stats_rank = mysqli_query($con,"SELECT * FROM ranking WHERE id = '$id'");
            $s_rank = mysqli_fetch_assoc($stats_rank);
            ?>
            <center><h2>Player Stats</h2></center>
            </br>
            <?php echo $s_user['username']; ?>
        </br>
            <b>Rank: <?php echo $s_rank['overall'] ; ?></b></br>
            <b>Gold: <?php echo number_format($s_stats['gold']); ?></b></br></br>

            <form action="battle.php" method="POST">
                <?php
                $sessid= $_SESSION['uid'];
                $attack_time = (time() - 86409);
                $attacks_check = mysqli_query($con,"SELECT id FROM logs WHERE attacker = '$sessid' AND defender = '$id' AND 'time' >= '$attack_time' ");
                ?>
                <i>Attacks on <?php echo $s_user['username'] ?> in the last 24 hours: (<?php echo mysqli_num_rows($attacks_check)?> / 5)</i></br>
                <?php
                if(mysqli_num_rows($attacks_check) < 5){
                ?>
                Number of Turns (1-10): <input type="number" name="turns" min="1" max="10"/>
                <input type="submit" name="gold" value="Raid for Gold" />
                <input type="submit" name="food" value="Raid for Food" />
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <?php }?>
            </form>
            <?php

        }
    }

}
include("footer.php");
?>