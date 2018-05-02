<?php
include_once("header.php");

if(isset($_POST['login'])){
    if(isset($_SESSION['uid'])){
        echo "You are logged in";
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_check = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($con, $login_check);
        if(mysqli_num_rows($result) == 0){
            echo "Inavlid Username/Password";
        }
        else{
            $row = mysqli_fetch_assoc($result);
            $hashpass = $row['password'];
            $dehashedpass = password_verify($password,$hashpass);
            if($dehashedpass == 0){
                echo "Invalid Username/Password";
            }
            else{
                $sql = "SELECT id FROM user WHERE username = '$username' AND password = '$hashpass'";
                $result = mysqli_query($db, $sql);
            }
            $_SESSION['uid'] = $row['id'];
            header("Location: main.php");
        }
        

    }
}else{
    echo "You have visited this page incorrectly";
}


include_once("footer.php");
?>