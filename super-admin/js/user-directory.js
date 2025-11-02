// User Directory JavaScript
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

// Calculate age from date of birth
function calculateAge(dateOfBirth) {
    const today = new Date();
    const birthDate = new Date(dateOfBirth);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age;
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Format date
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Update statistics
function updateStats() {
    if (typeof schoolDB !== 'undefined') {
        const students = schoolDB.getStudents();
        const teachers = schoolDB.getTeachers(); 
        const admins = schoolDB.getAdmins();
        
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

// Load and display students
function loadStudents() {
    const students = schoolDB ? schoolDB.getStudents() : [];
    const tbody = document.getElementById('students-tbody');
    const noData = document.getElementById('no-students');
    
    if (students.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    students.forEach(student => {
        const age = calculateAge(student.dateOfBirth);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.studentId}</td>
            <td>${student.firstName} ${student.lastName}</td>
            <td>${student.class}</td>
            <td>${age} years</td>
            <td>${student.parentName}</td>
            <td>${student.parentEmail}</td>
            <td>${student.parentPhone}</td>
            <td><span class="status-badge status-${student.status}">${student.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('students', '${student.studentId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('students', '${student.studentId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('students', '${student.studentId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Load and display staff
function loadStaff() {
    const staff = schoolDB ? schoolDB.getTeachers() : [];
    const tbody = document.getElementById('staff-tbody');
    const noData = document.getElementById('no-staff');
    
    if (staff.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    staff.forEach(member => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${member.employeeId}</td>
            <td>${member.firstName} ${member.lastName}</td>
            <td>${member.position}</td>
            <td>${member.department}</td>
            <td>${member.email}</td>
            <td>${member.phone}</td>
            <td>${formatDate(member.startDate)}</td>
            <td>${formatCurrency(member.salary)}</td>
            <td><span class="status-badge status-${member.status}">${member.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('staff', '${member.employeeId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('staff', '${member.employeeId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('staff', '${member.employeeId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Load and display admins
function loadAdmins() {
    const admins = schoolDB ? schoolDB.getAdmins() : [];
    const tbody = document.getElementById('admins-tbody');
    const noData = document.getElementById('no-admins');
    
    if (admins.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    admins.forEach(admin => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${admin.employeeId}</td>
            <td>${admin.firstName} ${admin.lastName}</td>
            <td>${admin.role}</td>
            <td>${admin.accessLevel}</td>
            <td>${admin.email}</td>
            <td>${admin.phone}</td>
            <td>${admin.username}</td>
            <td><span class="status-badge status-${admin.status}">${admin.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('admins', '${admin.employeeId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('admins', '${admin.employeeId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('admins', '${admin.employeeId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// View user details in modal
function viewUser(collection, id) {
    const data = window.db.getCollection(collection);
    const user = data[id];
    
    if (!user) {
        showNotification('Error', 'User not found', 'error');
        return;
    }
    
    const modal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    
    modalTitle.textContent = `${collection.charAt(0).toUpperCase() + collection.slice(1)} Details`;
    
    let detailsHTML = '<div class="user-detail-grid">';
    
    if (collection === 'students') {
        detailsHTML += `
            <div class="detail-item">
                <div class="detail-label">Student ID</div>
                <div class="detail-value">${user.studentId}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">${user.firstName} ${user.lastName}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date of Birth</div>
                <div class="detail-value">${formatDate(user.dateOfBirth)} (${calculateAge(user.dateOfBirth)} years old)</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Gender</div>
                <div class="detail-value">${user.gender}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Class</div>
                <div class="detail-value">${user.class}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Parent/Guardian</div>
                <div class="detail-value">${user.parentName}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Parent Email</div>
                <div class="detail-value">${user.parentEmail}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Parent Phone</div>
                <div class="detail-value">${user.parentPhone}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value">${user.address}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Medical Information</div>
                <div class="detail-value">${user.medicalInfo}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value"><span class="status-badge status-${user.status}">${user.status}</span></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Registration Date</div>
                <div class="detail-value">${formatDate(user.createdAt)}</div>
            </div>
        `;
    } else if (collection === 'staff') {
        detailsHTML += `
            <div class="detail-item">
                <div class="detail-label">Employee ID</div>
                <div class="detail-value">${user.employeeId}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">${user.firstName} ${user.lastName}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value">${user.email}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Phone</div>
                <div class="detail-value">${user.phone}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Position</div>
                <div class="detail-value">${user.position}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Department</div>
                <div class="detail-value">${user.department}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Start Date</div>
                <div class="detail-value">${formatDate(user.startDate)}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Salary</div>
                <div class="detail-value">${formatCurrency(user.salary)}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Qualification</div>
                <div class="detail-value">${user.qualification}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value">${user.address}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Experience</div>
                <div class="detail-value">${user.experience}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value"><span class="status-badge status-${user.status}">${user.status}</span></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Hire Date</div>
                <div class="detail-value">${formatDate(user.createdAt)}</div>
            </div>
        `;
    } else if (collection === 'admins') {
        detailsHTML += `
            <div class="detail-item">
                <div class="detail-label">Employee ID</div>
                <div class="detail-value">${user.employeeId}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">${user.firstName} ${user.lastName}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value">${user.email}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Phone</div>
                <div class="detail-value">${user.phone}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Role</div>
                <div class="detail-value">${user.role}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Access Level</div>
                <div class="detail-value">${user.accessLevel}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Username</div>
                <div class="detail-value">${user.username}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Permissions</div>
                <div class="detail-value">${user.permissions.join(', ')}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value">${user.address}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Qualification</div>
                <div class="detail-value">${user.qualification}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value"><span class="status-badge status-${user.status}">${user.status}</span></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Registration Date</div>
                <div class="detail-value">${formatDate(user.createdAt)}</div>
            </div>
        `;
    }
    
    detailsHTML += '</div>';
    modalBody.innerHTML = detailsHTML;
    modal.style.display = 'flex';
}

// Close modal
function closeModal() {
    document.getElementById('userModal').style.display = 'none';
}

// Close edit modal
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Edit user dialog
function editUserDialog(collection, id) {
    const data = window.db.getCollection(collection);
    const user = data[id];
    
    if (!user) {
        showNotification('Error', 'User not found', 'error');
        return;
    }
    
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('edit-modal-title');
    const modalBody = document.getElementById('edit-modal-body');
    
    modalTitle.textContent = `Edit ${collection.charAt(0).toUpperCase() + collection.slice(1)}`;
    
    // Store current editing data
    window.currentEdit = { collection, id, user };
    
    let formHTML = '<form id="editUserForm" class="edit-form">';
    
    if (collection === 'students') {
        formHTML += `
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="firstName" value="${user.firstName}" required>
                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="lastName" value="${user.lastName}" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth *</label>
                    <input type="date" name="dateOfBirth" value="${user.dateOfBirth}" required>
                </div>
                <div class="form-group">
                    <label>Gender *</label>
                    <select name="gender" required>
                        <option value="male" ${user.gender === 'male' ? 'selected' : ''}>Male</option>
                        <option value="female" ${user.gender === 'female' ? 'selected' : ''}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Class *</label>
                    <select name="class" required>
                        <option value="nursery" ${user.class === 'nursery' ? 'selected' : ''}>Nursery</option>
                        <option value="pre-k" ${user.class === 'pre-k' ? 'selected' : ''}>Pre-K</option>
                        <option value="kindergarten" ${user.class === 'kindergarten' ? 'selected' : ''}>Kindergarten</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Parent Name *</label>
                    <input type="text" name="parentName" value="${user.parentName}" required>
                </div>
                <div class="form-group">
                    <label>Parent Email *</label>
                    <input type="email" name="parentEmail" value="${user.parentEmail}" required>
                </div>
                <div class="form-group">
                    <label>Parent Phone *</label>
                    <input type="tel" name="parentPhone" value="${user.parentPhone}" required>
                </div>
                <div class="form-group full-width">
                    <label>Address *</label>
                    <textarea name="address" required>${user.address}</textarea>
                </div>
                <div class="form-group full-width">
                    <label>Medical Information</label>
                    <textarea name="medicalInfo">${user.medicalInfo}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" ${user.status === 'active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${user.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                        <option value="suspended" ${user.status === 'suspended' ? 'selected' : ''}>Suspended</option>
                    </select>
                </div>
            </div>
        `;
    } else if (collection === 'staff') {
        formHTML += `
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="firstName" value="${user.firstName}" required>
                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="lastName" value="${user.lastName}" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="${user.email}" required>
                </div>
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="tel" name="phone" value="${user.phone}" required>
                </div>
                <div class="form-group">
                    <label>Position *</label>
                    <select name="position" required>
                        <option value="teacher" ${user.position === 'teacher' ? 'selected' : ''}>Teacher</option>
                        <option value="assistant" ${user.position === 'assistant' ? 'selected' : ''}>Teaching Assistant</option>
                        <option value="nurse" ${user.position === 'nurse' ? 'selected' : ''}>School Nurse</option>
                        <option value="counselor" ${user.position === 'counselor' ? 'selected' : ''}>Counselor</option>
                        <option value="janitor" ${user.position === 'janitor' ? 'selected' : ''}>Janitor</option>
                        <option value="cook" ${user.position === 'cook' ? 'selected' : ''}>Cook</option>
                        <option value="security" ${user.position === 'security' ? 'selected' : ''}>Security</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Department *</label>
                    <select name="department" required>
                        <option value="education" ${user.department === 'education' ? 'selected' : ''}>Education</option>
                        <option value="administration" ${user.department === 'administration' ? 'selected' : ''}>Administration</option>
                        <option value="health" ${user.department === 'health' ? 'selected' : ''}>Health Services</option>
                        <option value="maintenance" ${user.department === 'maintenance' ? 'selected' : ''}>Maintenance</option>
                        <option value="food-service" ${user.department === 'food-service' ? 'selected' : ''}>Food Service</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Start Date *</label>
                    <input type="date" name="startDate" value="${user.startDate}" required>
                </div>
                <div class="form-group">
                    <label>Salary *</label>
                    <input type="number" name="salary" value="${user.salary}" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Qualification</label>
                    <input type="text" name="qualification" value="${user.qualification}">
                </div>
                <div class="form-group full-width">
                    <label>Address *</label>
                    <textarea name="address" required>${user.address}</textarea>
                </div>
                <div class="form-group full-width">
                    <label>Experience</label>
                    <textarea name="experience">${user.experience}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" ${user.status === 'active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${user.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                        <option value="suspended" ${user.status === 'suspended' ? 'selected' : ''}>Suspended</option>
                    </select>
                </div>
            </div>
        `;
    } else if (collection === 'admins') {
        formHTML += `
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="firstName" value="${user.firstName}" required>
                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="lastName" value="${user.lastName}" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="${user.email}" required>
                </div>
                <div class="form-group">
                    <label>Phone *</label>
                    <input type="tel" name="phone" value="${user.phone}" required>
                </div>
                <div class="form-group">
                    <label>Role *</label>
                    <select name="role" required>
                        <option value="principal" ${user.role === 'principal' ? 'selected' : ''}>Principal</option>
                        <option value="vice-principal" ${user.role === 'vice-principal' ? 'selected' : ''}>Vice Principal</option>
                        <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Administrator</option>
                        <option value="coordinator" ${user.role === 'coordinator' ? 'selected' : ''}>Coordinator</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Access Level *</label>
                    <select name="accessLevel" required>
                        <option value="full" ${user.accessLevel === 'full' ? 'selected' : ''}>Full Access</option>
                        <option value="limited" ${user.accessLevel === 'limited' ? 'selected' : ''}>Limited Access</option>
                        <option value="read-only" ${user.accessLevel === 'read-only' ? 'selected' : ''}>Read Only</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" value="${user.username}" required>
                </div>
                <div class="form-group">
                    <label>Qualification</label>
                    <input type="text" name="qualification" value="${user.qualification}">
                </div>
                <div class="form-group full-width">
                    <label>Address *</label>
                    <textarea name="address" required>${user.address}</textarea>
                </div>
                <div class="form-group full-width">
                    <label>Permissions *</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="permissions" value="user-management" ${user.permissions.includes('user-management') ? 'checked' : ''}> User Management</label>
                        <label><input type="checkbox" name="permissions" value="school-settings" ${user.permissions.includes('school-settings') ? 'checked' : ''}> School Settings</label>
                        <label><input type="checkbox" name="permissions" value="reports" ${user.permissions.includes('reports') ? 'checked' : ''}> Reports</label>
                        <label><input type="checkbox" name="permissions" value="reports" ${user.permissions.includes('reports') ? 'checked' : ''}> Reports</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" ${user.status === 'active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${user.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                        <option value="suspended" ${user.status === 'suspended' ? 'selected' : ''}>Suspended</option>
                    </select>
                </div>
            </div>
        `;
    }
    
    formHTML += '</form>';
    modalBody.innerHTML = formHTML;
    modal.style.display = 'flex';
}

// Save user changes
function saveUserChanges() {
    if (!window.currentEdit) return;
    
    const form = document.getElementById('editUserForm');
    const formData = new FormData(form);
    const updatedData = Object.fromEntries(formData);
    
    // Handle permissions for admins
    if (window.currentEdit.collection === 'admins') {
        const permissions = [];
        document.querySelectorAll('input[name="permissions"]:checked').forEach(checkbox => {
            permissions.push(checkbox.value);
        });
        updatedData.permissions = permissions;
    }
    
    // Preserve original data
    const finalData = {
        ...window.currentEdit.user,
        ...updatedData
    };
    
    // Convert salary to number for staff
    if (window.currentEdit.collection === 'staff' && finalData.salary) {
        finalData.salary = parseFloat(finalData.salary);
    }
    
    const result = window.db.save(window.currentEdit.collection, window.currentEdit.id, finalData);
    
    if (result.success) {
        showNotification('✅ User Updated', `${finalData.firstName} ${finalData.lastName} updated successfully`, 'success');
        closeEditModal();
        
        // Refresh the appropriate table
        if (window.currentEdit.collection === 'students') loadStudents();
        else if (window.currentEdit.collection === 'staff') loadStaff();
        else if (window.currentEdit.collection === 'admins') loadAdmins();
        
        updateStats();
    } else {
        showNotification('❌ Update Failed', result.error, 'error');
    }
}

// Delete user with confirmation
function deleteUser(collection, id) {
    const data = window.db.getCollection(collection);
    const user = data[id];
    
    if (!user) {
        showNotification('Error', 'User not found', 'error');
        return;
    }
    
    const userName = `${user.firstName} ${user.lastName}`;
    
    if (confirm(`Are you sure you want to delete ${userName} from ${collection}?\n\nThis action cannot be undone!`)) {
        delete data[id];
        localStorage.setItem(`db_${collection}`, JSON.stringify(data));
        showNotification('✅ User Deleted', `${userName} has been deleted`, 'success');
        
        // Reload the appropriate table
        if (collection === 'students') loadStudents();
        else if (collection === 'staff') loadStaff();
        else if (collection === 'admins') loadAdmins();
        
        updateStats();
    }
}

// Search functionality
function setupSearch() {
    // Students search
    document.getElementById('student-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const classFilter = document.getElementById('student-class-filter').value;
        filterStudents(searchTerm, classFilter);
    });
    
    document.getElementById('student-class-filter').addEventListener('change', function() {
        const searchTerm = document.getElementById('student-search').value.toLowerCase();
        const classFilter = this.value;
        filterStudents(searchTerm, classFilter);
    });
    
    // Staff search
    document.getElementById('staff-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const departmentFilter = document.getElementById('staff-department-filter').value;
        filterStaff(searchTerm, departmentFilter);
    });
    
    document.getElementById('staff-department-filter').addEventListener('change', function() {
        const searchTerm = document.getElementById('staff-search').value.toLowerCase();
        const departmentFilter = this.value;
        filterStaff(searchTerm, departmentFilter);
    });
    
    // Admin search
    document.getElementById('admin-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const roleFilter = document.getElementById('admin-role-filter').value;
        filterAdmins(searchTerm, roleFilter);
    });
    
    document.getElementById('admin-role-filter').addEventListener('change', function() {
        const searchTerm = document.getElementById('admin-search').value.toLowerCase();
        const roleFilter = this.value;
        filterAdmins(searchTerm, roleFilter);
    });
}

// Filter functions
function filterStudents(searchTerm, classFilter) {
    const students = window.db.getCollection('students');
    const tbody = document.getElementById('students-tbody');
    const noData = document.getElementById('no-students');
    
    const filtered = Object.values(students).filter(student => {
        const matchesSearch = !searchTerm || 
            student.firstName.toLowerCase().includes(searchTerm) ||
            student.lastName.toLowerCase().includes(searchTerm) ||
            student.studentId.toLowerCase().includes(searchTerm) ||
            student.parentName.toLowerCase().includes(searchTerm);
        
        const matchesClass = !classFilter || student.class === classFilter;
        
        return matchesSearch && matchesClass;
    });
    
    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    filtered.forEach(student => {
        const age = calculateAge(student.dateOfBirth);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${student.studentId}</td>
            <td>${student.firstName} ${student.lastName}</td>
            <td>${student.class}</td>
            <td>${age} years</td>
            <td>${student.parentName}</td>
            <td>${student.parentEmail}</td>
            <td>${student.parentPhone}</td>
            <td><span class="status-badge status-${student.status}">${student.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('students', '${student.studentId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('students', '${student.studentId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('students', '${student.studentId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function filterStaff(searchTerm, departmentFilter) {
    const staff = window.db.getCollection('staff');
    const tbody = document.getElementById('staff-tbody');
    const noData = document.getElementById('no-staff');
    
    const filtered = Object.values(staff).filter(member => {
        const matchesSearch = !searchTerm || 
            member.firstName.toLowerCase().includes(searchTerm) ||
            member.lastName.toLowerCase().includes(searchTerm) ||
            member.employeeId.toLowerCase().includes(searchTerm) ||
            member.position.toLowerCase().includes(searchTerm) ||
            member.email.toLowerCase().includes(searchTerm);
        
        const matchesDepartment = !departmentFilter || member.department === departmentFilter;
        
        return matchesSearch && matchesDepartment;
    });
    
    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    filtered.forEach(member => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${member.employeeId}</td>
            <td>${member.firstName} ${member.lastName}</td>
            <td>${member.position}</td>
            <td>${member.department}</td>
            <td>${member.email}</td>
            <td>${member.phone}</td>
            <td>${formatDate(member.startDate)}</td>
            <td>${formatCurrency(member.salary)}</td>
            <td><span class="status-badge status-${member.status}">${member.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('staff', '${member.employeeId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('staff', '${member.employeeId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('staff', '${member.employeeId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function filterAdmins(searchTerm, roleFilter) {
    const admins = window.db.getCollection('admins');
    const tbody = document.getElementById('admins-tbody');
    const noData = document.getElementById('no-admins');
    
    const filtered = Object.values(admins).filter(admin => {
        const matchesSearch = !searchTerm || 
            admin.firstName.toLowerCase().includes(searchTerm) ||
            admin.lastName.toLowerCase().includes(searchTerm) ||
            admin.employeeId.toLowerCase().includes(searchTerm) ||
            admin.username.toLowerCase().includes(searchTerm) ||
            admin.email.toLowerCase().includes(searchTerm);
        
        const matchesRole = !roleFilter || admin.role === roleFilter;
        
        return matchesSearch && matchesRole;
    });
    
    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.style.display = 'block';
        return;
    }
    
    noData.style.display = 'none';
    tbody.innerHTML = '';
    
    filtered.forEach(admin => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${admin.employeeId}</td>
            <td>${admin.firstName} ${admin.lastName}</td>
            <td>${admin.role}</td>
            <td>${admin.accessLevel}</td>
            <td>${admin.email}</td>
            <td>${admin.phone}</td>
            <td>${admin.username}</td>
            <td><span class="status-badge status-${admin.status}">${admin.status}</span></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-icon btn-view" onclick="viewUser('admins', '${admin.employeeId}')" title="View Details">
                        <i class='bx bx-show'></i>
                    </button>
                    <button class="btn-icon btn-edit" onclick="editUserDialog('admins', '${admin.employeeId}')" title="Edit">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteUser('admins', '${admin.employeeId}')" title="Delete">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Export functions
function exportStudents() {
    const students = window.db.getCollection('students');
    const data = Object.values(students);
    
    if (data.length === 0) {
        showNotification('No Data', 'No students to export', 'warning');
        return;
    }
    
    const csv = convertToCSV(data, 'students');
    downloadCSV(csv, 'students.csv');
    showNotification('Export Complete', 'Students data exported successfully', 'success');
}

function exportStaff() {
    const staff = window.db.getCollection('staff');
    const data = Object.values(staff);
    
    if (data.length === 0) {
        showNotification('No Data', 'No staff to export', 'warning');
        return;
    }
    
    const csv = convertToCSV(data, 'staff');
    downloadCSV(csv, 'staff.csv');
    showNotification('Export Complete', 'Staff data exported successfully', 'success');
}

function exportAdmins() {
    const admins = window.db.getCollection('admins');
    const data = Object.values(admins);
    
    if (data.length === 0) {
        showNotification('No Data', 'No administrators to export', 'warning');
        return;
    }
    
    const csv = convertToCSV(data, 'admins');
    downloadCSV(csv, 'administrators.csv');
    showNotification('Export Complete', 'Administrators data exported successfully', 'success');
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
            
            showNotification('Export Complete', 'Complete database exported successfully!', 'success');
        } catch (error) {
            console.error('Export failed:', error);
            showNotification('Export Failed', error.message, 'error');
        }
    }
}

// Refresh all tables
function refreshAllTables() {
    loadStudents();
    loadStaff();
    loadAdmins();
    updateStats();
    showNotification('Refreshed', 'All tables have been refreshed', 'info');
}

// Print directory (placeholder)
function printDirectory() {
    window.print();
}

// CSV conversion and download helpers
function convertToCSV(data, type) {
    if (data.length === 0) return '';
    
    let headers = [];
    let rows = [];
    
    if (type === 'students') {
        headers = ['Student ID', 'First Name', 'Last Name', 'Date of Birth', 'Gender', 'Class', 'Parent Name', 'Parent Email', 'Parent Phone', 'Address', 'Medical Info', 'Status', 'Registration Date'];
        rows = data.map(student => [
            student.studentId,
            student.firstName,
            student.lastName,
            student.dateOfBirth,
            student.gender,
            student.class,
            student.parentName,
            student.parentEmail,
            student.parentPhone,
            student.address,
            student.medicalInfo,
            student.status,
            student.createdAt
        ]);
    } else if (type === 'staff') {
        headers = ['Employee ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Position', 'Department', 'Start Date', 'Salary', 'Qualification', 'Address', 'Experience', 'Status', 'Hire Date'];
        rows = data.map(member => [
            member.employeeId,
            member.firstName,
            member.lastName,
            member.email,
            member.phone,
            member.position,
            member.department,
            member.startDate,
            member.salary,
            member.qualification,
            member.address,
            member.experience,
            member.status,
            member.createdAt
        ]);
    } else if (type === 'admins') {
        headers = ['Employee ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Role', 'Access Level', 'Username', 'Permissions', 'Address', 'Qualification', 'Status', 'Registration Date'];
        rows = data.map(admin => [
            admin.employeeId,
            admin.firstName,
            admin.lastName,
            admin.email,
            admin.phone,
            admin.role,
            admin.accessLevel,
            admin.username,
            admin.permissions.join('; '),
            admin.address,
            admin.qualification,
            admin.status,
            admin.createdAt
        ]);
    }
    
    const csvContent = [headers, ...rows]
        .map(row => row.map(field => `"${field}"`).join(','))
        .join('\n');
    
    return csvContent;
}

function downloadCSV(csv, filename) {
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', filename);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
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
            
            // Load data when switching to view tabs
            if (tabName === 'view-students') {
                loadStudents();
            } else if (tabName === 'view-staff') {
                loadStaff();
            } else if (tabName === 'view-admins') {
                loadAdmins();
            }
        });
    });

    // Setup search functionality
    setupSearch();

    // Close modals when clicking outside
    document.getElementById('userModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // Load initial data
    setTimeout(() => {
        updateStats();
        loadStudents(); // Load students by default since it's the first tab
    }, 500);

    // Refresh data every 30 seconds
    setInterval(() => {
        updateStats();
        // Refresh the currently active table
        const activeTab = document.querySelector('.tab-btn.active');
        if (activeTab) {
            const tabName = activeTab.getAttribute('data-tab');
            if (tabName === 'view-students') loadStudents();
            else if (tabName === 'view-staff') loadStaff();
            else if (tabName === 'view-admins') loadAdmins();
        }
    }, 30000);

    console.log('🎯 User Directory System initialized!');
});
