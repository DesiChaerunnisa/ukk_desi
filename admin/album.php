<?php
include '../connect/tambah_album.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galery</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../bo/css/bootstrap.min.css">
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
        
        .tbody button{
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
          <a class="nav-link" aria-current="page" href="index.php", style="color: white">Beranda</a>
        </li>
      <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php", style="color: white">Gallery</a>
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
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
           <div class="card mt-2">
            <div class="card-header">Tambah Album</div>
            <div class="card-body">
                <form action="../connect/tambah_album.php" method="POST">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="namaalbum" class="form-control" style="border-radius: 20px;" required>
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" style="border-radius: 20px;" required></textarea>
                    <center><button type="submit" class="btn btn-primary mt-2" name="tambahdata" style="border-radius: 40px" width="80%"> Tambah Data</button></center>
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
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $UserID = $_SESSION['UserID'];
                          $sql = mysqli_query($connection->conn, "SELECT * FROM album WHERE UserID='$UserID'");
                          while($data = mysqli_fetch_array($sql)){
                          ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['NamaAlbum'] ?></td>
                                <td><?php echo $data['Deskripsi'] ?></td>
                                <td><?php echo $data['TanggalDibuat'] ?></td>
                                <td>
                                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['AlbumID'] ?>" style="border-radius: 15px;">
                                     Edit
                                   </button>

                          <div class="modal fade" id="edit<?php echo $data['AlbumID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                            <div class="modal-content">
                             <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel" style="border-radius: 20px;">Edit Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          <div class="modal-body">
                            <form action="../connect/tambah_album.php" method="POST">
                              <input type="hidden" name="albumid" value="<?php echo $data['AlbumID'] ?>">
                              <label class="form-label">Nama Album</label>
                              <input type="text" name="namaalbum" value="<?php echo $data['NamaAlbum'] ?>" class="form-control" style="border-radius: 20px;" required>
                              <label class="form-label">Deskripsi</label>
                              <textarea class="form-control" name="deskripsi" style="border-radius: 20px;" required>
                               <?php echo $data['Deskripsi'] ?>
                              </textarea>
  
                          </div>
                           <div class="modal-footer">
                            <button type="submit" name="edit" class="btn btn-primary" style="border-radius: 20px;">Edit Data</button>
                            </form>
                          </div>
                         </div>
                       </div>
                     </div>
                     <script>
                        var myModal = new bootstrap.Modal(document.getElementById('edit<?php echo $data['AlbumID']?>'));
                    </script>

                     <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['AlbumID'] ?>" style="border-radius: 20px;">Hapus</button>

                          <div class="modal fade" id="hapus<?php echo $data['AlbumID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                            <div class="modal-content">
                             <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel" style="border-radius: 20px;">Hapus Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          <div class="modal-body">
                            <form action="../connect/tambah_album.php" method="POST">
                              <input type="hidden" name="albumid" value="<?php echo $data['AlbumID'] ?>">
                              Apakah Anda Yakin Akan Menghapus Album <strong><?php  echo $data['NamaAlbum'] ?></strong> Tersebut ?
  
                          </div>
                           <div class="modal-footer">
                            <button type="submit" name="hapus" class="btn btn-primary" style="border-radius: 20px;">Hapus Data</button>
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

<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color:#B4B4B8; color: white; box-shadow: 0px 0px 10px 5px white; position: absolute;">
    <p>&copy; UKK | Desi Chaerunnisa</p>
</footer>

<script type="text/javascript" src="../bo/js/bootstrap.bundle.min.js"></script>

</body>
</html>