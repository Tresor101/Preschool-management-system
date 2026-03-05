-- Hostinger-compatible schema (MySQL 8 / MariaDB) aligned with:
-- - registration-form.html
-- - student-id-entry.html
-- - parent-dashboard.html (parent can have multiple children)
-- - student-dashboard.html

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS parents (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    occupation VARCHAR(120) NOT NULL,
    address TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_parents_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS students (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

    -- IDs from form (must be equal, and non-editable in UI)
    student_id VARCHAR(30) NOT NULL,
    admission_no VARCHAR(30) NOT NULL,

    -- Student basic information
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100),
    last_name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    date_of_birth DATE NOT NULL,
    place_of_birth VARCHAR(150) NOT NULL,
    nationality VARCHAR(100) NOT NULL,

    -- Uploaded photo metadata
    photo_filename VARCHAR(255) NOT NULL,
    photo_mime_type VARCHAR(100),
    photo_storage_path TEXT NOT NULL,

    -- Contact information
    home_address TEXT NOT NULL,
    city_commune VARCHAR(120) NOT NULL,
    province VARCHAR(120) NOT NULL,
    country VARCHAR(120) NOT NULL,
    student_email VARCHAR(255),

    -- Academic information
    admission_date DATE NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    class_grade VARCHAR(50) NOT NULL,
    section VARCHAR(50),
    previous_school VARCHAR(200) NOT NULL,
    last_grade_completed VARCHAR(80) NOT NULL,

    -- Emergency information
    emergency_contact_name VARCHAR(150) NOT NULL,
    emergency_contact_phone VARCHAR(30) NOT NULL,
    medical_conditions TEXT,
    allergies TEXT,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uq_students_student_id (student_id),
    UNIQUE KEY uq_students_admission_no (admission_no),
    KEY idx_students_class_grade (class_grade)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_parent_links (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    parent_id BIGINT UNSIGNED NOT NULL,
    relationship_to_student VARCHAR(80) NOT NULL,
    is_primary TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_student_parent (student_id, parent_id),
    KEY idx_student_parent_links_student (student_id),
    KEY idx_student_parent_links_parent (parent_id),
    CONSTRAINT fk_student_parent_links_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_student_parent_links_parent FOREIGN KEY (parent_id) REFERENCES parents(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS subjects (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    code VARCHAR(30),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_subjects_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_subject_results (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    subject_id BIGINT UNSIGNED NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    term_label VARCHAR(30),
    score DECIMAL(5,2) NOT NULL,
    grade VARCHAR(10) NOT NULL,
    remark VARCHAR(50),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_student_subject_term (student_id, subject_id, academic_year, term_label),
    KEY idx_results_student_year (student_id, academic_year),
    CONSTRAINT fk_results_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_results_subject FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT chk_results_score CHECK (score >= 0 AND score <= 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_attendance_summaries (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    term_label VARCHAR(30),
    present_days INT NOT NULL,
    total_days INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_attendance_summary (student_id, academic_year, term_label),
    KEY idx_attendance_student_year (student_id, academic_year),
    CONSTRAINT fk_attendance_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT chk_attendance_days CHECK (present_days >= 0 AND total_days > 0 AND present_days <= total_days)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_fee_balances (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    academic_year VARCHAR(20) NOT NULL,
    balance_amount DECIMAL(12,2) NOT NULL DEFAULT 0,
    currency_code CHAR(3) NOT NULL DEFAULT 'USD',
    due_date DATE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_fee_balance (student_id, academic_year),
    KEY idx_fees_student_year (student_id, academic_year),
    CONSTRAINT fk_fees_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT chk_balance_amount CHECK (balance_amount >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS class_schedules (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    day_of_week TINYINT UNSIGNED NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    subject_id BIGINT UNSIGNED,
    room_label VARCHAR(50),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_schedule_student_day (student_id, day_of_week),
    CONSTRAINT fk_schedule_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_schedule_subject FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT chk_schedule_day CHECK (day_of_week BETWEEN 1 AND 7),
    CONSTRAINT chk_schedule_time CHECK (end_time > start_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS student_assignments (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(200) NOT NULL,
    due_date DATE NOT NULL,
    status ENUM('pending', 'submitted', 'late') NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_assignments_student_status (student_id, status),
    CONSTRAINT fk_assignments_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS announcements (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    audience ENUM('student', 'parent', 'both') NOT NULL,
    publish_date DATE NOT NULL DEFAULT (CURRENT_DATE),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_announcements_audience_date (audience, publish_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Business-rule triggers for Hostinger MySQL/MariaDB
DROP TRIGGER IF EXISTS trg_students_validate_before_insert;
DROP TRIGGER IF EXISTS trg_students_validate_before_update;

DELIMITER $$

CREATE TRIGGER trg_students_validate_before_insert
BEFORE INSERT ON students
FOR EACH ROW
BEGIN
    IF NEW.student_id <> NEW.admission_no THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'student_id and admission_no must be the same';
    END IF;

    IF NEW.student_id NOT REGEXP '^STU-[0-9]{8}-[0-9]{4}$' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'student_id must match format STU-YYYYMMDD-####';
    END IF;

    IF NEW.date_of_birth > DATE_SUB(CURDATE(), INTERVAL 2 YEAR)
       OR NEW.date_of_birth < DATE_SUB(CURDATE(), INTERVAL 23 YEAR) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Student age must be between 2 and 23 years';
    END IF;
END$$

CREATE TRIGGER trg_students_validate_before_update
BEFORE UPDATE ON students
FOR EACH ROW
BEGIN
    IF NEW.student_id <> NEW.admission_no THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'student_id and admission_no must be the same';
    END IF;

    IF NEW.student_id NOT REGEXP '^STU-[0-9]{8}-[0-9]{4}$' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'student_id must match format STU-YYYYMMDD-####';
    END IF;

    IF NEW.date_of_birth > DATE_SUB(CURDATE(), INTERVAL 2 YEAR)
       OR NEW.date_of_birth < DATE_SUB(CURDATE(), INTERVAL 23 YEAR) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Student age must be between 2 and 23 years';
    END IF;
END$$

DELIMITER ;

-- Useful query examples:
-- 1) Student lookup for "Check Result" page
-- SELECT id, student_id, first_name, last_name, class_grade, academic_year
-- FROM students
-- WHERE student_id = ?;

-- 2) Parent dashboard children list
-- SELECT s.id, s.student_id, s.first_name, s.last_name, s.class_grade, s.academic_year
-- FROM students s
-- JOIN student_parent_links spl ON spl.student_id = s.id
-- JOIN parents p ON p.id = spl.parent_id
-- WHERE p.email = ?
-- ORDER BY s.first_name, s.last_name;

-- 3) Student dashboard results
-- SELECT sub.name AS subject, r.score, r.grade, r.remark
-- FROM student_subject_results r
-- JOIN subjects sub ON sub.id = r.subject_id
-- JOIN students s ON s.id = r.student_id
-- WHERE s.student_id = ? AND r.academic_year = ?
-- ORDER BY sub.name;
