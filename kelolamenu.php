<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kelola Menu - Wave Cafe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .admin-button {
            font-size: 1rem;
            padding: 8px 16px;
            margin-top: 10px;
            margin-right: 8px;
            color: white;
            background-color: #339999;
            border: none;
            border-radius: 5px;
            font-family: 'Open Sans', sans-serif;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .admin-button:hover {
            background-color: #2b7a7a;
        }

        .tm-gallery-item {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .tm-video-wrapper {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        #tm-video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-dark text-white p-4">
                <div class="text-center mb-4">
                    <h1 class="h3">Wave Cafe</h1>
                    <p>Halaman Admin</p>
                </div>
                <nav class="nav flex-column">
                    <a href="login.php" class="nav-link text-white">Logout</a>
                </nav>
            </div>

            <!-- Main Content -->
            <!-- Main Content -->
<div class="col-md-9 col-lg-10 p-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Menu</h2>
       <button class="admin-button" data-toggle="modal" data-target="#tambahMenuModal">
    <i class="fas fa-plus mr-2"></i>Tambah Menu
        </button>
    </div>
    <!-- Modal Tambah Menu -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <form action="proses_tambah_menu.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label for="namaMenu">Nama Menu</label>
            <input type="text" class="form-control" id="namaMenu" placeholder="Contoh: Cappuccino">
          </div>
          
          <div class="form-group">
            <label for="deskripsiMenu">Deskripsi</label>
            <textarea class="form-control" id="deskripsiMenu" rows="3" placeholder="Deskripsi singkat menu"></textarea>
          </div>
          
          <div class="form-group">
            <label for="hargaMenu">Harga (Rp)</label>
            <input type="number" class="form-control" id="hargaMenu" placeholder="Contoh: 20000">
          </div>
          
          <div class="form-group">
            <label for="gambarMenu">Gambar Menu</label>
            <input type="file" class="form-control-file" id="gambarMenu">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Menu</button>
        </div>
      </form>
    </div>
  </div>
</div>


    <div class="row">
        <!-- Menu 1 -->
        <div class="col-md-4 mb-4">
            <div class="tm-gallery-item">
                <img src="img/hot-espresso.png" alt="Espresso" class="img-fluid rounded mb-3">
                <h3 class="h5">Espresso</h3>
                <p>Kopi pekat khas Italia dengan cita rasa kuat.</p>
                <p><strong>Rp 15.000</strong></p>
                <button class="admin-button">Edit</button>
                <button class="admin-button">Hapus</button>
            </div>
        </div>

        <!-- Menu 2 -->
        <div class="col-md-4 mb-4">
            <div class="tm-gallery-item">
                <img src="img/hot-cappuccino.png" alt="Cappuccino" class="img-fluid rounded mb-3">
                <h3 class="h5">Cappuccino</h3>
                <p>Kombinasi espresso dan susu berbuih.</p>
                <p><strong>Rp 20.000</strong></p>
                <button class="admin-button">Edit</button>
                <button class="admin-button">Hapus</button>
            </div>
        </div>

        <!-- Menu 3 -->
        <div class="col-md-4 mb-4">
            <div class="tm-gallery-item">
                <img src="img/iced-latte.png" alt="Latte" class="img-fluid rounded mb-3">
                <h3 class="h5">Latte</h3>
                <p>Minuman kopi lembut dengan susu hangat.</p>
                <p><strong>Rp 18.000</strong></p>
                <button class="admin-button">Edit</button>
                <button class="admin-button">Hapus</button>
            </div>
        </div>
    </div>
</div>


    <!-- Background video -->
    <div class="tm-video-wrapper">
        <i id="tm-video-control-button" class="fas fa-pause"></i>
        <video autoplay muted loop id="tm-video">
            <source src="video/wave-cafe-video-bg.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function setVideoSize() {
            const vidWidth = 1920;
            const vidHeight = 1080;
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;
            const tempVidWidth = windowHeight * vidWidth / vidHeight;
            const tempVidHeight = windowWidth * vidHeight / vidWidth;
            const newVidWidth = tempVidWidth > windowWidth ? tempVidWidth : windowWidth;
            const newVidHeight = tempVidHeight > windowHeight ? tempVidHeight : windowHeight;
            const tmVideo = $('#tm-video');

            tmVideo.css('width', newVidWidth);
            tmVideo.css('height', newVidHeight);
        }

        $(document).ready(function(){
            setVideoSize();
            let timeout;
            window.onresize = function(){
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            const btn = $("#tm-video-control-button");
            btn.on("click", function(e) {
                const video = document.getElementById("tm-video");
                $(this).removeClass();

                if (video.paused) {
                    
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        });
    </script>
</body>



</html>
