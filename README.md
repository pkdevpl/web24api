### Postman
* This repository offers collection of Postman endpoints for easy testing.
* In Postman workspace click `Import` and upload `Web24Api.postman_collection.json` file.
* Create new `Environment` and after running create/update endpoints, resource ids will be updated automatically

### Run
* run `composer install`
* run `docker-compose up -d` in the main directory to setup docker
* run `symfony console doctrine:schema:create`
* run `symfony serve -d` to start server
