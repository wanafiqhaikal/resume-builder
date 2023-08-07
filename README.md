# Resume Builder

Welcome to the **Resume Builder** project! This web application allows users to create and manage their resumes, including education and work experience details.

## Features

- Create, view, edit, and delete resumes.
- Add and manage education details.
- Add and manage work experience details.

## Technologies Used

- **Laravel**: A PHP web framework used for building the backend of the application.
- **HTML/CSS**: Used for creating the frontend layout and styles.
- **JavaScript**: Used for frontend interactivity, such as adding/removing education and experience rows.
- **MySQL**: Used to store resume, education, and experience data.
- **Git**: Version control system for tracking changes to the codebase.

## Getting Started

1. **Clone the repository:**

```bash
git clone https://github.com/wanafiqhaikal/resume-builder.git
```

2. **Install project dependencies:**

```bash
composer install
```

3. **Create a `.env` file by renaming `.env.example` and update the database configuration:**

```bash
DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=your-database-port
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

4. **Generate a new application key:**

```bash
php artisan key:generate
```

5. **Run database migrations:**

```bash
php artisan migrate
```

6. **Start the development server:**

```bash
php artisan serve
```

7. **Access the application in your web browser at `http://localhost:8000`.**

## Contributing

Contributions are welcome! If you find any issues or have improvements, feel free to open a pull request.


