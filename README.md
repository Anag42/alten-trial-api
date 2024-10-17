# Alten Trial App

## Description
This repository is for the alten product trial api using Laravel

## Installation
Follow these steps to set up the project locally: 

1. **Clone the repository**: 
   ```bash
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
   ```

2. **Install dependencies: Ensure you have Composer installed, then run**:
    ```bash
    composer install
    ```

3. **Set up the environment: Copy the example environment file and configure your database**:
    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:
    ```bash
    php artisan key:generate
    ```

5. **Run database migrations**:
    ```bash
    php artisan migrate
    ```

6. **Link the storage directory**:
    ```bash
    php artisan storage:link
    ```

## Running the app localy
    php artisan serve

Access the application in your browser at http://localhost:8000.


## Testing
    php artisan test

## Required PHP Extentions
Make sure the following extensions are enabled in your php.ini file:

    extension=pdo_pgsql
    extension=pdo_sqlite
    extension=sqlite3


