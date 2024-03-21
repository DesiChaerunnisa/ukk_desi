<?php
session_start();
include 'connect/function.php';

$connection = new Connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galery</title>
    <link rel="stylesheet" href="bo/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/all.min.css"/>
    <style>
        .login{
            margin-left:10px;
        }

        .card{
            margin-top:20px;
            border-radius: 10px;
        }

        .banner{
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('bg/bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .banner-content{
            height: 100%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body style="background: #E3E1D9;">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#B4B4B8; box-shadow: 0px 0px 10px 5px white;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: white">Desi Galery Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
     <div class="login">
        <a href="login.php" class="btn btn-outline-light" type="submit">Login</a>
     </div>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid banner" >
           <div class="container banner-content col-lg-6">
              <div class="text-center">
                <p class="fs-1">
                  Selamat Datang Di Website Gallery Foto
                </p>
                <a href="register.php" class="btn btn-outline-light" type="submit">Daftar</a>
              </div>
           </div>
        </div>

<div class="container" >
  <div class="row">
    <?php 
      $query = mysqli_query($connection->conn, "SELECT * FROM foto");
      while($data = mysqli_fetch_array($query)){
     ?>
   
     <div class="col-md-4 mt-2 " >
        <div class="card">
          <img style="height:12rem; border-radius: 10px;" src="foto/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>">
          <div class="card-footer text-center">
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
</div>
  
  

<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color:#B4B4B8; color:white; box-shadow: 0px 0px 10px 5px white; position: relative;;">
    <p>&copy; Tugas UKK | Desi Chaerunnisa</p>
</footer>

<script type="text/javascript" src="bo/js/bootstrap.bundle.min.js"></script>

</body>
</html>