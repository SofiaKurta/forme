## Django Development With Docker Compose and Machine

Featuring:

- Docker v1.10.3
- Docker Compose v1.6.2
- Docker Machine v0.6.0
- Python 3.5

Blog post -> https://realpython.com/blog/python/django-development-with-docker-compose-and-machine/

### OS X Instructions

1. Start new machine - `docker-machine create -d virtualbox dev;`
1. Configure your shell to use the new machine environment - `eval $(docker-machine env dev)`
1. Build images - `docker-compose build`
1. Start services - `docker-compose up -d`
1. Create migrations - `docker-compose run web /usr/local/bin/python manage.py migrate`
1. Grab IP - `docker-machine ip dev` - and view in your browser

##Issues

###Admin CSS and static file links are broken

I was able to fix this by doing the following:

Replace this line in docker-compose.yml with

    - ./web/static:/usr/src/app/static
In web/docker_django/settings.py add the line STATIC_ROOT = 'static'.

After running these two commands:

docker-compose up -d
docker-compose run web /usr/local/bin/python manage.py migrate
run:

docker-compose run web /usr/local/bin/python manage.py collectstatic --noinput
I also added

  volumes:
    - /usr/src/app/static
to production.yml so that it mounts a writeable volume that the static files created when working with the dev docker machine get copied to the production docker container (I don't think I fully understand this part yet).

An entry like static/* probably ought to be added to .gitignore.

### if you got the error: 403 Forbidden(/usr/src/app/static)
1. docker exec -it web chmod -R 666 /usr/src/app
1. docker exec -it web chmod -R 666 /usr/src/app/static
or change user in nginx.conf to user root;