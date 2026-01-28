CREATE DATABASE student_enrollment;

USE student_enrollment;

CREATE TABLE student_enrollment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    year INT NOT NULL
);
