<?php
session_start();
require "db.php";

$err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username=?");
    $stmt->execute([$u]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if(password_verify($p, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['photo'] = $user['photo'];

            header("Location: dashboard.php");
            exit;
        } else {
            $err = "Password salah";
        }
    } else {
        $err = "Username tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
body{
  background:#f4f6fb;
}
</style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">OfficeLearn</a>
  </div>
</nav>

<!-- LOGIN FORM -->
<div class="container my-5 pt-5">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="card shadow-lg rounded-4 p-4">

<h3 class="text-center mb-4">Login</h3>

<?php if($err): ?>
<div class="alert alert-danger text-center"><?= $err ?></div>
<?php endif; ?>

<form method="post">

<div class="mb-3">
  <label class="form-label">Username</label>
  <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
</div>

<div class="mb-3">
  <label class="form-label">Password</label>
  <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
</div>

<button class="btn btn-primary w-100 py-2">Login</button>

</form>

<div class="text-center mt-3">
<a href="index.php" class="text-decoration-none">← Kembali ke Beranda</a>
</div>

</div>

</div>
</div>
</div>

<div class="flex-grow-1"></div>

<!-- FOOTER -->
<footer class="text-white pt-5" style="background-color: #0d6efd;">
  <div class="container pb-4">
    <div class="row">
      
      <div class="col-md-4 mb-4">
        <h6 class="fw-bold mb-3">Tentang OfficeLearn</h6>
        <p class="small">
          OfficeLearn adalah platform kursus online untuk belajar Microsoft Word, Excel, dan PowerPoint secara interaktif.
        </p>
      </div>

      <div class="col-md-4 mb-4">
        <h6 class="fw-bold mb-3">Hubungi Kami</h6>
        <ul class="list-unstyled small">
          <li><i class="bi bi-geo-alt"></i> Semarang, Jawa Tengah</li>
          <li><i class="bi bi-whatsapp"></i> +62 815-4876-5189</li>
          <li><i class="bi bi-envelope"></i> 111202415759@mhs.dinus.ac.id</li>
        </ul>
      </div>

      <div class="col-md-4 mb-4">
        <h6 class="fw-bold mb-3">Tautan Cepat</h6>
        <ul class="list-unstyled small">
          <li>Program Kursus</li>
          <li>Artikel & Tutorial</li>
          <li>Galeri</li>
          <li>Pendaftaran</li>
        </ul>
      </div>

    </div>

    <hr class="border-light">

    <div class="d-flex justify-content-between small">
      <p>© 2025 OfficeLearn</p>
      <div class="d-flex gap-3">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-instagram"></i>
        <i class="bi bi-youtube"></i>
        <i class="bi bi-whatsapp"></i>
      </div>
    </div>

  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
