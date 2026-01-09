<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "koneksi.php";

if(!$koneksi){
  die("DB ERROR: ".mysqli_connect_error());
}

echo "KONEKSI OK<br>";
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

<body>

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

  <section class="hero">
    <div class="text-center"> <h1>Kursus Microsoft Office Online</h1>
      <p>Tingkatkan keterampilan Anda dalam Word, Excel, dan PowerPoint dengan panduan praktis & video interaktif.</p>
      <a href="#daftar" class="btn btn-light btn-lg mt-3">Daftar Sekarang</a>
    </div>
  </section>

  <section id="tentang-kursus" class="container my-5">
    <h2 class="section-title">Tentang Kursus</h2>
      <div class="row align-items-center">
      <div class="col-md-6">
        <br>
        <p>
          Kursus Microsoft Office ini dirancang untuk siapa pun yang ingin meningkatkan kemampuan kerja di era digital.
          Materi meliputi pembuatan dokumen profesional di Word, pengelolaan data di Excel, dan presentasi efektif di PowerPoint.
          Semua pelajaran disajikan dengan gaya interaktif dan contoh nyata dunia kerja.
        </p>
        <ul>
          <li>💡 Belajar kapan saja dan di mana saja</li>
          <li>🎓 Sertifikat setelah menyelesaikan kursus</li>
          <li>👨‍🏫 Mentor berpengalaman di bidang IT dan perkantoran</li>
        </ul>
      </div>
      <div class="col-md-6 text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/Microsoft_Office_logo_%282013%E2%80%932019%29.svg" alt="Office Icon" class="img-fluid w-50">
      </div>
    </div>
  </section>

  <section id="program" class="container my-5">
    <h2 class="section-title">Pilihan Program</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card text-center p-4 shadow-sm">
          <img src="http://upload.wikimedia.org/wikipedia/commons/8/8d/Microsoft_Word_2013-2019_logo.svg" alt="Word" class="mx-auto mb-3" width="80">
          <h5 class="fw-bold">Microsoft Word</h5>
          <p>Pelajari cara membuat dokumen profesional, surat, laporan, dan template bisnis dengan mudah.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center p-4 shadow-sm">
          <img src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel" class="mx-auto mb-3" width="80">
          <h5 class="fw-bold">Microsoft Excel</h5>
          <p>Pahami rumus, pivot table, dan analisis data untuk efisiensi kerja dan keputusan berbasis data.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center p-4 shadow-sm">
          <img src="https://cdn-icons-png.flaticon.com/512/732/732224.png" alt="PowerPoint" class="mx-auto mb-3" width="80">
          <h5 class="fw-bold">Microsoft PowerPoint</h5>
          <p>Buat presentasi visual yang menarik, profesional, dan efektif untuk berbagai kebutuhan kerja.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="artikel" class="container my-5">
  <h2 class="section-title">Artikel & Tutorial</h2>
  <div class="row g-4">

<?php
include "koneksi.php";
$query = mysqli_query($koneksi,"SELECT * FROM article");

$query = mysqli_query($koneksi,"SELECT * FROM article") or die(mysqli_error($koneksi));
?>
  <div class="col-md-4">
    <div class="card p-3 h-100 shadow-sm">
      <div class="card-body">

      <img src="upload/<?= $row['gambar'] ?>" class="img-fluid mb-2">

        <h5 class="card-title fw-bold"><?= $row['judul'] ?></h5>
        <p class="card-text"><?= $row['isi'] ?></p>
        <small><?= $row['tanggal'] ?></small>
      </div>
    </div>
  </div>
<?php } ?>

  </div>
</section>


  <!-- GALLERY SECTION -->
  <section id="gallery" class="container my-5">
    <h2 class="section-title">Galeri Kegiatan Kursus</h2>
    <div class="row g-4">
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?fm=jpg&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y29tcHV0ZXIlMjBjbGFzc3xlbnwwfHwwfHx8MA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" class="card-img-top rounded-3" alt="Kelas Microsoft Word">
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://plus.unsplash.com/premium_photo-1661762857872-77960f34d91b?fm=jpg&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJlc2VudGF0aW9ufGVufDB8fDB8fHww&ixlib=rb-4.1.0&q=60&w=3000" class="card-img-top rounded-3" alt="Kelas Microsoft Excel">
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?fm=jpg&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29ycG9yYXRlJTIwdHJhaW5pbmd8ZW58MHx8MHx8fDA%3D&ixlib=rb-4.1.0&q=60&w=3000" class="card-img-top rounded-3" alt="Kelas PowerPoint">
        </div>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://images.unsplash.com/photo-1581387490232-2181c3736353?fm=jpg&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2FmZSUyMGxhcHRvcHxlbnwwfHwwfHx8MA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" class="card-img-top rounded-3" alt="Mentoring Online">
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://cdn.pixabay.com/photo/2015/05/31/10/55/man-791049_1280.jpg" class="card-img-top rounded-3" alt="Kelas Hybrid">
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card shadow-sm border-0">
          <img src="https://plus.unsplash.com/premium_photo-1661333528586-e96c4649bfad?fm=jpg&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZW1wbG95ZWUlMjB0cmFpbmluZ3xlbnwwfHwwfHx8MA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" class="card-img-top rounded-3" alt="Belajar Mandiri">
        </div>
      </div>
    </div>
  </section>

  <section id="daftar" class="container my-5">
    <h2 class="section-title">Daftar Sekarang</h2>
    <form class="mx-auto bg-white shadow p-4 rounded-4" style="max-width: 600px;">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" class="form-control" id="email" placeholder="nama@email.com" required>
      </div>
      <div class="mb-3">
        <label for="program" class="form-label">Pilih Program</label>
        <select id="program" class="form-select" required>
          <option value="">-- Pilih Salah Satu --</option>
          <option>Microsoft Word</option>
          <option>Microsoft Excel</option>
          <option>Microsoft PowerPoint</option>
          <option>Paket Lengkap (Word + Excel + PowerPoint)</option>
        </select>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="setuju" required>
        <label class="form-check-label" for="setuju">Saya setuju dengan syarat & ketentuan.</label>
      </div>
      <button type="submit" class="btn btn-primary w-100 py-2">Kirim Pendaftaran</button>
    </form>
  </section>

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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>