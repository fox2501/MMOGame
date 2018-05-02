<?php
include_once("header.php");
include_once("functions.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to see this page";
}
else{
    if(isset($_POST['train'])){
        $sessid = $_SESSION['uid'];
        $worker = $_POST['worker'];
        $farmer = $_POST['farmer'];
        $warrior = $_POST['warrior'];
        $defender = $_POST['defender'];
        $food_needed = ((10 * $worker) + (10 * $farmer) + (30 * $warrior) + (30 * $defender));

        if($stats['food'] < $food_needed){
            output("You do not have enough food");
        }else{
            $unit['worker'] += $worker;
            $unit['farmer'] += $farmer;
            $unit['warrior'] += $warrior;
            $unit['defender'] += $defender;

            $workers = $unit['worker'];
            $farmers = $unit['farmer'];
            $warriors = $unit['warrior'];
            $defenders = $unit['defender'];

            $sql = "UPDATE units SET worker = '$workers',
                                     farmer = '$farmers',
                                     warrior = '$warriors', 
                                     defender = '$defenders' 
                                     WHERE id = '$sessid'";

            $result = mysqli_query($con,$sql);

            $stats['food'] -= $food_needed;
            $food = $stats['food'];

            $sql = "UPDATE stats SET food = '$food' 
                                 WHERE id = '$sessid'";
            $result = mysqli_query($con,$sql);
            include('update_stats.php');
            output("You have trained your units");
        }


    }elseif(isset($_POST['destroy'])){
        $sessid = $_SESSION['uid'];
        $worker = $_POST['worker'];
        $farmer = $_POST['farmer'];
        $warrior = $_POST['warrior'];
        $defender = $_POST['defender'];
        $food_refund = ((5 * $worker) + (5 * $farmer) + (15 * $warrior) + (15 * $defender));
        if($worker > $unit['worker'] || $farmer >$unit['farmer'] || $warrior > $unit['warrior'] || $defender > $unit['defender']){
            output("You do not have that many units to Destroy");
        }else{
            $unit['worker'] -= $worker;
            $unit['farmer'] -= $farmer;
            $unit['warrior'] -= $warrior;
            $unit['defender'] -= $defender;

            $workers = $unit['worker'];
            $farmers = $unit['farmer'];
            $warriors = $unit['warrior'];
            $defenders = $unit['defender'];

            $sql = "UPDATE units SET worker = '$workers',
                                     farmer = '$farmers',
                                     warrior = '$warriors', 
                                     defender = '$defenders' 
                                     WHERE id = '$sessid'";

            $result = mysqli_query($con,$sql);

            $stats['food'] += $food_refund;
            $food = $stats['food'];

            $sql = "UPDATE stats SET food = '$food' 
                                 WHERE id = '$sessid'";
            $result = mysqli_query($con,$sql);
            include('update_stats.php');
            output("You have destroyed your units");
        
        }
    }
    
    
    ?>
    <center><h2>Your Units</h2></center>
    
</br>
You can Train and Destroy your units here.
</br>

<form action="units.php" method="POST">
<table cellpadding="5" cellspacing="5">
    <tr>
        <td><b>Unit Type</b></td>
        <td><b>Number of Units</b></td>
        <td><b>Unit Cost &nbsp</b></td>
        <td><b>Recruit</b></td>
    </tr>
    <tr>
        <td>Worker</td>
        <td><?php echo number_format($unit['worker']) ?></td>
        <td>10 Food</td>
        <td><input type="number" value=0 name="worker" min=0 /></td>
    </tr>
    <tr>
        <td>Farmer</td>
        <td><?php echo number_format($unit['farmer']) ?></td>
        <td>10 Food</td>
        <td><input type="number"value =0 name="farmer" min=0/></td>
    </tr>
    <tr>
        <td>Warrior</td>
        <td><?php echo number_format($unit['warrior']) ?></td>
        <td>30 Food</td>
        <td><input type="number" value=0 name="warrior" min=0 /></td>
    </tr>
    <tr>
        <td>Defender</td>
        <td><?php echo number_format($unit['defender']) ?></td>
        <td>30 Food</td>
        <td><input type="number" value =0 name="defender" min=0 /></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="train" value="Train"/></td>
    </tr>
</table>
</form>
</hr>
<form action="units.php" method="POST">
<table cellpadding="5" cellspacing="5">
    <tr>
        <td><b>Unit Type</b></td>
        <td><b>Number of Units</b></td>
        <td><b>Food Gain</b></td>
        <td><b>Destroy</b></td>
    </tr>
    <tr>
        <td>Worker</td>
        <td><?php echo number_format($unit['worker']) ?></td>
        <td>5 Food</td>
        <td><input type="number" value=0 name="worker" min=0 /></td>
    </tr>
    <tr>
        <td>Farmer</td>
        <td><?php echo number_format($unit['farmer']) ?></td>
        <td>5 Food</td>
        <td><input type="number" value=0 name="farmer" min=0 /></td>
    </tr>
    <tr>
        <td>Warrior</td>
        <td><?php echo number_format($unit['warrior']) ?></td>
        <td>15 Food</td>
        <td><input type="number" value=0 name="warrior" min=0 /></td>
    </tr>
    <tr>
        <td>Defender</td>
        <td><?php echo number_format($unit['defender']) ?></td>
        <td>15 Food</td>
        <td><input type="number" value=0 name="defender" min=0/></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><input type="submit" name="destroy" value="Destroy"/></td>
    </tr>
</table>
</form>

    <?php
}



include_once("footer.php");
?>