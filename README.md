

Training and Placement System

A web-based application developed to streamline the training and placement process for students in educational institutions. The system enables students to access resources, gain employability skills, and connect with internship and job opportunities. It provides features for managing training modules, tracking student progress, and facilitating employer-student interactions for job placements.

Table of Contents

Features

System Architecture

Technologies Used

Installation

Usage

Contributors

License


Features

Student Registration and Login: Students can create profiles, update information, and view job listings.

Company Management: Employers can register, post job openings, review applications, and manage placement activities.

Admin Management: Admins have control over user accounts, job postings, and can generate reports.

Job Application Process: Students can apply to jobs, track application statuses, and view notifications for new job opportunities.

Data Management: The system securely stores and manages data for students, companies, and job postings.


System Architecture

The system follows a client-server architecture:

1. Client-side (Frontend): Provides an interactive interface for students, companies, and admins.


2. Server-side (Backend): Handles business logic, user authentication, data processing, and interactions with the database.


3. Database: MySQL database to store user data, job listings, applications, and other relevant details.



Technologies Used

Frontend: HTML, CSS (Tailwind CSS), JavaScript

Backend: PHP

Database: MySQL

Server: Apache or Nginx


Installation

1. Clone the repository:

git clone https://github.com/your-username/training-placement-system.git


2. Set up the database:

Import placement_portal.sql into your MySQL database.



3. Configure Database Connection:

Update db.php with your database credentials.



4. Start the Server:

Host the application using a local server like XAMPP or WAMP.




Usage

1. Login as a Student, Company, or Admin:

Each user type has specific functionalities.



2. Students: Register, view jobs, and apply to relevant opportunities.


3. Companies: Post job openings, review applicants, and manage postings.


4. Admins: Oversee the platform, manage user accounts, and approve job postings.


License

This project is licensed under the MIT License.


