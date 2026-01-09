<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
  $u=$_POST['username'];
  $p=$_POST['password'];

  $q=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$u' AND password='$p'");
  if(mysqli_num_rows($q)>0){
    $_SESSION['login']=$u;
    header("Location: admin.php");
  }else{
    echo "Login gagal";
  }
}
?>

<form method="post">
Username:<br>
<input type="text" name="username"><br><br>
Password:<br>
<input type="password" name="password"><br><br>
<button name="login">Login</button>
</form>
