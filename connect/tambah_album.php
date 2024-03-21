<?php
session_start();
include 'function.php';

    $connection = new Connection();

if(isset($_POST['tambahdata'])) {
    $NamaAlbum = $_POST['namaalbum'];
    $Deskripsi = $_POST['deskripsi'];
    $Tanggal = date('Y-m-d');
    $UserID = $_SESSION['UserID'];

    $sql = mysqli_query($connection->conn, "INSERT INTO album VALUES('','$NamaAlbum','$Deskripsi','$Tanggal','$UserID')");
    echo "<script>
    alert('Data Berhasil Di Simpan');
    location.href='../admin/album.php';
    </script>";

}

if(isset($_POST['edit'])) {
    $AlbumID = $_POST['albumid'];
    $NamaAlbum = $_POST['namaalbum'];
    $Deskripsi = $_POST['deskripsi'];
    $Tanggal = date('Y-m-d');
    $UserID = $_SESSION['UserID'];

    $sql = mysqli_query($connection->conn, "UPDATE album SET NamaAlbum = '$NamaAlbum', Deskripsi = '$Deskripsi', TanggalDibuat = '$TanggalDibuat' WHERE AlbumID = '$AlbumID'");

    echo "<script>
    alert('Data Berhasil Di Update');
    location.href='../admin/album.php';
    </script>";
}

if(isset($_POST['hapus'])) {
    $AlbumID = $_POST['albumid'];

    $sql = mysqli_query($connection->conn, "DELETE FROM album WHERE albumid = '$AlbumID'");

    echo "<script>
    alert('Data Berhasil Di Hapus');
    location.href='../admin/album.php';
    </script>";
}

?>