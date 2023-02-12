## About Project

This project was created based on test assessment that I received
## About Structure

- `app`
    - `Controllers`
        - `NewsnController` to get a request, there is no logic in there, just get input parameters and send output to resource class
    - `ValueObjects`
        - `NewsValueObject` this class has responsibility to get inputs and parse it, also some simple
          operation
    - `Services`
        - `NewsService` the main logic of application is there(domain layer)
    - `resource`
        - `NewsResource` and `NewsCollection` for representation layer use this resource class
    - `Request`
        - `NewsRequest` this class set input requirements
    - `tests`
        - `feature` test the api work perfectly
        - `Integration` test dependency between services
        - `unit` test our functionality in domain layer

## Install Application
- For running application you need Docker installed on your system, and follow instructions;
  ```bash
    docker-compose build --no-cache
    docker-compose up -d
    docker-compose exec php composer install
  ```
  after run docker container we have our service at `localhost:8080`

## Install Application
- For test 
  ```bash
    docker-compose exec php php artisan test
  ```