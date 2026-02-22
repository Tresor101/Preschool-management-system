CREATE TABLE staff (
    staff_id VARCHAR(8) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    id_number VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    emergency_name VARCHAR(100) NOT NULL,
    emergency_relation VARCHAR(50) NOT NULL,
    emergency_phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    notes TEXT,
    failed_logins INT DEFAULT 0,
    account_locked BOOLEAN DEFAULT 0,
    lock_time DATETIME NULL
);

-- Permissions table
CREATE TABLE permissions (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255)
);

-- Role-Permission mapping table
CREATE TABLE role_permissions (
    role VARCHAR(50) NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role, permission_id),
    FOREIGN KEY (role) REFERENCES staff(role),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
);

-- User-Permission override table (optional)
CREATE TABLE user_permissions (
    staff_id VARCHAR(8) NOT NULL,
    permission_id INT NOT NULL,
    allow BOOLEAN NOT NULL,
    PRIMARY KEY (staff_id, permission_id),
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
);
