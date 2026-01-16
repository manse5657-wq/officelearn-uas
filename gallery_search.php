<?php
require "db.php";

$keyword = $_GET['q'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM gallery WHERE title LIKE ? ORDER BY id DESC");
$stmt->execute(["%$keyword%"]);

while($row = $stmt->fetch()){
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
