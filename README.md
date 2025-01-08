# SkillRise Project Documentation

## Table of Contents
1. [Introduction](#introduction)
2. [Project Structure](#project-structure)
3. [Setup Instructions](#setup-instructions)
4. [Database Configuration](#database-configuration)
5. [User Roles](#user-roles)
6. [File Descriptions](#file-descriptions)
7. [Usage](#usage)
8. [Security](#security)
9. [Troubleshooting](#troubleshooting)

## Introduction
SkillRise is a web-based platform designed to manage and facilitate online courses. It supports different user roles such as Admin, Mentor, and User, each with specific functionalities.

## Setup Instructions
1. **Clone the Repository:**
   ```sh
   git clone <repository-url>
   cd skillrise

2. Install Dependencies: Ensure you have PHP and MySQL installed on your system.

3. Database Configuration: Create a MySQL database named skillrise and import the necessary tables.

4. Configure Database Connection: Update the database credentials in dbconnect.php:

Database Configuration
Ensure the following tables are created in the skillrise database:

    user: Stores user information.
    courses: Stores course details.
    my_learning: Tracks courses enrolled by users.

## User Roles

1. Admin:
    Access to the admin dashboard.
    Manage courses, mentors, and users.
2. Mentor:
    Access to the mentor dashboard.
    Add and manage their courses.
    View users enrolled in their courses.
3. User:
    Access to the user dashboard.
    Enroll in courses.
    View their enrolled courses.

## File Descriptions

add_course.php: Adds a course to the user's learning list.
admin/
    admindash.php
    delete_course.php
    delete_mentor.php
    delete_user.php
    manageCourse.php
    viewMentor.php
    viewUser.php
components/
    dbconnect.php
    login.php
    signup.php
courselist.php
index.php
learning.php
logout.php
mentor/
    addCourse.php
    menDash.php
    mycourses.php
    removeCourse.php
    userEnrolled.php
README.md
remove_course.php: Removes a course from the user's learning list.
userDash.php: User dashboard.

## Usage

## 1. Admin:

Login via login.php.
Access the admin dashboard to manage courses, mentors, and users.

## 2. Mentor:

Login via login.php.
Access the mentor dashboard to add and manage courses.

## 3. User:

Register via signup.php.
Login via login.php.
Enroll in courses and view enrolled courses.

## Security

Ensure all user inputs are validated and sanitized.
Use prepared statements to prevent SQL injection.
Store passwords securely using hashing.

## Troubleshooting

## Database Connection Issues:

Verify database credentials in dbconnect.php.
Ensure the MySQL server is running.

## Page Not Found:

Check the file paths and ensure the server is correctly configured.

## Login Issues:

Ensure the user credentials are correct.
Verify the session management in login and logout scripts.