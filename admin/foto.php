<?php
include '../connect/tambah_foto.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galery</title>
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
     <link rel="stylesheet" href="../bo/css/bootstrap.min.css">
     <link rel="stylesheet" href="../fontawesome/font-awesome/6.5.1/css/all.min.css">
     <link rel="stylesheet" href="../fontawesome/font-awesome/6.5.1/css/brands.min.css">
    <style>
       .login{
            margin-left:10px;
        }

        .container{
          margin-top: 25px;
        }

        .card{
            margin-top: 15px;
            border-radius:12px;
        }
        
        .card-header{
          text-align: center;
        }

        .card-body{
            background-color: #B7C9F2;
            border-radius:5px;
        }

        .card-body button{
          border-radius:5px;
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
          <a class="nav-link active" aria-current="page" href="index.php", style="color: white">Beranda</a>
        </li>
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
        <a href="../logout.php" class="btn btn-outline-light" type="submit">Keluar</a>
     </div>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
           <div class="card mt-2">
            <div class="card-header">Tambah Foto</div>
            <div class="card-body">
                <form action="../connect/tambah_foto.php" method="POST" enctype="multipart/form-data">
                    <label class="form-label">Judul Foto</label>
                    <input type="text" name="JudulFoto" class="form-control" style="border-radius: 20px;"required>
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="DeskripsiFoto" style="border-radius: 20px;" required></textarea>
                    <label class="form-label">Album</label>
                    <select class="form-control" name="AlbumID" style="border-radius: 20px;" required>
                    <?php
                        $Userid = $_SESSION['UserID'];
                        $sql_album = mysqli_query($connection->conn, "SELECT * FROM album WHERE UserID='$Userid'");
                        while($data_album = mysqli_fetch_array($sql_album)) { ?>
                          <option value="<?php echo $data_album['AlbumID']?>"><?php echo $data_album['NamaAlbum'] ?></option>
                        <?php } ?>
                    </select>
                    <label class="form-label">File</label>
                    <input type="file" class="form-control" name="lokasifile" style="border-radius: 20px;" required>
                    <center><button type="submit" class="btn btn-primary mt-2" name="tambahfoto" style="border-radius: 40px" width="80%"> Upload Foto</button></center>
              </form>
            </div>
          </div>
        </div>


        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">
                    Data Album
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $UserID = $_SESSION['UserID'];
                          $sql = mysqli_query($connection->conn, "SELECT * FROM foto WHERE UserID='$UserID'");
                          while($data = mysqli_fetch_array($sql)){
                          ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><img src="../foto/img/<?php echo $data['LokasiFile'] ?>" width="100" style=" border-radius: 10px;"></td>
                                <td><?php echo $data['JudulFoto'] ?></td>
                                <td><?php echo $data['DeskripsiFoto'] ?></td>
                                <td><?php echo $data['TanggalUnggah'] ?></td>
                                <td>
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['FotoID'] ?>" style="border-radius:15px;" width="80%">
                                   Edit
                                 </button>

                                <div class="modal fade" id="edit<?php echo $data['FotoID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel"  style="border-radius: 20px;"width="80%">Edit Data</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                  <div class="modal-body" style="background-color: #B7C9F2;">
                                    <form action="../connect/tambah_foto.php" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="FotoID" value="<?php echo $data['FotoID'] ?>">
                                      <label class="form-label" >Judul Foto</label>
                                      <input type="text" name="JudulFoto" value="<?php echo $data['JudulFoto'] ?>" class="form-control" style="border-radius: 20px;" width="80%" required>
                                      <label class="form-label">Deskripsi</label>
                                      <textarea class="form-control" name="DeskripsiFoto" style="border-radius: 20px;" width="80%" required>
                                      <?php echo $data['DeskripsiFoto'] ?>
                                      </textarea>
                                      <label class="form-label">Album</label>
                                      <select class="form-control" name="AlbumID" style="border-radius: 20px;">
                                      <?php
                                           $sql_album = mysqli_query($connection->conn, "SELECT * FROM album WHERE UserID='$UserID'");
                                           while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                           <option <?php if($data_album['AlbumID'] == $data['AlbumID']) { ?>selected="selected"<?php } ?> value="<?php echo $data_album['AlbumID']?>"><?php echo $data_album['NamaAlbum'] ?></option>
                                       <?php } ?>
                                      </select>
                                      <label class="form-label">Foto</label>
                                      <div class="row">
                                        <div class="col-md-4">
                                        <img src="../foto/img/<?php echo $data['LokasiFile'] ?>" width="100" style="border-radius: 10px;">
                                        </div>
                                      </div>
                                      </div>
                           <div class="modal-footer">
                            <button type="submit" name="edit" class="btn btn-primary"  style="border-radius: 20px" width="80%">Edit Data</button>
                            </form>
                          </div>
                         </div>
                       </div>
                     </div>
                     <script>
                        var myModal = new bootstrap.Modal(document.getElementById('edit<?php echo $data['FotoID']?>'));
                    </script>

                     <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['FotoID'] ?>" style="border-radius: 20px" width="80%">Hapus</button>

                          <div class="modal fade" id="hapus<?php echo $data['FotoID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                            <div class="modal-content">
                             <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          <div class="modal-body">
                            <form action="../connect/tambah_foto.php" method="POST">
                              <input type="hidden" name="FotoID" value="<?php echo $data['FotoID'] ?>">
                              Apakah Anda Yakin Akan Menghapus foto  <strong><?php  echo $data['JudulFoto'] ?></strong> ?
  
                          </div>
                           <div class="modal-footer">
                            <button type="submit" name="hapus" class="btn btn-primary" style="border-radius: 20px" width="80%">Hapus Data</button>
                            </form>
                          </div>
                         </div>
                       </div>
                     </div>
                            </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color:#B4B4B8; color:white; box-shadow: 0px 0px 10px 5px white; position: relative;">
    <p>&copy; Tugas UKK | Desi Chaerunnisa</p>
</footer>

<script type="text/javascript" src="../bo/js/bootstrap.bundle.min.js"></script>

</body>
</html>