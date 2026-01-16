<?php
require "db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">

<h2>Tambah Gallery</h2>

<div class="card shadow p-4 mb-4">
<h4 class="mb-3">Tambah Gallery</h4>

<form action="gallery_list.php" method="post" enctype="multipart/form-data">

<div class="mb-3">
<input type="text" name="title" class="form-control" placeholder="Judul gambar" required>
</div>

<div class="mb-3">
<input type="file" name="image" class="form-control" required>
</div>

<div class="mb-3">
<textarea name="caption" class="form-control" placeholder="Caption"></textarea>
</div>

<button type="submit" name="submit" class="btn btn-primary">Simpan</button>

</form>
</div>

<hr>

<h2>Daftar Gallery</h2>
<input type="text" id="search" class="form-control mb-3" placeholder="Cari judul gallery...">

<?php
// =====================
// SIMPAN
// =====================
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $caption = $_POST['caption'];

    $file = $_FILES['image']['name'];
    $tmp  = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];

    $folder = "uploads/gallery/";
    if(!file_exists($folder)){
        mkdir($folder,0777,true);
    }

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png'];

    if(!in_array($ext,$allowed)){
        echo "<div class='alert alert-danger'>Format gambar harus JPG / PNG</div>";
        exit;
    }

    if($size > 2*1024*1024){
        echo "<div class='alert alert-danger'>Ukuran maksimal 2MB</div>";
        exit;
    }

    $filename = time()."_".uniqid().".".$ext;
    move_uploaded_file($tmp, $folder.$filename);

    $stmt = $pdo->prepare("INSERT INTO gallery(title,filename,caption) VALUES(?,?,?)");
    $stmt->execute([$title,$filename,$caption]);

    echo "<div class='alert alert-success'>Data berhasil disimpan</div>";
}


// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $q = $pdo->prepare("SELECT filename FROM gallery WHERE id=?");
    $q->execute([$id]);
    $img = $q->fetch();

    if($img){
        unlink("uploads/gallery/".$img['filename']);
        $pdo->prepare("DELETE FROM gallery WHERE id=?")->execute([$id]);
        echo "<div class='alert alert-danger'>Data berhasil dihapus</div>";
    }
}
?>

<div id="galleryData">

<?php
$limit = 6;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$data = $pdo->query("SELECT * FROM gallery ORDER BY id DESC LIMIT $start,$limit");
while($row = $data->fetch()){
?>
<div class="card mb-3 p-3 shadow-sm">
    <img src="uploads/gallery/<?= $row['filename'] ?>" class="img-fluid mb-2" style="max-width:300px">

    <h5><?= htmlspecialchars($row['title']) ?></h5>
    <p><?= htmlspecialchars($row['caption']) ?></p>

    <a href="gallery_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-2">Edit</a>

    <a href="gallery_list.php?delete=<?= $row['id'] ?>"
       onclick="return confirm('Yakin ingin menghapus?')"
       class="btn btn-danger btn-sm">Hapus</a>
</div>
<?php } ?>
<?php
$total = $pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
$totalPage = ceil($total / $limit);
?>

<nav>
<ul class="pagination justify-content-center mt-4">
<?php for($i=1;$i<=$totalPage;$i++): ?>
<li class="page-item <?= $i==$page?'active':'' ?>">
    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
</li>
<?php endfor; ?>
</ul>
</nav>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("search").addEventListener("keyup", function(){
    let q = this.value;

    fetch("gallery_search.php?q=" + q)
        .then(res => res.text())
        .then(data => {
            document.getElementById("galleryData").innerHTML = data;
        });
});
</script>
</body>
</html>
