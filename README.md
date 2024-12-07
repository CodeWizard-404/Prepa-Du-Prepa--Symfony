# Prepa Du Prepa - Symfony Project

## Description

**Prepa Du Prepa** is a web application designed to serve as a resource hub for engineering exam preparation. Built using the **Symfony framework**, this project aims to offer students a platform to access study materials, resources, and tips.

## Features

- **User Authentication:** Secure login and registration for users.
- **Course Resources:** Access to engineering exam preparation materials.
- **Search Functionality:** Easy search through available resources.
- **Admin Panel:** Admin users can upload new materials, manage users, and moderate content.

## Requirements

- PHP >= 7.4
- Symfony >= 5.x
- Composer
- MySQL Database

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/CodeWizard-404/Prepa-Du-Prepa--Symfony.git
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Set up your `.env` file for database and other configurations.

4. Create the database:

   ```bash
   php bin/console doctrine:database:create
   ```

5. Run migrations:

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. Serve the application:

   ```bash
   symfony server:start
   ```

---
## Pictures

Here are some screenshots of the platform:

1. **Home Page**  
   ![Home Page Screenshot](readmFiles\home.png)

2. **Authentification**  
   ![User Dashboard Screenshot](readmFiles\auth.png)

3. **Sections Page**  
   ![Resource Page Screenshot](readmFiles\sections.png)
   ![Resource Page Screenshot](readmFiles\sections1.png)
---
## Usage

Once the server is running, navigate to `http://localhost:8000` in your browser to access the application. Use the login form to authenticate and start using the resources.

## Contributing

1. Fork the repository.
2. Create your feature branch.
3. Commit your changes.
4. Push to the branch.
5. Create a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

