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

chmod -R 666 ../config/configM2.php
chmod -R 666 ../config/configM2Reserv.php
chmod -R 777 ../storage
chmod -R 777 ../bootstrap/cache

#Функция для проверки существования БД. Если БД существует и она пуста -> залить дамп.
check_db () {
    RESULT=`docker exec -i $1 mysqlshow --user=$3 --password=$4 $2| grep -v Wildcard | grep -o $2`
    if [ "$RESULT" == "$2" ]; then
        ISSET_TABLES=`docker exec -i $1 mysql -u$3 -p$4 --raw --batch -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$2';" -s`
        if [ ${ISSET_TABLES} == 0 ]; then
            docker exec -i $1 mysql -u$3 -p$4 $2 < ./sql/$5
            echo "Дамп $5 импортирован!!!!!!!!!!"
        else
            echo "Дамп $5 не импортирован"
        fi
    fi
}

#Параметры:
#1. Имя контейнера в докере
#2. БД
#3. Логин
#4. Пароль
#5. Дамп БД
check_db m2-db m2_db root hide dump.sql
check_db m2_db_wp wordpress root hide dumpWp.sql



docker exec m2-php sh -c 'cd /var/www/html && \
composer clearcache && \
composer install && \
php artisan key:generate && \
php artisan cache:clear && \
php artisan view:clear && \
php artisan clear-compiled && \
php artisan storage:link'
