<?php
include_once("header.php");
include_once("functions.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to see this page";
}
else{
    if(isset($_POST['buy'])){
        $sessid = $_SESSION['uid'];
        $sword = $_POST['sword'];
        $shield = $_POST['shield'];
        $gold_needed = ((10 * $sword) + (10 * $shield));

        if($stats['gold'] < $gold_needed){
            output("You do not have enough gold");
        }else{
            $weapons['sword'] += $sword;
            $weapons['shield'] += $shield;

            $swords = $weapons['sword'];
            $shields = $weapons['shield'];

            $sql = "UPDATE weapons SET sword = '$swords',
                                       shield = '$shields'
                                       WHERE id = '$sessid'";

            $result = mysqli_query($con,$sql);

            $stats['gold'] -= $gold_needed;
            $gold = $stats['gold'];

            $sql = "UPDATE stats SET gold = '$gold' 
                                 WHERE id = '$sessid'";
            $result = mysqli_query($con,$sql);
            include('update_stats.php');
            output("You have bought your weapons");
        }


    }elseif(isset($_POST['sell'])){
        $sessid = $_SESSION['uid'];
        $sword = $_POST['sword'];
        $shield = $_POST['shield'];
        $gold_refund = ((5 * $sword) + (5 * $shield));

        if($sword > $weapons['sword'] || $shield >$weapons['shield']){
            output("You do not have that many weapons to sell");
        }else{
            $weapons['sword'] -= $sword;
            $weapons['shield'] -= $shield;

            $swords = $weapons['sword'];
            $shields = $weapons['shield'];

            $sql = "UPDATE weapons SET sword = '$swords',
                                       shield = '$shields'
                                       WHERE id = '$sessid'";

            $result = mysqli_query($con,$sql);

            $stats['gold'] += $gold_refund;
            $gold = $stats['gold'];

            $sql = "UPDATE stats SET gold = '$gold' 
                                 WHERE id = '$sessid'";
            $result = mysqli_query($con,$sql);
            include('update_stats.php');
            output("You have sold your weapons");
        
        }
    }
    
    
    ?>
    <center><h2>Your Units</h2></center>
    
</br>
You can buy and sell Weapons here.
</br>

<form action="weapons.php" method="POST">
<table cellpadding="5" cellspacing="5">
    <tr>
        <td><b>Weapon Type</b></td>
        <td><b>Number of Weapons</b></td>
        <td><b>Gold Cost</b></td>
        <td><b>Buy</b></td>
    </tr>
    <tr>
        <td>Sword</td>
        <td><?php echo number_format($weapons['sword']) ?></td>
        <td>10 Gold</td>
        <td><input type="number" value=0 name="sword" min=0 /></td>
    </tr>
    <tr>
        <td>Shield</td>
        <td><?php echo number_format($weapons['shield']) ?></td>
        <td>10 Gold</td>
        <td><input type="number"value =0 name="shield" min=0/></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="buy" value="Buy"/></td>
    </tr>
</table>
</form>
</hr>
<form action="weapons.php" method="POST">
<table cellpadding="5" cellspacing="5">
    <tr>
        <td><b>Weapon Type</b></td>
        <td><b>Number of Weapons</b></td>
        <td><b>Gold Gain</b></td>
        <td><b>Sell</b></td>
    </tr>
    <tr>
        <td>Sword</td>
        <td><?php echo number_format($weapons['sword']) ?></td>
        <td>5 Gold</td>
        <td><input type="number" value=0 name="sword" min=0 /></td>
    </tr>
    <tr>
        <td>Shield</td>
        <td><?php echo number_format($weapons['shield']) ?></td>
        <td>5 Gold</td>
        <td><input type="number" value=0 name="shield" min=0 /></td>
    </tr>   
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="sell" value="Sell"/></td>
    </tr>
</table>
</form>

    <?php
}



include_once("footer.php");
?>