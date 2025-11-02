// User Registration JavaScript
// Auto-generate IDs
function generateStudentId() {
    // Use the shared database to get proper STU#### format
    if (typeof window.db !== 'undefined' && window.db.generateStudentId) {
        return window.db.generateStudentId();
    }
    // Fallback to manual generation
    const existingStudents = JSON.parse(localStorage.getItem('students') || '{}');
    const studentNumbers = Object.keys(existingStudents)
        .filter(id => id.startsWith('STU'))
        .map(id => parseInt(id.substring(3)))
        .filter(num => !isNaN(num));
    
    const nextNumber = studentNumbers.length > 0 ? Math.max(...studentNumbers) + 1 : 1;
    return `STU${nextNumber.toString().padStart(4, '0')}`;
}

function generateTeacherEmployeeId() {
    // Use the shared database to get proper T### format
    if (typeof window.db !== 'undefined' && window.db.generateTeacherEmployeeId) {
        return window.db.generateTeacherEmployeeId();
    }
    // Fallback to manual generation
    const existingTeachers = JSON.parse(localStorage.getItem('teachers') || '{}');
    const teacherNumbers = Object.keys(existingTeachers)
        .filter(id => id.startsWith('T'))
        .map(id => parseInt(id.substring(1)))
        .filter(num => !isNaN(num));
    
    const nextNumber = teacherNumbers.length > 0 ? Math.max(...teacherNumbers) + 1 : 1;
    return `T${nextNumber.toString().padStart(3, '0')}`;
}

function generateAdminEmployeeId() {
    // Use the shared database to get proper AD## format
    if (typeof window.db !== 'undefined' && window.db.generateAdminEmployeeId) {
        return window.db.generateAdminEmployeeId();
    }
    // Fallback to manual generation
    const existingAdmins = JSON.parse(localStorage.getItem('admins') || '{}');
    const adminNumbers = Object.keys(existingAdmins)
        .filter(id => id.startsWith('AD'))
        .map(id => parseInt(id.substring(2)))
        .filter(num => !isNaN(num));
    
    const nextNumber = adminNumbers.length > 0 ? Math.max(...adminNumbers) + 1 : 1;
    return `AD${nextNumber.toString().padStart(2, '0')}`;
}

// Show notification
function showNotification(title, message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <h4>${title}</h4>
            <p>${message}</p>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">×</button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Clear form
function clearForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset();
        // Reset auto-generated IDs
        if (formId === 'studentForm') {
            document.getElementById('studentID').value = generateStudentId();
        } else if (formId === 'staffForm') {
            document.getElementById('staffEmployeeID').value = generateTeacherEmployeeId();
        } else if (formId === 'adminForm') {
            document.getElementById('adminEmployeeID').value = generateAdminEmployeeId();
        }
    }
}

// Clear all forms
function clearAllForms() {
    if (confirm('Are you sure you want to clear all forms? This will reset all unsaved data.')) {
        clearForm('studentForm');
        clearForm('staffForm');
        clearForm('adminForm');
        showNotification('Forms Cleared', 'All registration forms have been reset.', 'info');
    }
}

// Update statistics
function updateStats() {
    if (typeof window.db !== 'undefined') {
        const students = window.db.getStudents();
        const teachers = window.db.getTeachers();
        const admins = window.db.getAdmins();
        
        const studentCount = students.length;
        const staffCount = teachers.length;
        const adminCount = admins.length;
        const totalCount = studentCount + staffCount + adminCount;
        
        // Update the display elements
        const studentEl = document.getElementById('totalStudents');
        const staffEl = document.getElementById('totalStaff');
        const adminEl = document.getElementById('totalAdmins');
        const totalEl = document.getElementById('totalUsers');
        
        if (studentEl) studentEl.textContent = studentCount;
        if (staffEl) staffEl.textContent = staffCount;
        if (adminEl) adminEl.textContent = adminCount;
        if (totalEl) totalEl.textContent = totalCount;
    }
}

// Export all data
function exportAllData() {
    if (typeof window.db !== 'undefined') {
        try {
            const data = window.db.exportData();
            const blob = new Blob([data], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `school_database_backup_${new Date().toISOString().split('T')[0]}.json`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            showNotification('Export Complete', 'Database exported successfully!', 'success');
        } catch (error) {
            console.error('Export failed:', error);
            showNotification('Export Failed', error.message, 'error');
        }
    }
}

// Phone validation
function validatePhone(phone) {
    const re = /^[\+]?[1-9][\d]{0,15}$/;
    return re.test(phone.replace(/[\s\-\(\)]/g, ''));
}

// Validate form data
function validateStudentForm(formData) {
    const errors = [];
    
    if (!formData.firstName || formData.firstName.trim().length < 2) {
        errors.push('First name must be at least 2 characters long');
    }
    
    if (!formData.lastName || formData.lastName.trim().length < 2) {
        errors.push('Last name must be at least 2 characters long');
    }
    
    if (!formData.dateOfBirth) {
        errors.push('Date of birth is required');
    } else {
        const age = new Date().getFullYear() - new Date(formData.dateOfBirth).getFullYear();
        if (age < 1 || age > 10) {
            errors.push('Student age must be between 1 and 10 years');
        }
    }
    
    if (!formData.parentPhone || !validatePhone(formData.parentPhone)) {
        errors.push('Valid parent phone number is required');
    }
    
    if (!formData.parentPhone || !validatePhone(formData.parentPhone)) {
        errors.push('Valid parent phone number is required');
    }
    
    return errors;
}

function validateStaffForm(formData) {
    const errors = [];
    
    if (!formData.firstName || formData.firstName.trim().length < 2) {
        errors.push('First name must be at least 2 characters long');
    }
    
    if (!formData.lastName || formData.lastName.trim().length < 2) {
        errors.push('Last name must be at least 2 characters long');
    }
    
    if (!formData.phone || !validatePhone(formData.phone)) {
        errors.push('Valid phone number is required');
    }
    
    if (!formData.salary || parseFloat(formData.salary) < 0) {
        errors.push('Valid salary amount is required');
    }
    
    if (!formData.startDate) {
        errors.push('Start date is required');
    }
    
    return errors;
}

function validateAdminForm(formData) {
    const errors = [];
    
    if (!formData.firstName || formData.firstName.trim().length < 2) {
        errors.push('First name must be at least 2 characters long');
    }
    
    if (!formData.lastName || formData.lastName.trim().length < 2) {
        errors.push('Last name must be at least 2 characters long');
    }
    
    if (!formData.phone || !validatePhone(formData.phone)) {
        errors.push('Valid phone number is required');
    }
    
    if (!formData.username || formData.username.trim().length < 3) {
        errors.push('Username must be at least 3 characters long');
    }
    
    if (!formData.password || formData.password.length < 6) {
        errors.push('Password must be at least 6 characters long');
    }
    
    return errors;
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Set up tab functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remove active class from all tabs and content
            document.querySelectorAll('.tab-btn').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            const tabContent = document.getElementById(`${tabName}-tab`);
            if (tabContent) tabContent.classList.add('active');
        });
    });

    // Generate initial IDs
    document.getElementById('studentID').value = generateStudentId();
    document.getElementById('staffEmployeeID').value = generateTeacherEmployeeId();
    document.getElementById('adminEmployeeID').value = generateAdminEmployeeId();

    // Update initial statistics
    updateStats();

    // Form submissions
    document.getElementById('studentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const studentData = Object.fromEntries(formData);
        
        // Validate form data
        const errors = validateStudentForm(studentData);
        if (errors.length > 0) {
            showNotification('Validation Error', errors.join('\n'), 'error');
            return;
        }
        
        const studentId = studentData.studentId || document.getElementById('studentID').value;
        
        const studentDataForDb = {
            studentId: studentId,
            firstName: studentData.firstName.trim(),
            lastName: studentData.lastName.trim(),
            dateOfBirth: studentData.dateOfBirth,
            gender: studentData.gender,
            class: studentData.class,
            parentName: studentData.parentName.trim(),
            parentPhone: studentData.parentPhone.trim(),
            parentPhone: studentData.parentPhone.trim(),
            address: studentData.address.trim(),
            medicalInfo: studentData.medicalInfo.trim() || 'None',
            status: 'active'
        };
        
        const result = window.db.addStudent(studentDataForDb);
        
        if (result.success) {
            showNotification('✅ Student Registered', `${studentData.firstName} ${studentData.lastName} registered successfully`, 'success');
            clearForm('studentForm');
            updateStats();
        } else {
            showNotification('❌ Registration Failed', result.error, 'error');
        }
    });

    document.getElementById('staffForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const staffData = Object.fromEntries(formData);
        
        // Validate form data
        const errors = validateStaffForm(staffData);
        if (errors.length > 0) {
            showNotification('Validation Error', errors.join('\n'), 'error');
            return;
        }
        
        const employeeId = staffData.employeeId || document.getElementById('staffEmployeeID').value;
        
        const staffDataForDb = {
            employeeId: employeeId,
            firstName: staffData.firstName.trim(),
            lastName: staffData.lastName.trim(),
            phone: staffData.phone.trim(),
            position: staffData.position,
            department: staffData.department,
            startDate: staffData.startDate,
            salary: parseFloat(staffData.salary) || 0,
            qualification: staffData.qualification.trim() || 'Not specified',
            address: staffData.address.trim(),
            experience: staffData.experience.trim() || 'None',
            status: 'active'
        };
        
        const result = window.db.addTeacher(staffDataForDb);
        
        if (result.success) {
            showNotification('✅ Staff Registered', `${staffData.firstName} ${staffData.lastName} registered successfully`, 'success');
            clearForm('staffForm');
            updateStats();
        } else {
            showNotification('❌ Registration Failed', result.error, 'error');
        }
    });

    document.getElementById('adminForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        const permissions = [];
        document.querySelectorAll('input[name="permissions"]:checked').forEach(checkbox => {
            permissions.push(checkbox.value);
        });
        
        const adminData = Object.fromEntries(formData);
        
        // Validate form data
        const errors = validateAdminForm(adminData);
        if (errors.length > 0) {
            showNotification('Validation Error', errors.join('\n'), 'error');
            return;
        }
        
        if (permissions.length === 0) {
            showNotification('Validation Error', 'At least one permission must be selected', 'error');
            return;
        }
        
        const employeeId = adminData.employeeId || document.getElementById('adminEmployeeID').value;
        
        const adminDataForDb = {
            employeeId: employeeId,
            firstName: adminData.firstName.trim(),
            lastName: adminData.lastName.trim(),
            phone: adminData.phone.trim(),
            phone: adminData.phone.trim(),
            role: adminData.role,
            accessLevel: adminData.accessLevel,
            username: adminData.username.trim().toLowerCase(),
            password: adminData.password, // In production, this should be hashed
            permissions: permissions,
            address: adminData.address.trim(),
            qualification: adminData.qualification.trim() || 'Not specified',
            status: 'active'
        };
        
        const result = window.db.addAdmin(adminDataForDb);
        
        if (result.success) {
            showNotification('✅ Admin Registered', `${adminData.firstName} ${adminData.lastName} registered successfully`, 'success');
            clearForm('adminForm');
            updateStats();
        } else {
            showNotification('❌ Registration Failed', result.error, 'error');
        }
    });

    // Refresh statistics every 30 seconds
    setInterval(updateStats, 30000);

    console.log('🎯 User Registration System initialized!');
});
