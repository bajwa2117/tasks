#A Laravel-based team collaboration application that allows users to create workspaces, invite members, and manage tasks within workspace boundaries.

Features
Authentication
User Registration
User Login & Logout
Email Verification
Password Reset
Workspace Management
Create Workspaces
Workspace Owner & Member Roles
Invite Registered Users to Workspaces
Workspace Authorization using Policies
Workspace Member Management
Task Management
Create Tasks within a Workspace
Assign Tasks to Workspace Members
Task Status Management (Todo, In Progress, Done)
Task Priority Levels (Low, Medium, High)
Due Dates
Task Filtering by Status and Assigned User
Policy-based Authorization

Installation

Install dependencies:

composer install

Copy environment file: ( .env.example) and rename to  .env 

Configure database credentials in .env.

Run migrations and seeders:

php artisan migrate --seed

Start the development server:

php artisan serve

Visit:

http://127.0.0.1:8000

Seeded User Accounts
Workspace Owner

Email:
owner@test.com

Password:
password

Workspace Member

Email:
member@test.com

Password:
password


Test Data

The application seeds:

2 Users
2 Workspaces
5 Tasks

Technologies Used
Laravel 10
Laravel Breeze
MySQL
Blade
Tailwind CSS

Author

Hassnat Bajwa
