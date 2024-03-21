<?php
session_start();
$UserID = $_SESSION['UserID'];
include '../connect/function.php';
if ($_SESSION['login'] != 'login'){
  echo "<script>
  alert('Anda belum login');
  location.href='../index.php';
  </script>";
}

$connection = new Connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galery</title>
    <link rel="stylesheet" href="../bo/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/all.min.css"/>
    <style>
        .login{
            margin-left:10px;
        }

        .card{
            margin-top: 1px;
            border-radius: 10px;
        }

        .banner{
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('../bg/bg.jpg');
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
    <a class="navbar-brand" href="#" style="color: white">Website Galery Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php", style="color: white">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="album.php", style="color: white">Album</a>
        </li>
        <li class="nav-item">
          <a href="foto.php "class="nav-link" style="color: white">Foto</a>
        </li>
          </ul>
        </li>
      </ul>
     <div class="login">
        <a href="../logout.php" class="btn btn-outline-light" type="submit">Logout</a>
     </div>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid banner" >
           <div class="container banner-content col-lg-6">
              <div class="text-center">
              <?php 
                $query = mysqli_query($connection->conn, "SELECT * FROM user WHERE UserID='$UserID'");
                 while($data = mysqli_fetch_array($query)){
                ?>
                <p class="fs-1">
                  Haii<strong><br><?php echo $data['NamaLengkap'] ?></br></strong>
                </p>
                <?php } ?>
              </div>
           </div>
        </div>

<div class="container mt-2">
  <div class="row">
    <?php 
     $query = mysqli_query($connection->conn, "SELECT * FROM foto INNER JOIN  user ON foto.UserID=user.UserID INNER JOIN album ON foto.AlbumID=album.AlbumID");
     while($data = mysqli_fetch_array($query)){
     ?>
   
     <div class="col-md-4 mt-2">
     <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>">
    
     <div class="card">
      <p align="left">
      <a class="btn" href="../foto/img/<?php echo $data['LokasiFile']?>" download="my-foto-<?php echo $data['JudulFoto']?>" role="button"><i class="fa-solid fa-download"></i></i></a> 
     </p>
        <img style="height:12rem; border-radius: 10px;" src="../foto/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>">
        <div class="card-footer text-center">
               <?php
                   $FotoID = $data['FotoID'];
                   $CekDislike = mysqli_query($connection->conn, "SELECT * FROM dislikefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");
                   $CekSuka = mysqli_query($connection->conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");
                   if (mysqli_num_rows($CekSuka) == 1) { ?>
                   <a href="../connect/tambah_like.php?FotoID=<?php echo $data ['FotoID'] ?>" type="submit" name="batalsuka"><i class="fa-solid fa-thumbs-up"></i></a>
   
               <?php } else { ?>
                   <a href="../connect/tambah_like.php?FotoID=<?php echo $data ['FotoID'] ?>" type="submit" name="like"><i class="fa-regular fa-thumbs-up"></i></a>
   
               <?php }
                   $Suka = mysqli_query($connection->conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                   echo mysqli_num_rows($Suka). ' Like';
               ?>


                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>"><i class="fa-regular fa-comment" style="color:#EE4266"></i></a>
           
                <?php 
                   $jmlkomen = mysqli_query($connection->conn, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
                   echo mysqli_num_rows($jmlkomen).' Komentar';
                ?>
              </div>
            </div>
          </a>

      <div class="modal fade" id="komentar<?php echo $data['FotoID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-body" style="background-color:#E3E1D9">
              <div class="row">
                <div class="col-md-8">
                  <img src="../foto/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>" style="height:13rem width:20rem; border-radius: 10px;">
                </div>
                <div class="col-md-4">
                  <div class="m-2">
                    <div class="overflow-auto">
                      <div class="stycky-top">
                        <strong><?php echo $data['JudulFoto'] ?></strong><br>
                        <span class="badge bg-secondary"><?php echo $data['NamaLengkap'] ?></span>
                        <span class="badge bg-secondary"><?php echo $data['TanggalUnggah'] ?></span>
                        <span class="badge bg-primary"><?php echo $data['NamaAlbum'] ?></span>
                      </div>
                      <hr>
                      <p align="left">
                        <?php echo $data['DeskripsiFoto'] ?>
                      </p>
                      <hr>
                      <p align="center">
                      <strong><?php 
                        $jmlkomen = mysqli_query($connection->conn, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
                        echo mysqli_num_rows($jmlkomen).' Komentar';
                      ?></strong>
                      </p>
                      <?php 
                      $FotoID = $data['FotoID'];
                      $Komentar = mysqli_query($connection->conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=User.UserID WHERE komentarfoto.FotoID ='$FotoID'");
                      while($row = mysqli_fetch_array($Komentar)){
                      ?>
                       <p align="left">
                        <strong><?php echo $row['NamaLengkap']?></strong>
                        <?php echo $row['IsiKomentar'] ?>
                       </p>
                      <?php } ?>
                      <hr>
                      <div class="sticky-bottom">
                        <form action="../connect/tambah_komentar.php" method="POST">
                          <div class="input-group">
                            <input type="hidden" name="FotoID" value="<?php echo $data['FotoID'] ?>">
                            <input type="text" name="IsiKomentar" class="form-control" placeholder="Tambah Komentar" style="border-radius: 20px">
                            <div class="input-group-prepend">
                              <button type="submit" name="KirimKomentar" Class="btn btn-outline-primary">Kirim</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        </div>
      <?php } ?>
    </div>
  </div>
  
  

<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color:#B4B4B8; color:white; box-shadow: 0px 0px 10px 5px white; position: relative;">
    <p>&copy; Tugas UKK | Desi Chaerunnisa</p>
</footer>

<script type="text/javascript" src="../bo/js/bootstrap.bundle.min.js"></script>

</body>
</html>