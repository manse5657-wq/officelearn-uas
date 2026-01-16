<?php
session_start();
if(!isset($_SESSION['login'])){
  header("Location: login.php");
  exit;
}
include "koneksi.php";
?>


<a href="logout.php">Logout</a>

<h2>Admin - Kelola Artikel</h2>
<a href="admin.php?aksi=tambah">+ Tambah Artikel</a>
<hr>

<?php
if(isset($_GET['aksi']) && $_GET['aksi']=="tambah"){
?>

<form method="post" enctype="multipart/form-data">
Judul:<br>
<input type="text" name="judul" required><br><br>

Isi:<br>
<textarea name="isi" required></textarea><br><br>

Gambar:<br>
<input type="file" name="gambar"><br><br>

<button name="simpan">Simpan</button>
</form>

<?php
}

if(isset($_POST['simpan'])){
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $tanggal = date("Y-m-d H:i:s");

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $nama = time()."_".$gambar;

  move_uploaded_file($tmp, "upload/".$nama);

  mysqli_query($koneksi,"INSERT INTO article(judul,isi,tanggal,gambar)
  VALUES('$judul','$isi','$tanggal','$nama')");

  echo "Artikel tersimpan";
}
?>

<hr>

<?php
if(isset($_GET['edit'])){
$id = $_GET['edit'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM article WHERE id='$id'"));
?>

<form method="post">
Judul:<br>
<input type="text" name="judul" value="<?= $data['judul'] ?>"><br><br>

Isi:<br>
<textarea name="isi"><?= $data['isi'] ?></textarea><br><br>

<button name="update">Update</button>
</form>

<?php }

if(isset($_POST['update'])){
  $id = $_GET['edit'];
  $judul=$_POST['judul'];
  $isi=$_POST['isi'];
  mysqli_query($koneksi,"UPDATE article SET judul='$judul', isi='$isi' WHERE id='$id'");
  header("Location: admin.php");
}

?>

<table border="1" cellpadding="8">
<tr>
<th>Judul</th>
<th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi,"SELECT * FROM article ORDER BY id DESC");
while($r = mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $r['judul'] ?></td>
<td>
<a href="admin.php?edit=<?= $r['id'] ?>">Edit</a> |
<a href="admin.php?hapus=<?= $r['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

<?php
if(isset($_GET['hapus'])){
  $id = $_GET['hapus'];
  mysqli_query($koneksi,"DELETE FROM article WHERE id='$id'");
  header("Location: admin.php");
}
?>
