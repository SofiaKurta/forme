### Install GIT
```sudo apt-get install git```

### Mercurial
```sudo apt-get install mercurial```

### Google Chrome
```wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add - ```\
```sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list'```\
```sudo apt-get update```\
```sudo apt-get install google-chrome-stable```\

### Docker
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

### Ruby
```sudo apt-get install ruby-full```\
Optional(install saas): ```sudo gem install sass```

### NPM
```sudo apt install npm```\
Optional(install less): ```npm install -g less```

### Composer 
```sudo apt install composer```
