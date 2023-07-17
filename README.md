# Generate statistics about booking requests

## Introduction

## Installation
1. Download the repository zip then extract the zip or clone the repository
2. Make a copy of the `.env.dist` file `cp .env.dist .env`. Add needed credentials
3.  `docker-compose up -d` (setup and launch docker containers)
4. `docker exec -it bs-php bash` (enter docker php container)  
   All the following commands are executed inside the docker php container:
* `composer install` (install php dependencies)
* `php artisan migrate` (run database migrations)
* `php artisan db:seed` (run database seeders)
4. Install node dependencies with `npm`:
* `npm i` 
* `npm run build`
* `npm dev`
5. `app/storage/framework` directory must contain `cache`, `sessions`, and `views` directories.
  Create them if they don't exist. Then set up access rights for these folders:
* `sudo chmod -R 777 bootstrap/`
* `sudo chmod -R 777 public/`
* `sudo chmod -R 777 storage/`
   

The application can be available via `http://booking-stat.loc:8080/`

## Running automated tests
1. docker exec -it bs-php bash
2. php artisan test
