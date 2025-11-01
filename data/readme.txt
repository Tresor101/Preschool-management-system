# BANGU PRESCHOOL - DATA MANAGEMENT GUIDE
# =====================================
# This file explains how the data storage system works
# 
# FILE STRUCTURE:
# ===============
# /data/
# ├── students.txt    - Student registration records
# ├── staff.txt       - Staff member records
# ├── admins.txt      - Administrator records
# └── readme.txt      - This file (data management guide)
#
# DATA FORMAT:
# ============
# All files use pipe-separated values (|) for easy parsing
# Each line represents one record
# Lines starting with # are comments
# Empty lines are ignored
#
# FIELD DESCRIPTIONS:
# ===================
#
# STUDENTS.TXT:
# -------------
# Student ID: Auto-generated unique identifier (STU + timestamp + random)
# First Name: Student's first name
# Last Name: Student's last name
# Date of Birth: Format YYYY-MM-DD
# Gender: Male/Female
# Class: Toddlers/Pre-School/Pre-Kindergarten
# Parent Name: Primary parent/guardian name
# Parent Email: Parent's email address
# Parent Phone: Parent's contact number
# Address: Full residential address
# Medical Info: Allergies, medications, special needs
# Registration Date: Date when student was registered
#
# STAFF.TXT:
# ----------
# Employee ID: Auto-generated unique identifier (EMP + timestamp + random)
# First Name: Staff member's first name
# Last Name: Staff member's last name
# Email: Work email address
# Phone: Contact phone number
# Position: Job title/position
# Department: Education/Administration/Health/Support
# Start Date: Employment start date
# Salary: Monthly salary amount
# Qualification: Education credentials
# Address: Residential address
# Experience: Previous work experience and skills
# Registration Date: Date when staff was registered
#
# ADMINS.TXT:
# -----------
# Employee ID: Auto-generated unique identifier (ADM + timestamp + random)
# First Name: Administrator's first name
# Last Name: Administrator's last name
# Email: Administrative email address
# Phone: Contact phone number
# Role: Director/Assistant Director/Academic Coordinator/Admin Officer
# Access Level: Full Access/Limited Access/Read Only
# Username: System login username
# Password: Encrypted password (shown as ******** in file)
# Permissions: Comma-separated list of permissions
# Address: Residential address
# Qualification: Education and management credentials
# Registration Date: Date when admin was registered
#
# SECURITY NOTES:
# ===============
# - Passwords are not stored in plain text in actual implementation
# - Files should have restricted access permissions
# - Regular backups should be maintained
# - Data should be validated before saving
#
# USAGE INSTRUCTIONS:
# ===================
# 1. When registering new users, append data to the appropriate file
# 2. Use the exact field format specified above
# 3. Ensure all required fields are filled
# 4. Generate unique IDs for each registration
# 5. Include registration timestamp
#
# MAINTENANCE:
# ============
# - Review and clean data regularly
# - Archive old records as needed
# - Monitor file sizes and performance
# - Update this guide when making changes
#
# Last Updated: November 1, 2025
# System: Bangu Preschool Management System
# Version: 1.0