CREATE DATABASE IF NOT EXISTS student_enrollment_system;
USE student_enrollment_system;

DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin account (replace hash with real one from password_hash("ansu123", PASSWORD_DEFAULT))
INSERT INTO admins (email, password)
VALUES ('ansu', '$2y$10$abc123xyz456abc789xyz000abc123xyz456abc789xyz000abc123');