<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "wavecafe";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: kelolamenu.html");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "<script>alert('Login gagal'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login WaveCafe</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 300px; }
    .box h2 { text-align: center; margin-bottom: 20px; }
    .box input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
    .box button { width: 100%; padding: 10px; background: #009688; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>
  <form method="POST" class="box">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Masuk</button>
  </form>
</body>
</html>
