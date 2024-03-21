<?php 
session_start();
include 'function.php';
$FotoID = $_GET['FotoID'];
$UserID = $_SESSION['UserID'];

$connection = new Connection();

$CekSuka = mysqli_query($connection->conn, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");

if (mysqli_num_rows($CekSuka) == 1) {
	while($row = mysqli_fetch_array($CekSuka)){
		$LikeID = $row['LikeID'];
		$query = mysqli_query($connection->conn, "DELETE FROM likefoto WHERE LikeID='$LikeID'");
		echo"<script>
		location.href='../admin/index.php';
		</script>";
	}
}else{
	$TanggalLike = date('Y-m-d');
	$query = mysqli_query($connection->conn, "INSERT INTO likefoto VALUES('','$FotoID','$UserID','$TanggalLike')");
	echo"<script>
	location.href='../admin/index.php';
	</script>";
}
?>