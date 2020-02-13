# Web, PHP, Laravel Skills

##The Laravel Challenge App Development

## Introduction
This is a project built to OW Interactive challenge.

### The tools
You can run it locally or use docker.

### Install Dependencies

Running locally:
```
composer install
npm install
```

Running with docker:
```
cd docker
docker build -t php70 .
cd ..
edit docker-compose.yml with the paths
docker-compose up -d
docker exec -it php70 bash
composer install
npm install
```

### Preparing the application

As any new laravel install there is a couple steps to perform in order to get it going. If you are nunfamiliar follow [these instrunctions](https://laravel.com/docs/5.4/#web-server-configuration)

### Run the Application

Locally: 
```
php artisan serve
You can then browse to [http://localhost:8000](http://localhost:8000) in your web browser.
```

Docker:
```
If the containers startup correctly, you dont need to do anything!
You can then browse to [http://localhost:80](http://localhost:80) in your web browser.
```

### Run the tests
```
docker exec -it php70 bash
vendor/bin/phpunit tests/Unit/
```
Access the coverage file in /coverage/index.html
## Authors

Vinicius Fontão