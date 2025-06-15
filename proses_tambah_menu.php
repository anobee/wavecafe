<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "wavecafe"; // ganti sesuai nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama = $_POST['namaMenu'];
$deskripsi = $_POST['deskripsiMenu'];
$harga = $_POST['hargaMenu'];

// Upload gambar
$gambar = $_FILES['gambarMenu']['name'];
$tmp = $_FILES['gambarMenu']['tmp_name'];
$upload_path = "img/" . $gambar;

if (move_uploaded_file($tmp, $upload_path)) {
    $query = "INSERT INTO menu (nama, deskripsi, harga, gambar) VALUES ('$nama', '$deskripsi', '$harga', '$gambar')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Menu berhasil ditambahkan'); window.location.href='kelola-menu.html';</script>";
    } else {
        echo "Gagal tambah menu: " . mysqli_error($conn);
    }
} else {
    echo "Upload gambar gagal.";
}

mysqli_close($conn);
?>
