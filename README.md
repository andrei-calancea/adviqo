# ADVIQO API
A Rest API that provides access to **Adviser** resources.

## Tech-stack
- Symfony 5.2
- PHP 8.0.5
- MySQL 8.0.24

## Documentation
The API online documentation is available accessing the link:
 
 [http://ec2-54-93-66-235.eu-central-1.compute.amazonaws.com][http://ec2-54-93-66-235.eu-central-1.compute.amazonaws.com/]

## Prepare local environment
1. Copy file `.env.example` to `.env` and adapt it to your needs;
2. Copy file `docker-compose.override.yml.example` to `docker-compose.override.yml` and adapt it to your needs;
3. Open terminal in current directory and run:
    - `docker-compose up -d` - building necessary docker containers;
    - `docker exec -it adviqo_php_1 composer install` - installing packages;
    - `docker exec -it ca_php php bin/console doctrine:migrations:migrate` - applying the migrations;
    - `docker exec -it ca_php php bin/console hautelook:fixtures:load` - loading the fixtures;

After all installation steps are complete, open [http://localhost:8088][http://localhost:8088] to view local API documentation.

## Running tests
Run the command `docker exec -it adviqo_php_1 php bin/phpunit` in current directory to execute the unit tests.


Note: 

in case the default php docker container name was overwritten (installation process step 2), make sure to use new 
container name when running `docker exec` related commands. Ex.: `docker exec -it {new_container_name} php bin/phpunit`


[http://ec2-54-93-66-235.eu-central-1.compute.amazonaws.com/]: http://ec2-54-93-66-235.eu-central-1.compute.amazonaws.com/

[http://localhost:8088]: http://localhost:8088
