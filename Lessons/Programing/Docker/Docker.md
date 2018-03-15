### How to install docker-compose
[install docker](https://www.digitalocean.com/community/tutorials/docker-ubuntu-16-04-ru)
```
sudo curl -o /usr/local/bin/docker-compose -L https://github.com/docker/compose/releases/download/1.11.1/docker-compose-`uname -s`-`uname -m`
sudo chmod +x /usr/local/bin/docker-compose
docker-compose -v
```
docker exec -it m2-db bash

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

### Включаем/Отключаем автозапуск контейнера
```docker update --restart={no,on-failure,unless-stopped,always} container_name```
+ ```no``` - Do not automatically restart the container. (the default)
+ ```on-failure``` - Restart the container if it exits due to an error, which manifests as a non-zero exit code.
+ ```unless-stopped``` - Restart the container unless it is explicitly stopped or Docker itself is stopped or restarted.
+ ```always``` - Always restart the container if it stops.

### docker network create
```docker network create \
  --driver=bridge \
  --subnet=172.28.0.0/16 \
  --ip-range=172.28.5.0/24 \
  --gateway=172.28.5.254 \
  some_services```
  
  
  ```docker network ls``` подивитись список мереж \
  ```docker network [NAME_SERVICE]``` видалити мережу
  
