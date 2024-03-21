<?php

class Connection{
   public $host = "localhost";
   public $user = "root";
   public $password = "";
   public $dbname = "gallery";
   public $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
    }
}

class Register extends Connection{
    public function registration($Username, $Password, $Email, $NamaLengkap, $Alamat){
      $duplicate = mysqli_query($this->conn, "SELECT * FROM user WHERE username ='$Username' OR email = '$Email'");
      if(mysqli_num_rows($duplicate) > 0){
        return 10;
      }
      else{
        if($Password){
            $query = "INSERT INTO user VALUES('','$Username', '$Password', '$Email', '$NamaLengkap', '$Alamat')";
            mysqli_query($this->conn, $query);
            return 1;
            // Registration successful
        }
        else {
          return 100;
        }
      }
    }
}

class Login extends Connection{
  public $UserId;
  public function login($Usernameemail, $Password){
    $result = mysqli_query($this->conn, "SELECT * FROM user WHERE username = '$Usernameemail' OR email = '$Usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
      if($Password == $row["Password"]){
      $this->UserID = $row["UserID"];
      return 1;
    }
    else{
      return 10;
    }
  }
    else{
      return 100;
    }
  }

  public function idUser(){
    return $this->UserID;
  }
}

class Select extends Connection{
 public function selectUserById($UserId){
  $result = mysqli_query($this->conn, "SELECT * FROM user WHERE id = $UserId");
  return mysqli_fetch_assoc($result);
 }  
}



