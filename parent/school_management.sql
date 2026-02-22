-- Table for messages and notifications (for teachers, students, grades, or all)
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_type ENUM('student', 'grade', 'teacher', 'all') NOT NULL,
    student_id INT NULL,
    grade VARCHAR(50) NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    sender_id INT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
);
-- Ensure messages table exists for notifications and messaging
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_type ENUM('student', 'grade', 'teacher', 'all') NOT NULL,
    student_id INT NULL,
    grade VARCHAR(50) NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    sender_id INT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
);
-- School Management Database Schema

-- Unified Users table for all staff/admin/teacher registrations
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    gender VARCHAR(10),
    dob DATE,
    email VARCHAR(100),
    phone VARCHAR(20),
    id_passport_number VARCHAR(50),
    role VARCHAR(50), -- e.g. 'admin', 'teacher', 'staff'
    class_level VARCHAR(50),
    department VARCHAR(50),
    street_address VARCHAR(255),
    city VARCHAR(50),
    state VARCHAR(50),
    country VARCHAR(50),
    emergency_contact_name VARCHAR(100),
    emergency_contact_relationship VARCHAR(50),
    emergency_contact_phone VARCHAR(20),
    notes TEXT
);

-- Classes table (unchanged)
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    level VARCHAR(30) NOT NULL,
    section VARCHAR(30),
    head_teacher_id INT,
    room VARCHAR(30),
    schedule VARCHAR(100),
    FOREIGN KEY (head_teacher_id) REFERENCES users(id)
);

-- Class-Teacher assignment (many-to-many)
CREATE TABLE class_teachers (
    class_id INT,
    teacher_id INT,
    PRIMARY KEY (class_id, teacher_id),
    FOREIGN KEY (class_id) REFERENCES classes(id),
    FOREIGN KEY (teacher_id) REFERENCES users(id)
);

-- Updated Students table to match form inputs
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    dob DATE,
    gender VARCHAR(10),
    level VARCHAR(50),
    class_grade VARCHAR(50),
    guardian1_id_number VARCHAR(50),
    guardian1_name VARCHAR(100),
    guardian1_email VARCHAR(100),
    guardian1_phone VARCHAR(20),
    guardian1_address VARCHAR(255),
    guardian2_id_number VARCHAR(50),
    guardian2_name VARCHAR(100),
    guardian2_email VARCHAR(100),
    guardian2_phone VARCHAR(20),
    guardian2_address VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS fees_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(10) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    reference_no VARCHAR(100) NOT NULL UNIQUE,
    remarks VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Messages / Notifications table
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipient_type ENUM('student', 'grade', 'all') NOT NULL,
    student_id INT NULL,
    grade VARCHAR(50) NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    sender_id INT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
);