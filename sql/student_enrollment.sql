CREATE DATABASE IF NOT EXISTS student_enrollment;
USE student_enrollment;

-- Drop tables if they already exist to avoid errors
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS students;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) DEFAULT NULL
);

-- Admin account: username 'ansu', password 'ansu123'
INSERT INTO admins (username, password)
VALUES ('ansu', '$2y$10$fbDeJwyO5V9dnneNm3n1GeTOST35D9CcJprIyvNS11.SYqAcP/Tyq');
