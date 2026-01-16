<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$koneksi = mysqli_connect(
    "sql106.infinityfree.com",
    "if0_40862269",
    "Caligraph115",
    "if0_40862269_dailyjournal",
    3306
);

if(!$koneksi){
    die("KONEKSI GAGAL: ".mysqli_connect_error());
}

echo "KONEKSI DATABASE BERHASIL<br>";

$q = mysqli_query($koneksi,"SELECT * FROM article") or die("QUERY ERROR: ".mysqli_error($koneksi));

while($r = mysqli_fetch_assoc($q)){
    echo $r['judul']."<br>";
}
?>
