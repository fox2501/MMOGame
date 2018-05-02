<?php
include_once("header.php");
include_once("functions.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to see this page";
}else{
    $sessid = $_SESSION['uid'];
    if(isset($_POST['gold'])){
        $turns = $_POST['turns'];
        $id = $_POST['id'];
        $user_check = mysqli_query($con, "SELECT * FROM stats WHERE id = '$id'");
        if(mysqli_num_rows($user_check) == 0){
            output("There is no user with that ID");
        }elseif($turns > $stats['turns']){
            output("You do not have enough turns");
        }elseif($id == $sessid){
            output("You can't attack yourself!!!");
        }
        else{
            $enemy_stats = mysqli_fetch_assoc($user_check);
            $attack_effect = $turns * 0.1 * $stats['attack'];
            $defense_effect = $enemy_stats['defense'];

            echo "You send your warriors into battle against the enemy</br></br>";
            echo "Your warriors dealt " . number_format($attack_effect) . " damage!</br>";
            echo "The enemy's defenders dealt " . number_format($defense_effect) . " damage!</br></br>";

            if($attack_effect > $defense_effect){
                $ratio = ($attack_effect - $defense_effect)/$attack_effect * $turns;
                $ratio = min($ratio,1);
                $gold_stolen = floor(($ratio/10) * $enemy_stats['gold']);
                $newturns = $stats['turns'] - $turns;
                $newgold = $enemy_stats['gold'] - $gold_stolen;
                $newgold2 = $stats['gold'] + $gold_stolen;
                $time = time();
                $logQuery = "INSERT INTO logs (attacker,defender,attacker_damage,defender_damage, gold,food,time)
                VALUES ('$sessid','$id','$attack_effect','$defense_effect',$gold_stolen,0,'$time')";
                echo "You won the battle! You stole " . $gold_stolen . " gold!";
                $battle1 = mysqli_query($con,"UPDATE stats SET gold = '$newgold' WHERE id = '$id'");
                $battle2 = mysqli_query($con,"UPDATE stats SET gold = '$newgold2', turns = '$newturns' WHERE id = '$sessid'");
                $battle3 = mysqli_query($con,$logQuery);
                $stats['gold'] += $gold_stolen;
                $stats['turns'] -= $turns;
            }else{
                $warriors_lost = floor(($unit['warrior']) /2);
                $new_warriors = ($unit['warrior'] - $warriors_lost);

                echo "You lost the battle. You have lost ".$warriors_lost." Warriors !";
                $battle1 = mysqli_query($con, "UPDATE units SET warrior = '$new_warriors' WHERE id ='$sessid'");

            }
        }
    }elseif(isset($_POST['food'])){
        $turns = $_POST['turns'];
        $id = $_POST['id'];
        $user_check = mysqli_query($con, "SELECT * FROM stats WHERE id = '$id'");
        if(mysqli_num_rows($user_check) == 0){
            output("There is no user with that ID");
        }elseif($turns > $stats['turns']){
            output("You do not have enough turns");
        }elseif($id == $sessid){
            output("You can't attack yourself!!!");
        }
        else{
            $enemy_stats = mysqli_fetch_assoc($user_check);
            $attack_effect = $turns * 0.1 * $stats['attack'];
            $defense_effect = $enemy_stats['defense'];

            echo "You send your warriors into battle against the enemy</br></br>";
            echo "Your warriors dealt " . number_format($attack_effect) . " damage!</br>";
            echo "The enemy's defenders dealth " . number_format($defense_effect) . " damage!</br></br>";

            if($attack_effect > $defense_effect){
                $ratio = ($attack_effect - $defense_effect)/$attack_effect * $turns;
                $ratio = min($ratio,1);
                $food_stolen = floor(($ratio/10) * $enemy_stats['food']);
                $newturns = $stats['turns'] - $turns;
                $newfood = $enemy_stats['food'] - $food_stolen;
                $newfood2 = $stats['food'] + $food_stolen;

                $time = time();
                $logQuery = "INSERT INTO logs (attacker,defender,attacker_damage,defender_damage, gold,food,time)
                VALUES ('$sessid','$id','$attack_effect','$defense_effect','0','$food_stolen','$time')";
                echo "You won the battle! You stole " . $food_stolen . " food!";
                $battle1 = mysqli_query($con,"UPDATE stats SET food = '$newfood' WHERE id = '$id'");
                $battle2 = mysqli_query($con,"UPDATE stats SET food = '$newfood2', turns = '$newturns' WHERE id = '$sessid'");
                $battle3 = mysqli_query($con,$logQuery);
                $stats['food'] += $food_stolen;
                $stats['turns'] -= $turns;
            }else{
                $warriors_lost = floor(($unit['warrior']) /2);
                $new_warriors = ($unit['warrior'] - $warriors_lost);

                echo "You lost the battle. You have lost ".$warriors_lost." Warriors !";
                $battle1 = mysqli_query($con, "UPDATE units SET warrior = '$new_warriors' WHERE id = '$sessid'");

            }
        }
    }else{
        output("You have visisted this page in error");
    }
}
include("footer.php");
?>