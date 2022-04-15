<<<<<<< HEAD
Symfony - Start project
======

## Spec
* Symfony 6.0.7
* PHP 8.1
* Apache
* Mariadb latest
* Xdebug 3.14
* Composer latest
* symfony/apache-pack 1.0.1
* Git

Xdebug by default is enabled and running. 
For more information on configuring the IDE please check [matthewsetter.com](https://matthewsetter.com/setup-step-debugging-php-xdebug3-docker/) 

The application/Symfony code in under the `/src` folder.  
The `src` folder is mounted into `/var/www/html` inside the `app` container. 

## Set up the project
1. Clone the project.
2. Copy `.env.sample` file to `.env` file in the main directory.
3. Inside the main folder, start the docker-compose: `docker-compose up -d`
4. Connect to the `app` container: `docker-compose exec app bash`
5. Install composer inside the container `composer install`
6. Check [http://localhost](http://localhost/index.php/), you should see the Symfony welcome page. 

## Commands cheat sheet
### Start the docker-compose
```bash
docker-compose up -d
```
To rebuild the container as well:
```bash
docker-compose up -d --build
```

### Start the docker-compose
```bash
docker-compose down
```
To remove the dependent orphaned containers:
```bash
docker-compose down --remove-orphans
```

### Connect to container
```bash
docker-compose exec app bash
```

### Disable the xdebug
you can disable the xdebug in order to improve the performance. read more on 
[carstenwindler.de](https://carstenwindler.de/php/enable-xdebug-on-demand-in-your-local-docker-environment/)
```bash
bin/xdebug disable
```

### Enable the xdebug
To re-enable the xdebug:
```bash
bin/xdebug disable
```
=======
# web2
>>>>>>> 332b832da47b3086eb2fb87a239409e1ea6448f0
