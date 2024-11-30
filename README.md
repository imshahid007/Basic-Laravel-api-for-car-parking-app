# Car Parking Management System (API ONLY)

This project is a Car Parking Management System built with Laravel. It allows users to manage car parking spaces, track parked cars, and handle parking fees.

## Features

- User authentication (Login & Register)
- Update Profile
- Update Password
- Manage Vehicles
- Manage parking spaces
- Track parked cars
- Calculate and handle parking fees

## Requirements

- PHP >= 8.2
- Composer
- Laravel >= 11.x
- MySQL

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/imshahid007/basic-laravel-api-car-parking-app
    ```
2. Navigate to the project directory:
    ```bash
    cd basic-laravel-api-car-parking-app
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
5. Generate an application key:
    ```bash
    php artisan key:generate
    ```
6. Configure your database settings in the `.env` file.

7. Run the database migrations:
    ```bash
    php artisan migrate
    ```

8. Seed the database with initial data (optional):
    ```bash
    php artisan db:seed
    ```

9. Start the development server:
    ```bash
    php artisan serve
    ```

10. Generate and View the documentation
    ```bash
    php artisan scribe:generate
    ```


## Usage

- Register or log in to the system.
- Add and manage parking spaces.
- Track cars entering and leaving the parking lot.
- Calculate parking fees based on the duration of stay.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

- Laravel framework
- Community contributors

## REST API Documentation
http://yourwebsite.com/docs

Example:-

http://127.0.0.1:8000/docs


## Tools
- Pest (Feature and Unit) for testing
- Pint (PHP code style fixer)
- Auth Sanctum (For authentication REST)
- Scribe (For API Doc Generate)
