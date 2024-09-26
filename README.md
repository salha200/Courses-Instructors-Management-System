# Courses & Instructors Management System

## Overview

This is an API-based system for managing training courses and instructors. Each course can be taught by multiple instructors, and each instructor can teach multiple courses. The system provides CRUD operations for both courses and instructors.


## Features

- **Courses Management**: 
 - Add a new course with associated instructors.
  - Update course details and change associated instructors.
  - Retrieve a list of all courses with their associated instructors.
  - Delete a course.
- **Instructors Management**: 
  - Add a new instructor and specify the courses they teach.
  - Update instructor details and the courses they teach.
  - Retrieve a list of all instructors with their associated courses.
  - Delete an instructor.
- **Soft Deletes**: Restore courses and Instructors after deletion.

## Project Setup

### Requirements

- PHP >= 8.0
- Composer
- Laravel >= 9.x
- MySQL or another database

### Installation

1. **Clone the Repository**

    ```bash
    git clone https://github.com/salha200/Courses-Instructors-Management-System.git
    ```

2. **Navigate to the Project Directory**

    ```bash
    cd Courses & Instructors
    ```

3. **Install Dependencies**

    ```bash
    composer install
    ```

4. **Set Up Environment Variables**

    Copy the `.env.example` file to `.env` and configure your database and other environment settings.

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other configuration details.


5. **Run Migrations**

    ```bash
    php artisan migrate
    ```



6. **Start the Development Server**

    ```bash
    php artisan serve
    ```

## API Endpoints


### Courses


- **Add a new course with associated instructors**: `POST /api/courses`
- **Retrieve all courses with their instructors**: `GET /api/courses`
- **Update a course and change associated instructors**: `PUT /api/courses/{id}`
- **Delete a course**: `DELETE /api/courses/{id}`


### Instructors


- **Add a new  instructors with associated course**: `POST /api/instructors`
- **Retrieve all  instructors with their course**: `GET /api/instructors`
- **Update a  instructors and change associated course**: `PUT /api/instructors/{id}`
- **Delete a instructors**: `DELETE /api/instructors/{id}`




## Error Handling

Customized error messages and responses are provided to ensure clarity and user-friendly feedback.

## Documentation

All code is documented with appropriate comments and DocBlocks. For more details on the codebase, refer to the inline comments.

## Contributing

Contributions are welcome! Please follow the standard pull request process and adhere to the project's coding standards.


## Contact

For any questions or issues, please contact [your email] or open an issue on GitHub.

