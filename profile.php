<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user_id'];
$msg=''; 
$err='';

// ================= CHANGE PASSWORD =================
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])){
    $old = $_POST['old_password'] ?? '';
    $new = $_POST['new_password'] ?? '';

    if($old === '' || $new === ''){
        $err = 'Isi semua field';
    } else {
        $stmt = $pdo->prepare("SELECT password FROM user WHERE id=?");
        $stmt->execute([$uid]);
        $row = $stmt->fetch();

        if($row && password_verify($old, $row['password'])){
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $pdo->prepare("UPDATE user SET password=? WHERE id=?")->execute([$hash,$uid]);
            $msg = 'Password berhasil diubah';
        } else {
            $err = 'Password lama salah';
        }
    }
}

// ================= UPLOAD FOTO =================
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_photo'])){
    if(isset($_FILES['photo']) && $_FILES['photo']['error']===0){
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $fn = uniqid('u_').'.'.$ext;
        $dest = __DIR__.'/uploads/users/'.$fn;

        if(!is_dir(__DIR__.'/uploads/users')){
            mkdir(__DIR__.'/uploads/users',0777,true);
        }

        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dest)){
            $pdo->prepare("UPDATE user SET photo=? WHERE id=?")->execute([$fn,$uid]);
            $_SESSION['photo']=$fn;
            $msg = 'Foto berhasil diupload';
        } else {
            $err = 'Upload gagal';
        }
    } else {
        $err = 'Tidak ada file dipilih';
    }
}

// ================= AMBIL DATA USER =================
$stmt = $pdo->prepare("SELECT username, fullname, photo FROM user WHERE id=?");
$stmt->execute([$uid]); 
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  background:#f4f6fb;
}
</style>
</head>

<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">OfficeLearn Admin</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery_list.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5 pt-5" style="margin-top:80px;">

<div class="row justify-content-center">
<div class="col-md-7">

<div class="card shadow-lg rounded-4 p-4">

<h3 class="text-center mb-4">Profile User</h3>

<?php if($msg): ?>
<div class="alert alert-success text-center"><?=htmlspecialchars($msg)?></div>
<?php endif; ?>

<?php if($err): ?>
<div class="alert alert-danger text-center"><?=htmlspecialchars($err)?></div>
<?php endif; ?>

<div class="text-center mb-3">
<img src="uploads/users/<?=htmlspecialchars($user['photo'] ?? 'default.png')?>" 
     style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid #0d6efd;">
</div>

<div class="mb-3">
  <label class="form-label fw-bold">Username</label>
  <input type="text"
         class="form-control text-center"
         value="<?= htmlspecialchars($user['username']) ?>"
         readonly>
</div>
<p class="text-center"><b>Fullname:</b> <?=htmlspecialchars($user['fullname'])?></p>

<hr>

<h5 class="mt-4">Ganti Password</h5>
<div class="border rounded p-3 mb-4">

<form method="post">
  <div class="mb-2">
    <input type="password" name="old_password" class="form-control" placeholder="Password lama" required>
  </div>
  <div class="mb-2">
    <input type="password" name="new_password" class="form-control" placeholder="Password baru" required>
  </div>
  <button type="submit" name="change_password" class="btn btn-primary w-100">
    Ganti Password
  </button>
</form>

</div>

<h5>Ganti Foto</h5>
<div class="border rounded p-3">

<form method="post" enctype="multipart/form-data">
  <div class="mb-2">
    <input type="file" name="photo" class="form-control" accept="image/*" required>
  </div>
  <button type="submit" name="update_photo" class="btn btn-success w-100">
    Upload Foto
  </button>
</form>

</div>

<a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-4">
  Kembali ke Dashboard
</a>

</div>

</div>
</div>

</div>

<div class="flex-grow-1"></div>

<footer class="text-white pt-5 mt-5" style="background-color:#0d6efd;">
  <div class="container text-center pb-3">
    <p>© 2025 OfficeLearn | Semua hak dilindungi.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
