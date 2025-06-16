-- DROP kalau sudah pernah ada (opsional untuk development)
DROP TABLE IF EXISTS users;

-- Buat tabel users (admin dan user masuk ke sini semua)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);

-- Masukkan data admin dan user
INSERT INTO users (username, password, role) VALUES
('admin', 'admin123', 'admin'),
('user', 'user123', 'user');
