<?php
 require 'connect/function.php';
session_start();

$login = new Login();

if(isset($_POST["submit"])){
    $result = $login->login($_POST["Usernameemail"], $_POST["password"]);

    if($result == 1){
    $_SESSION["login"] = true;
    $_SESSION["UserID"] = $login->UserID;
    header("location: admin/index.php");
    }
    elseif($result == 10){
        echo
        "<script> alert('Password Salah !'); </script>";
    }
    elseif($result == 100){
        echo
        "<script> alert('User Belum Terdaftar !'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

</head>
    <style>
        .body{
            margin: 0;
            padding: 0;
            background-color: black;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: sans-serif;
        }

        .bg{
            position: fixed;
            margin-top: 50px;
            left: 400px;
            background: url('bg/daftar.jpg');
            padding: 80px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 10px #31363F;
            justify-content: center;
        }

        .bg h2{
            text-align: center;
            color: white;
            font-size: 35px;
            font-family: sans-serif;
            letter-spacing: 6px;
            padding-top: 0;
            margin-top: 5px;
        }

        .bg p{
            color: white;
        }

        .bg a{
            color: #9BB0C1;
        }

        .bg button{
            
            align-items:center;
            width: 80%;
            height: 35px;
            margin: 15px 0;
            border-radius: 50px;
            
        }
        .bg button:hover{
            background-color: #C7C8CC;
        }

        .box-login input:focus~label,
        .box-login input:valid~label{
            top: -5px;
        }

        .box-login{
            position: relative;
            width: 100%;
            height: 35px;
            border-bottom: 2px solid white;
            margin: 15px 0;
        }

        .box-login label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            font-weight: 500;
            pointer-events: none;
            color: white;
        }

        .box-login input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 15px;
        }
    </style>

<body style="background: #E3E1D9; position: relative;">
    <div class="bg">
    <h2>Login</h2>
    <form class="login" action="" method="post" autocomplete="off">
      <div class="box-login">
        <input type="text" name="Usernameemail" required value=""><br>
        <label for="">Username atau Email</label>
      </div>
      <div class="box-login">
      <input type="password" name="password" required value=""><br>
        <label for="">Password</label>
      </div>
        <center><button type="submit" name="submit" >Login</button></center>
        <p class= "login-register-text"> Belum Mempunyai Akun? <a href= "register.php">Silahkan Buat Akun disini!</a></p>
    </div>
    
</form>
    </div>
</body>
</html>