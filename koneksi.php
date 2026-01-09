<?php
$koneksi = mysqli_connect(
    "sql106.infinityfree.com",
    "if0_40862269",
    "Caligraph115",
    "if0_40862269_dailyjournal",
    3306
);

if(!$koneksi){
    die("Koneksi database gagal: ".mysqli_connect_error());
}
?>
