<?php
include_once("header.php");

?>
Register
</br>
<?php
if(isset($_POST['register'])){
    $username = ($_POST['username']);
    $password1 = ($_POST['password']);
    $password = password_hash($password1,PASSWORD_DEFAULT);
    $email = ($_POST['email']);

    if ($username == "" || $password1 == "" || $email == ""){
        echo "Please enter something in all fields";
    }
    elseif(strlen($username)>20){
        echo "Username must be less than 20 characters";
    }elseif(strlen($email)>100){
        echo "Email must be less than 100 characters";
    }else{
        $register1 = mysqli_query($con,"SELECT id FROM user WHERE username = '$username'") or die (mysqli_error($con));
        $register2 = mysqli_query($con,"SELECT id FROM user WHERE email = '$email'") or die (mysqli_error($con));
        if(mysqli_num_rows($register1)>0){
            echo "Please choose a different username";
        }elseif(mysqli_num_rows($register2)>0){
            echo "Email address is already in use";
        }else{
            $ins1= mysqli_query($con, "INSERT INTO stats (gold,attack,defense,food,income,farming,turns) VALUES (100,10,10,100,10,11,100)") or die (mysqli_error($con));
            $ins2= mysqli_query($con, "INSERT INTO units (worker,farmer,warrior,defender) VALUES (5,5,0,0)") or die (mysqli_error($con));
            $ins3= mysqli_query($con, "INSERT INTO user (username,password,email) VALUES ('$username','$password','$email')") or die(mysqli_error($con));
            $ins4= mysqli_query($con, "INSERT INTO weapons (sword,shield) VALUES (0,0)") or die(mysqli_error($con));
            $ins5= mysqli_query($con, "INSERT INTO ranking (attack,defense,overall) VALUES (0,0,0)")or die(mysqli_error($con));
            echo "You have Registered";
        }
    }

}
?>
</br>
<form action="register.php" method="POST">
    Username: <input type="text" name="username"></br>
    Password: <input type="password" name="password"></br>
    Email: <input type="email" name="email"></br>
    <input type="submit" name="register" value="Register">

</form>
<?php
include_once("footer.php");
?>