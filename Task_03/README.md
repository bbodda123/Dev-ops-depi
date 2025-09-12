# Fourth Task :

Dockerfile

from copy add arg Env cmr workdir entrypoin run

spring pet clinic

run >> more layers

one layer

.dockerignore

2 folder without docker ignore

compare image size

## Clone The Spring Pet Clinic App :

```bash
git clone https://github.com/spring-projects/spring-petclinic.git
cd spring-petclinic
```

## Pull mysql:8 Image :

```bash
docker pull mysql:8
```

## Build The Spring Pet Clinic App Image

```bash
docker build -t spring-petclinic .
```

## Run The App

```bash
docker compose up -d
```

## How to Access

After running the Docker Compose app, open the browser and go to:

[http://localhost:8080](http://localhost:8080)
