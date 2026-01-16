<?php
require "db.php";

if(!isset($_GET['id'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// ambil data lama
$stmt = $pdo->prepare("SELECT * FROM gallery WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if(!$data){
    header("Location: gallery_list.php");
    exit;
}

// proses update
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $caption = $_POST['caption'];

    // cek jika upload gambar baru
    if(!empty($_FILES['image']['name'])){
        $file = $_FILES['image']['name'];
        $tmp  = $_FILES['image']['tmp_name'];

        $folder = "uploads/gallery/";
        $filename = time()."_".$file;

        move_uploaded_file($tmp, $folder.$filename);

        // hapus gambar lama
        if(file_exists($folder.$data['filename'])){
            unlink($folder.$data['filename']);
        }

        $pdo->prepare("UPDATE gallery SET title=?, caption=?, filename=? WHERE id=?")
            ->execute([$title,$caption,$filename,$id]);
    } else {
        $pdo->prepare("UPDATE gallery SET title=?, caption=? WHERE id=?")
            ->execute([$title,$caption,$id]);
    }

    header("Location: gallery_list.php?update=success");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-5">

<h2>Edit Gallery</h2>

<div class="card shadow p-4">

<form method="post" enctype="multipart/form-data">

<div class="mb-3">
<label>Judul</label>
<input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['title']) ?>" required>
</div>

<div class="mb-3">
<label>Caption</label>
<textarea name="caption" class="form-control"><?= htmlspecialchars($data['caption']) ?></textarea>
</div>

<div class="mb-3">
<label>Gambar Saat Ini</label><br>
<img src="uploads/gallery/<?= $data['filename'] ?>" width="200" class="mb-2 rounded shadow">
</div>

<div class="mb-3">
<label>Ganti Gambar (opsional)</label>
<input type="file" name="image" class="form-control">
</div>

<button type="submit" name="update" class="btn btn-success">Update</button>
<a href="gallery_list.php" class="btn btn-secondary">Kembali</a>

</form>

</div>

</div>

</body>
</html>
