<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $conn = new mysqli('localhost', 'root', '', 'wavecafe');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'admin') {
            header('Location: kelolamenu.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        $error = "Username atau password salah!";
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
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Masuk</button>
  </form>
</body>
</html>
