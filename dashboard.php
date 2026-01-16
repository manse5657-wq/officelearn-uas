<?php
session_start();
$username = $_SESSION['username'];
$photo = $_SESSION['photo'] ?? 'default.png';
require 'db.php';
$totalGallery = $pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kursus Microsoft Office Online | Word, Excel, PowerPoint</title>
  <meta name="description" content="Belajar Microsoft Word, Excel, dan PowerPoint dengan metode interaktif dan mudah dipahami. Kursus online untuk pelajar, mahasiswa, dan profesional.">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f8f9fa;
      min-height: 100vh;
      margin: 0;
      background: linear-gradient(120deg, #f4f6f8, #eae4f6, #fffaf0);
      background-attachment: fixed;
      background-size: 400% 400%;
      animation: gradientFlow 12s ease infinite;
    }

    @media (max-width: 768px) {
      #tentang-kursus .col-md-6:first-child {
      order: 2;
      }
      #tentang-kursus .col-md-6:last-child {
      order: 1;
      }
    }

    @keyframes gradientFlow {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    .hero {
      background: linear-gradient(rgba(0, 62, 150, 0.7), rgba(0, 62, 150, 0.8)), url('https://cdn.pixabay.com/photo/2018/01/16/07/52/office-3089947_1280.jpg') center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 100px 20px;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
    }
    
    .hero p {
      font-size: 1.3rem;
      margin-top: 15px;
      font-weight: 300;
    }

    h2.section-title {
      font-weight: 700;
      color: #0d6efd;
      text-align: center;
      margin-bottom: 40px;
    }

    #gallery img {
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    #gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card {
      border: none;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 25px 0;
      margin-top: 60px;
    }

    footer a i {
    transition: transform 0.2s ease, color 0.2s ease;
    }
    
    footer a i:hover {
    transform: scale(1.2);
    color: #ffd43b;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056d2;
    }
  </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">OfficeLearn</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
          <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Galeri</a></li>
          <li class="nav-item"><a class="nav-link" href="#daftar">Daftar</a></li>
        </ul>
      </div>
    </div>
  </nav>


<div class="container my-5 pt-5">

  <h2 class="section-title text-center mb-4 mt-4">Dashboard Admin</h2>

  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-lg rounded-4 p-4">

        <div class="text-center mb-4">

    <img src="uploads/users/<?= htmlspecialchars($_SESSION['photo'] ?? 'default.png') ?>"
         style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #0d6efd;">

    <p class="mt-3 mb-0">
        Selamat datang, <b><?= htmlspecialchars($_SESSION['username']) ?></b>
    </p>

</div>


        <div class="row g-3">

          <div class="col-md-6">
            <a href="gallery_list.php" class="text-decoration-none">
              <div class="card h-100 text-center p-4 shadow-sm">
                <h5>📷 Kelola Gallery</h5>
                <p class="text-muted small"><?= $totalGallery ?> Data gambar tersimpan</p>
              </div>
            </a>
          </div>

          <div class="col-md-6">
            <a href="index.php" class="text-decoration-none">
              <div class="card h-100 text-center p-4 shadow-sm">
                <h5>🌐 Lihat Website</h5>
                <p class="text-muted small">Buka halaman utama</p>
              </div>
            </a>
          </div>

          <div class="col-md-6">
            <a href="profile.php" class="text-decoration-none">
              <div class="card h-100 text-center p-4 shadow-sm">
                <h5>👤 Profile</h5>
                <p class="text-muted small">Lihat data akun</p>
              </div>
            </a>
          </div>

          <div class="col-md-6">
            <a href="logout.php" class="text-decoration-none">
              <div class="card h-100 text-center p-4 shadow-sm border-danger">
                <h5 class="text-danger">🚪 Logout</h5>
                <p class="text-muted small">Keluar dari sistem</p>
              </div>
            </a>
          </div>

        </div>

      </div>

    </div>
  </div>

</div>

<div class="flex-grow-1"></div>

<footer class="text-white pt-5" style="background-color: #0d6efd;">
    <div class="container pb-4">
      <div class="row">
        
        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Tentang OfficeLearn</h5>
          <p>
            OfficeLearn adalah platform kursus online untuk belajar Microsoft Word, Excel, dan PowerPoint secara interaktif.
            Kami berkomitmen membantu pelajar dan profesional menguasai keterampilan digital modern.
          </p>
        </div>

        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Hubungi Kami</h5>
          <ul class="list-unstyled">
            <li><i class="bi bi-geo-alt"></i> Jl. Pandanaran No. 15, Semarang, Jawa Tengah</li>
            <li><i class="bi bi-whatsapp"></i> +62 815-4876-5189</li>
            <li><i class="bi bi-envelope"></i> 111202415759@mhs.dinus.ac.id</li>
          </ul>
        </div>

        <div class="col-md-4 mb-4">
          <h5 class="fw-bold mb-3">Tautan Cepat</h5>
          <ul class="list-unstyled">
            <li><a href="#program" class="text-white text-decoration-none">Program Kursus</a></li>
            <li><a href="#artikel" class="text-white text-decoration-none">Artikel & Tutorial</a></li>
            <li><a href="#gallery" class="text-white text-decoration-none">Galeri</a></li>
            <li><a href="#daftar" class="text-white text-decoration-none">Pendaftaran</a></li>
          </ul>
        </div>
      </div>
      <hr class="border-light" />

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <p class="mb-2 mb-md-0">&copy; 2025 OfficeLearn | Semua hak dilindungi.</p>
        <div class="d-flex justify-content-center justify-content-md-end align-items-center gap-3">
          <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
          <a href="#" class="text-white fs-5"><i class="bi bi-whatsapp"></i></a>
        </div>

      </div>
    </div>
  </footer>

</body>
</html>
