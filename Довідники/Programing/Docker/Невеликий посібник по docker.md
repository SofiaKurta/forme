### Загальне
+ перевірка використання ресурсів: ```docker stats containername```
+ показати список запущених контейнерів: ```docker ps```
+ показати список включаючи зупинені: ```docker ps -a```
+ більше інформації про контейнер: ```docker inspect <container_name>```
+ переглянути список змінених файлів в контейнері: ```docker diff <container_name>```
+ показати список подій в контейнері: ```docker logs <container_name>```
+ отримати адресу на якій працює docker: ```docker-machine ip default```
+ зафіксувати зміни в образі: ```docker commit```
+ переглянути історію образу: ```docker history <image>```
Чим менше слоїв (RUN apt instal... RUN apt install mysql) тим менше пам'яті займає образ на диску

 

### Очистка докера (containers,images,volumes,networks)

+ Щоб очистити контейнери: ```docker rm -f $(docker ps -a -q)```
+ Щоб очистити образи: ```docker rmi -f $(docker images -a -q)```
+ Для очищення томів: ```docker volume rm $(docker volume ls -q)```
+ Для очищення мереж: ```docker network rm $(docker network ls | tail -n+2 | awk '{if($2 !~ /bridge|none|host/){ print $1 }}')```

#### Включаємо/Відключаємо автозапуск контейнера
```docker update --restart={no,on-failure,unless-stopped,always} container_name```

+ no - Не перезапускати контейнер автоматично. (за умовчанням)
+ on-failure - Перезапустити контейнер, якщо він вилетить через помилку, яка виявляється як ненульовий код виходу.
+ unless-stopped - Перезапустити контейнер, якщо він явно не зупинений або сам Docker не буде зупинено або перезапущено.
+ always - Завжди перезапускати контейнер, якщо він зупиняється.

#### docker network create
```--driver=bridge \
--subnet=172.28.0.0/16 \
--ip-range=172.28.5.0/24 \
--gateway=172.28.5.254 \
some_services```
  
```docker network ls``` подивитись список мереж \
```docker network [NAME_SERVICE]``` видалити мережу
