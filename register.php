<?php
 require 'connect/function.php';

$register = new Register();

if(isset($_POST["submit"])){
  $result = $register->registration($_POST["username"], $_POST['password'], $_POST['email'],$_POST['nama_lengkap'], $_POST['alamat']);

  if($result == 1){
    echo
    "<script> alert('Registrasi Berhasil !') </script>";
  }
  elseif($result == 10){
    echo
    "<script> alert('Username atau Email Sudah Terdaftar'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <style>
    .body{
      margin: 0;
            padding: 0;
            background: black;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: sans-serif;
    }

    .regis{
            position: fixed;
            margin-top: 10px;
            left: 400px;
            background: url('bg/daftar.jpg');
            padding: 53px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 10px #31363F;
            justify-content: center;
        }

      .regis h2{
            text-align: center;
            color: white;
            font-size: 35px;
            font-family: sans-serif;
            letter-spacing: 6px;
            padding-top: 0;
            margin-top: 5px;
        }

      .regis p{
            color: white;
            text-align: center;
        }

      .regis a{
            color: #9BB0C1;
        }

      .regis button{
            width: 80%;
            height: 35px;
            margin: 15px 0;
            border-radius: 50px;
        }

      .regis button:hover{
            background-color: #C7C8CC;
        }

        .box-register input:focus~label,
        .box-register input:valid~label{
            top: -5px;
        }

      .box-register{
            position: relative;
            width: 100%;
            height: 35px;
            border-bottom: 2px solid white;
            margin: 15px 0;
            color: white;
        }

      .box-register label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            font-weight: 500;
            pointer-events: none;
        }

      .box-register input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 15px;
        }
    </style>
  </style>
</head>
<body style="background: #E3E1D9; position: relative; ">
  <div class="regis">
  <h2>Registration</h2>
  <form class="" action="" method="post" autocomplete="off">
    <div class="box-register">
    <input type="text" name="username" required value=""><br>
    <label for="">Username</label>
    </div>
    <div class="box-register">
    <input type="password" name="password" required value=""><br>
    <label for="">Password</label>
    </div>
    <div class="box-register">
    <input type="email" name="email" required value=""><br>
    <label for="">Email</label>
    </div>
    <div class="box-register">
    <input type="text" name="nama_lengkap" required value=""><br>
    <label for="">Nama Lengkap</label>
    </div>
    <div class="box-register">
    <input type="text" name="alamat" required value=""><br>
    <label for="">Alamat</label>
    </div>
    <center><button type="submit" name="submit">Register</button></center>
    <p class= "login-register-text"> Kembali Ke Halaman <a href= "login.php">Login</a></p>
</form>
</div>
</body>
</html>