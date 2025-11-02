class SchoolManagementDatabase {
    constructor() {
        this.dbName = 'school_management.db';
        this.initDatabase();
    }

    async initDatabase() {
        try {
            // Initialize SQLite database
            if (typeof window !== 'undefined' && window.SQL) {
                // Use SQL.js if available
                this.db = new window.SQL.Database();
            } else {
                // Fallback to in-memory storage for now
                this.db = null;
                this.storage = {
                    users: [],
                    students: [],
                    teachers: [],
                    parents: [],
                    classes: [],
                    grades: []
                };
            }
            
            await this.createTables();
            await this.seedInitialData();
            console.log('Database initialized successfully');
        } catch (error) {
            console.error('Database initialization error:', error);
        }
    }

    async createTables() {
        if (this.db) {
            // Create tables using SQL.js
            this.db.run(`
                CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id TEXT UNIQUE NOT NULL,
                    name TEXT NOT NULL,
                    email TEXT,
                    phone TEXT,
                    role TEXT NOT NULL,
                    password TEXT,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);

            this.db.run(`
                CREATE TABLE IF NOT EXISTS students (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    student_id TEXT UNIQUE NOT NULL,
                    name TEXT NOT NULL,
                    email TEXT,
                    phone TEXT,
                    class_id TEXT,
                    parent_id TEXT,
                    enrollment_date DATE,
                    status TEXT DEFAULT 'active',
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);

            this.db.run(`
                CREATE TABLE IF NOT EXISTS teachers (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    teacher_id TEXT UNIQUE NOT NULL,
                    name TEXT NOT NULL,
                    email TEXT,
                    phone TEXT,
                    subject TEXT,
                    department TEXT,
                    hire_date DATE,
                    status TEXT DEFAULT 'active',
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);

            this.db.run(`
                CREATE TABLE IF NOT EXISTS parents (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    parent_id TEXT UNIQUE NOT NULL,
                    name TEXT NOT NULL,
                    email TEXT,
                    phone TEXT,
                    address TEXT,
                    occupation TEXT,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);

            this.db.run(`
                CREATE TABLE IF NOT EXISTS classes (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    class_id TEXT UNIQUE NOT NULL,
                    class_name TEXT NOT NULL,
                    grade_level TEXT,
                    teacher_id TEXT,
                    capacity INTEGER DEFAULT 30,
                    academic_year TEXT,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);

            this.db.run(`
                CREATE TABLE IF NOT EXISTS grades (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    grade_id TEXT UNIQUE NOT NULL,
                    student_id TEXT NOT NULL,
                    subject TEXT NOT NULL,
                    grade_value REAL,
                    max_grade REAL DEFAULT 100,
                    term TEXT,
                    academic_year TEXT,
                    teacher_id TEXT,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )
            `);
        }
    }

    async seedInitialData() {
        // Create default users for each role
        const defaultUsers = [
            {
                user_id: 'SUPER001',
                name: 'System Administrator',
                email: 'admin@school.edu',
                role: 'super_admin',
                password: 'admin123'
            },
            {
                user_id: 'DIR001',
                name: 'School Director',
                email: 'director@school.edu',
                role: 'director',
                password: 'director123'
            },
            {
                user_id: 'TEACH001',
                name: 'John Smith',
                email: 'j.smith@school.edu',
                role: 'teacher',
                password: 'teacher123'
            },
            {
                user_id: 'PAR001',
                name: 'Parent Johnson',
                email: 'parent@email.com',
                role: 'parent',
                password: 'parent123'
            }
        ];

        for (const user of defaultUsers) {
            await this.registerUser(user);
        }
    }

    generateId(prefix = '') {
        const timestamp = Date.now().toString(36);
        const random = Math.random().toString(36).substr(2, 5);
        return `${prefix}${timestamp}${random}`.toUpperCase();
    }

    async registerUser(userData) {
        try {
            const userId = userData.user_id || this.generateId('USER');
            
            if (this.db) {
                // Check if user exists
                const existingUser = this.db.exec(`SELECT * FROM users WHERE user_id = '${userId}'`);
                if (existingUser.length > 0) {
                    return { success: false, message: 'User ID already exists' };
                }

                // Insert new user
                this.db.run(`
                    INSERT INTO users (user_id, name, email, phone, role, password)
                    VALUES (?, ?, ?, ?, ?, ?)
                `, [userId, userData.name, userData.email || '', userData.phone || '', userData.role, userData.password || '']);
                
                return { success: true, message: 'User registered successfully', userId };
            } else {
                // Fallback storage
                const existingUser = this.storage.users.find(u => u.user_id === userId);
                if (existingUser) {
                    return { success: false, message: 'User ID already exists' };
                }

                this.storage.users.push({
                    ...userData,
                    user_id: userId,
                    created_at: new Date().toISOString()
                });
                
                return { success: true, message: 'User registered successfully', userId };
            }
        } catch (error) {
            console.error('Registration error:', error);
            return { success: false, message: 'Registration failed' };
        }
    }

    async authenticateUser(userId, password) {
        try {
            if (this.db) {
                const result = this.db.exec(`
                    SELECT * FROM users 
                    WHERE user_id = '${userId}' AND password = '${password}'
                `);
                
                if (result.length > 0 && result[0].values.length > 0) {
                    const userRow = result[0].values[0];
                    const columns = result[0].columns;
                    const user = {};
                    columns.forEach((col, index) => {
                        user[col] = userRow[index];
                    });
                    return { success: true, user };
                }
            } else {
                // Fallback storage
                const user = this.storage.users.find(u => 
                    u.user_id === userId && u.password === password
                );
                
                if (user) {
                    return { success: true, user };
                }
            }
            
            return { success: false, message: 'Invalid credentials' };
        } catch (error) {
            console.error('Authentication error:', error);
            return { success: false, message: 'Authentication failed' };
        }
    }

    async addStudent(studentData) {
        try {
            const studentId = this.generateId('STU');
            
            if (this.db) {
                this.db.run(`
                    INSERT INTO students (student_id, name, email, phone, class_id, parent_id, enrollment_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                `, [
                    studentId,
                    studentData.name,
                    studentData.email || '',
                    studentData.phone || '',
                    studentData.class_id || '',
                    studentData.parent_id || '',
                    studentData.enrollment_date || new Date().toISOString().split('T')[0]
                ]);
            } else {
                this.storage.students.push({
                    ...studentData,
                    student_id: studentId,
                    enrollment_date: studentData.enrollment_date || new Date().toISOString().split('T')[0],
                    status: 'active',
                    created_at: new Date().toISOString()
                });
            }
            
            return { success: true, message: 'Student added successfully', studentId };
        } catch (error) {
            console.error('Add student error:', error);
            return { success: false, message: 'Failed to add student' };
        }
    }

    async getStudents(filters = {}) {
        try {
            if (this.db) {
                let query = 'SELECT * FROM students WHERE 1=1';
                if (filters.class_id) {
                    query += ` AND class_id = '${filters.class_id}'`;
                }
                if (filters.status) {
                    query += ` AND status = '${filters.status}'`;
                }
                query += ' ORDER BY name';
                
                const result = this.db.exec(query);
                if (result.length > 0) {
                    const columns = result[0].columns;
                    return result[0].values.map(row => {
                        const student = {};
                        columns.forEach((col, index) => {
                            student[col] = row[index];
                        });
                        return student;
                    });
                }
                return [];
            } else {
                let students = this.storage.students;
                if (filters.class_id) {
                    students = students.filter(s => s.class_id === filters.class_id);
                }
                if (filters.status) {
                    students = students.filter(s => s.status === filters.status);
                }
                return students.sort((a, b) => a.name.localeCompare(b.name));
            }
        } catch (error) {
            console.error('Get students error:', error);
            return [];
        }
    }

    async addTeacher(teacherData) {
        try {
            const teacherId = this.generateId('TEACH');
            
            if (this.db) {
                this.db.run(`
                    INSERT INTO teachers (teacher_id, name, email, phone, subject, department, hire_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                `, [
                    teacherId,
                    teacherData.name,
                    teacherData.email || '',
                    teacherData.phone || '',
                    teacherData.subject || '',
                    teacherData.department || '',
                    teacherData.hire_date || new Date().toISOString().split('T')[0]
                ]);
            } else {
                this.storage.teachers.push({
                    ...teacherData,
                    teacher_id: teacherId,
                    hire_date: teacherData.hire_date || new Date().toISOString().split('T')[0],
                    status: 'active',
                    created_at: new Date().toISOString()
                });
            }
            
            return { success: true, message: 'Teacher added successfully', teacherId };
        } catch (error) {
            console.error('Add teacher error:', error);
            return { success: false, message: 'Failed to add teacher' };
        }
    }

    async getTeachers(filters = {}) {
        try {
            if (this.db) {
                let query = 'SELECT * FROM teachers WHERE 1=1';
                if (filters.department) {
                    query += ` AND department = '${filters.department}'`;
                }
                if (filters.status) {
                    query += ` AND status = '${filters.status}'`;
                }
                query += ' ORDER BY name';
                
                const result = this.db.exec(query);
                if (result.length > 0) {
                    const columns = result[0].columns;
                    return result[0].values.map(row => {
                        const teacher = {};
                        columns.forEach((col, index) => {
                            teacher[col] = row[index];
                        });
                        return teacher;
                    });
                }
                return [];
            } else {
                let teachers = this.storage.teachers;
                if (filters.department) {
                    teachers = teachers.filter(t => t.department === filters.department);
                }
                if (filters.status) {
                    teachers = teachers.filter(t => t.status === filters.status);
                }
                return teachers.sort((a, b) => a.name.localeCompare(b.name));
            }
        } catch (error) {
            console.error('Get teachers error:', error);
            return [];
        }
    }

    async addGrade(gradeData) {
        try {
            const gradeId = this.generateId('GRD');
            
            if (this.db) {
                this.db.run(`
                    INSERT INTO grades (grade_id, student_id, subject, grade_value, max_grade, term, academic_year, teacher_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                `, [
                    gradeId,
                    gradeData.student_id,
                    gradeData.subject,
                    gradeData.grade_value,
                    gradeData.max_grade || 100,
                    gradeData.term || 'Term 1',
                    gradeData.academic_year || new Date().getFullYear(),
                    gradeData.teacher_id || ''
                ]);
            } else {
                this.storage.grades.push({
                    ...gradeData,
                    grade_id: gradeId,
                    max_grade: gradeData.max_grade || 100,
                    term: gradeData.term || 'Term 1',
                    academic_year: gradeData.academic_year || new Date().getFullYear(),
                    created_at: new Date().toISOString()
                });
            }
            
            return { success: true, message: 'Grade added successfully', gradeId };
        } catch (error) {
            console.error('Add grade error:', error);
            return { success: false, message: 'Failed to add grade' };
        }
    }

    async getGrades(filters = {}) {
        try {
            if (this.db) {
                let query = 'SELECT * FROM grades WHERE 1=1';
                if (filters.student_id) {
                    query += ` AND student_id = '${filters.student_id}'`;
                }
                if (filters.subject) {
                    query += ` AND subject = '${filters.subject}'`;
                }
                if (filters.term) {
                    query += ` AND term = '${filters.term}'`;
                }
                if (filters.academic_year) {
                    query += ` AND academic_year = '${filters.academic_year}'`;
                }
                query += ' ORDER BY created_at DESC';
                
                const result = this.db.exec(query);
                if (result.length > 0) {
                    const columns = result[0].columns;
                    return result[0].values.map(row => {
                        const grade = {};
                        columns.forEach((col, index) => {
                            grade[col] = row[index];
                        });
                        return grade;
                    });
                }
                return [];
            } else {
                let grades = this.storage.grades;
                if (filters.student_id) {
                    grades = grades.filter(g => g.student_id === filters.student_id);
                }
                if (filters.subject) {
                    grades = grades.filter(g => g.subject === filters.subject);
                }
                if (filters.term) {
                    grades = grades.filter(g => g.term === filters.term);
                }
                if (filters.academic_year) {
                    grades = grades.filter(g => g.academic_year == filters.academic_year);
                }
                return grades.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            }
        } catch (error) {
            console.error('Get grades error:', error);
            return [];
        }
    }

    async exportData() {
        try {
            if (this.db) {
                const data = this.db.export();
                return new Uint8Array(data);
            } else {
                return JSON.stringify(this.storage, null, 2);
            }
        } catch (error) {
            console.error('Export error:', error);
            return null;
        }
    }

    async importData(data) {
        try {
            if (this.db && data instanceof Uint8Array) {
                this.db = new window.SQL.Database(data);
                return true;
            } else if (typeof data === 'string') {
                this.storage = JSON.parse(data);
                return true;
            }
            return false;
        } catch (error) {
            console.error('Import error:', error);
            return false;
        }
    }
}

// Initialize database instance
const database = new SchoolManagementDatabase();

// Export for use in other files
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SchoolManagementDatabase;
}