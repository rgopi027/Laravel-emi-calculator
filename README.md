# Laravel EMI Calculator

## Overview

The **Laravel EMI Calculator** is a web-based application developed using the Laravel framework. It allows users to calculate Equated Monthly Installments (EMI) for loans based on the principal amount, interest rate, and loan tenure. The project also features user authentication and the ability to store loan details in a database.

## Features

- User authentication (login and registration)
- EMI calculation form
- Loan details and history display
- Dynamic creation of `emi_details` tables based on processed data
- Uses the repository and service pattern

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/nishanth186/Laravel-emi-calculator.git
    ```

2. Navigate to the project directory:

    ```bash
    cd Laravel-emi-calculator
    ```

3. Install the necessary dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to create a `.env` file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Update your `.env` file with your database credentials and other settings:

    ```
    APP_NAME="EMI Processing"
    DB_DATABASE=emi_processing
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. Run the database migrations:

    ```bash
    php artisan migrate
    ```

8. Seed the database with initial data (loan details and users):

    ```bash
    php artisan db:seed
    ```

9. Start the development server:

    ```bash
    php artisan serve
    ```

The application will be accessible at `http://localhost:8000`.

## Usage

1. Register or log in using the provided authentication system.
2. Navigate to the EMI Calculator form.
3. View the loan details and payment history.

## Project Structure

The project follows a clean and organized structure, utilizing the Laravel MVC (Model-View-Controller) pattern. Additionally, the repository and service pattern is implemented for better maintainability and separation of concerns.

## Contributing

Feel free to fork this repository and submit pull requests. For major changes, please open an issue first to discuss the proposed changes.

## License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
