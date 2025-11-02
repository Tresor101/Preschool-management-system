// System Logs JavaScript

let currentPage = 1;
let logsPerPage = 10;
let filteredLogs = [];
let allLogs = [];

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadSystemLogs();
    updateLogStats();
    
    // Set today's date as default
    document.getElementById('logDate').valueAsDate = new Date();
});

function loadSystemLogs() {
    // Load logs from localStorage and generate some sample logs
    allLogs = JSON.parse(localStorage.getItem('systemLogs') || '[]');
    
    // If no logs exist, create some sample logs
    if (allLogs.length === 0) {
        generateSampleLogs();
    }
    
    filteredLogs = [...allLogs];
    displayLogs();
}

function generateSampleLogs() {
    const sampleLogs = [
        {
            timestamp: '2024-11-02 10:30:15',
            type: 'SYSTEM',
            message: 'Database initialized successfully',
            level: 'INFO'
        },
        {
            timestamp: '2024-11-02 10:25:42',
            type: 'USER',
            message: 'Student registration completed: John Doe (ID: STU001)',
            level: 'INFO'
        },
        {
            timestamp: '2024-11-02 09:15:23',
            type: 'SECURITY',
            message: 'Failed login attempt from unknown user',
            level: 'WARNING'
        },
        {
            timestamp: '2024-11-02 08:45:10',
            type: 'DATABASE',
            message: 'Data export completed successfully',
            level: 'INFO'
        },
        {
            timestamp: '2024-11-01 16:30:55',
            type: 'USER',
            message: 'Teacher registered: Jane Smith (ID: T002)',
            level: 'INFO'
        },
        {
            timestamp: '2024-11-01 14:20:18',
            type: 'SYSTEM',
            message: 'System backup completed',
            level: 'INFO'
        },
        {
            timestamp: '2024-11-01 12:15:33',
            type: 'DATABASE',
            message: 'Data validation error: Invalid phone number format',
            level: 'ERROR'
        },
        {
            timestamp: '2024-11-01 11:45:27',
            type: 'USER',
            message: 'Administrator created: Admin User (ID: AD01)',
            level: 'INFO'
        }
    ];
    
    allLogs = sampleLogs;
    localStorage.setItem('systemLogs', JSON.stringify(allLogs));
}

function displayLogs() {
    const logList = document.getElementById('logList');
    if (!logList) return;
    
    // Clear existing logs
    logList.innerHTML = '';
    
    // Calculate pagination
    const startIndex = (currentPage - 1) * logsPerPage;
    const endIndex = startIndex + logsPerPage;
    const logsToShow = filteredLogs.slice(startIndex, endIndex);
    
    // Display logs
    logsToShow.forEach(log => {
        const logEntry = document.createElement('div');
        logEntry.className = `log-entry ${log.level.toLowerCase()}`;
        
        logEntry.innerHTML = `
            <div class="log-timestamp">${log.timestamp}</div>
            <div class="log-type">${log.type}</div>
            <div class="log-message">${log.message}</div>
            <div class="log-level">${log.level}</div>
        `;
        
        logList.appendChild(logEntry);
    });
    
    updatePagination();
}

function updatePagination() {
    const totalPages = Math.ceil(filteredLogs.length / logsPerPage);
    const pageInfo = document.querySelector('.page-info');
    if (pageInfo) {
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    }
}

function updateLogStats() {
    const totalLogsEl = document.getElementById('totalLogs');
    const todayLogsEl = document.getElementById('todayLogs');
    const errorLogsEl = document.getElementById('errorLogs');
    const warningLogsEl = document.getElementById('warningLogs');
    
    if (totalLogsEl) totalLogsEl.textContent = allLogs.length;
    
    // Count today's logs
    const today = new Date().toISOString().split('T')[0];
    const todayLogs = allLogs.filter(log => log.timestamp.startsWith(today));
    if (todayLogsEl) todayLogsEl.textContent = todayLogs.length;
    
    // Count errors and warnings
    const errorLogs = allLogs.filter(log => log.level === 'ERROR' || log.level === 'CRITICAL');
    const warningLogs = allLogs.filter(log => log.level === 'WARNING');
    
    if (errorLogsEl) errorLogsEl.textContent = errorLogs.length;
    if (warningLogsEl) warningLogsEl.textContent = warningLogs.length;
}

function filterLogs() {
    const logType = document.getElementById('logType').value;
    const logDate = document.getElementById('logDate').value;
    const logLevel = document.getElementById('logLevel').value;
    
    filteredLogs = allLogs.filter(log => {
        let match = true;
        
        if (logType !== 'all' && log.type.toLowerCase() !== logType) {
            match = false;
        }
        
        if (logDate && !log.timestamp.startsWith(logDate)) {
            match = false;
        }
        
        if (logLevel !== 'all' && log.level.toLowerCase() !== logLevel) {
            match = false;
        }
        
        return match;
    });
    
    currentPage = 1;
    displayLogs();
}

function clearFilters() {
    document.getElementById('logType').value = 'all';
    document.getElementById('logDate').value = '';
    document.getElementById('logLevel').value = 'all';
    
    filteredLogs = [...allLogs];
    currentPage = 1;
    displayLogs();
}

function refreshLogs() {
    loadSystemLogs();
    updateLogStats();
    alert('✅ Logs refreshed successfully!');
}

function exportLogs() {
    const logsToExport = {
        exportDate: new Date().toISOString(),
        totalLogs: filteredLogs.length,
        logs: filteredLogs
    };
    
    const blob = new Blob([JSON.stringify(logsToExport, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `system_logs_${new Date().toISOString().split('T')[0]}.json`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    alert('📥 Logs exported successfully!');
}

function clearLogs() {
    const confirmed = confirm('⚠️ Are you sure you want to clear all system logs?\n\nThis action cannot be undone!');
    if (confirmed) {
        allLogs = [];
        filteredLogs = [];
        localStorage.removeItem('systemLogs');
        displayLogs();
        updateLogStats();
        alert('🗑️ All system logs cleared!');
    }
}

function previousPage() {
    if (currentPage > 1) {
        currentPage--;
        displayLogs();
    }
}

function nextPage() {
    const totalPages = Math.ceil(filteredLogs.length / logsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        displayLogs();
    }
}

// Function to add new log entry (can be called from other parts of the system)
function addLogEntry(type, message, level = 'INFO') {
    const newLog = {
        timestamp: new Date().toISOString().replace('T', ' ').substring(0, 19),
        type: type.toUpperCase(),
        message: message,
        level: level.toUpperCase()
    };
    
    allLogs.unshift(newLog); // Add to beginning
    localStorage.setItem('systemLogs', JSON.stringify(allLogs));
    
    // If currently viewing all logs, refresh display
    if (filteredLogs.length === allLogs.length - 1) {
        filteredLogs.unshift(newLog);
        displayLogs();
    }
    
    updateLogStats();
}

// Make function available globally
window.addLogEntry = addLogEntry;
