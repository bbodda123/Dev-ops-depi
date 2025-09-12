# Dockerfile Documentation

This project contains Dockerfiles for building and running the Spring PetClinic application in containerized environments.

## Dockerfiles Overview

- **Dockerfile**  
  Located at the project root. Used to build the main application image.

## Building the Application Image

To build the application image using the root Dockerfile:

```bash
docker build -t spring-petclinic . # Small Sized App
```

## Running the Application

You can run the application using Docker Compose:

```bash
docker compose up -d
```

This will start the application and any required services (e.g., MySQL, PostgreSQL).

## Additional Notes

- `.dockerignore` is used to exclude unnecessary files from the build context.
- See [docker-compose.yml](docker-compose.yml) for service definitions and environment variables.

## Accessing the Application

After starting the containers, access the app at:  
[http://localhost:8084](http://localhost:8084)
