# Preparation

1. Download the repository [assignment-php](https://github.com/valdezalbertm/assignment-php)
2. Build and run docker
    ```
    docker-compose build
    docker-compose up -d
    ```

3. Copy the .env.example to .env

    `docker-compose exec php bash -c "cp .env.example .env"`

4. Install and update composer packages.

    `docker-compose exec php bash -c "php composer.phar u && php composer.phar i"`

5. Import database

    You can find the .sql database file at `assignment-php/database/tml.sql`

# How to Run Test

All tests are located in this folder `assignment-php/app/tests/`.
You can run test using this command:

    docker-compose exec php bash -c "php artisan test"

# How to Tests Routes

Though you can see all the available routes by listing routes via `artisan` using this command:

    docker-compose exec php bash -c "php artisan route:list"

You can just import the Postman resources, these resources are located at `assignment-php/postman_resources` folder.
