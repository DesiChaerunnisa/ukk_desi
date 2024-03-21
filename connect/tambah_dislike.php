<?php  
session_start();
include 'function.php';
$FotoID = $_GET['FotoID'];
$UserID = $_SESSION['UserID'];

$connection = new Connection();

$CekDislike = mysqli_query($connection->conn,"SELECT * FROM dislikefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");

if (mysqli_num_rows($CekDislike) == 1){
    while($row = mysqli_fetch_array($CekDislike)){
        $DislikeID = $row['DislikeID'];
        $query = mysqli_query($connection->conn, "DELETE FROM dislikefoto WHERE DislikeID='$DislikeID'");

        echo "<script>;
        </script>";
    }
} else{
    $TanggalDislike = date('Y-m-d');
    $query = mysqli_query($connection->conn, "INSERT INTO dislikefoto VALUES('','$FotoID','$UserID','$TanggalDislike')");

    echo"<script>
    location.href = '../admin/index.php';
    </script>";
}

?>