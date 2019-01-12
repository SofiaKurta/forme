### Install mercurial
```sudo apt-get install mercurial```

### Install Docker
```sudo apt-get update```\
```sudo apt install apt-transport-https ca-certificates curl software-properties-common```\
```curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -```\
```sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"```\
```sudo apt update```\
```apt-cache policy docker-ce```\
```sudo apt install docker-ce```\
```sudo systemctl status docker``` \
Executing the Docker Command Without Sudo \
```sudo usermod -aG docker ${USER}```\
```su - ${USER}```\
```id -nG```\
Install docker-compose\
```sudo apt install docker-compose```
