### How to install docker-compose
```
sudo curl -o /usr/local/bin/docker-compose -L https://github.com/docker/compose/releases/download/1.11.1/docker-compose-`uname -s`-`uname -m`
sudo chmod +x /usr/local/bin/docker-compose
docker-compose -v
```

### The first time you run the docker folder
+ you need createtwo files

**docker-compose.yml**
```
version: '2'
services:
  nginx:
    container_name: m2-nginx
    image: jtsunne/nginx:latest
    ports:
     - "80:80"
    volumes:
     - ./nginx/nginx:/etc/nginx
     - ../:/var/www/html
     - ./logs/nginx/:/var/log/nginx
    depends_on:
            - php
    networks:
     - appnet
  php:
    container_name: m2-php
    image: jtsunne/php:latest
    depends_on:
            - db
    volumes:
     - ../:/var/www/html
     - ./php/php.ini:/etc/php/7.0/fpm/php.ini
    networks:
     - appnet
  db:
    container_name: m2-db
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: hide
      MYSQL_DATABASE: db
      MYSQL_USER: user
      MYSQL_PASSWORD: super_passwd
    volumes:
     - "./dataDb:/var/lib/mysql"
#     - "./init_db:/docker-entrypoint-initdb.d"
    networks:
     - appnet
    ports:
     - "127.0.0.1:3466:3306"
networks:
  appnet:
    driver: bridge
    ipam:
        driver: default
        config:
          - subnet: 172.58.238.0/24
            gateway: 172.58.238.1
```
and
**setup.sh**
```
#!/bin/bash

#docker exec gli-php sh -c 'cd /var/www/html && \
#composer clearcache && \
#composer install && \
#php artisan cache:clear && \
#php artisan view:clear && \
#php artisan clear-compiled && \
#chown -R www-data.www-data /var/www/html/app/ && \
#chown -R www-data.www-data /var/www/html/storage/ && \
#chown -R www-data.www-data /var/www/html/tests/ && \
#chown -R www-data.www-data /var/www/html/vendor/ && \
#chown -R www-data.www-data /var/www/html/public/ && \
#chown -R www-data.www-data /var/www/html/resources/ && \
#chown -R www-data.www-data /var/www/html/routes/ && \
#chown -R www-data.www-data /var/www/html/bootstrap/ && \
#chown -R www-data.www-data /var/www/html/config/ && \
#chown -R www-data.www-data /var/www/html/database/'
##php artisan migrate'

chmod -R 777 ../storage
chmod -R 777 ../bootstrap/cache

docker exec m2-php sh -c 'cd /var/www/html && \
composer clearcache && \
composer install && \
php artisan key:generate && \
php artisan migrate && \
php artisan db:seed && \
php artisan cache:clear && \
php artisan view:clear && \
php artisan clear-compiled'
```
### Install
1. ```docker-compose up -d db```
2. ```docker-compose up -d php```
3. ```docker-compose up -d nginx```
4. ```bash setup.sh```
5. ```cd docker && \ docker-compose up -d```

### Cleaning docker(containers,images,volumes,networks)
I have a helper function to nuke everything so that our Continuous blah, cycle can be tested, erm... continuously. Basically it boils down to the following:

To clear containers:
```docker rm -f $(docker ps -a -q)```

To clear images:
```docker rmi -f $(docker images -a -q)```

To clear volumes:
```docker volume rm $(docker volume ls -q)```

To clear networks:
```docker network rm $(docker network ls | tail -n+2 | awk '{if($2 !~ /bridge|none|host/){ print $1 }}')```


###Подключка кастомного образа
```
wp:
     build:
       context: customDockerfiles/apache
       dockerfile: Dockerfile
     container_name: m2_wp
     #environment:
       #- ALLOW_OVERRIDE=false
     depends_on:
       - mysql_wp
     ports:
       - 6180:80
     networks:
       - appnet
     volumes:
       - ./wp:/var/www/html
```
