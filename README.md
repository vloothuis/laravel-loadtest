# Setup

## Build App

First ensure the proper settings for the database by editing `.env`.

Build the Docker container:

    docker build . -t loadtest:latest

## Database

The database must be a recent version of PostgreSQL. To setup the tables run:

    docker run --rm loadtest php artisan migrate
    docker run --rm loadtest php artisan db:seed

## Run App

Run it:

    docker run --rm -p 8080:80 loadtest

# Run the tests

    ab -n 10000 -c 4 http://0.0.0.0/load-test
