# 🐳 Multi-Network Spring PetClinic with MySQL and Volumes

## 📖 Overview

This project demonstrates how to use **multiple Docker networks and volumes** to connect multiple instances of the **Spring PetClinic** application with MySQL databases.

We set up:

1. **First Network** – Runs a Spring PetClinic app and a MySQL database connected to a persistent volume.
2. **Second Network** – Creates a copy of the first volume, attaches it to another MySQL database, and runs another PetClinic app connected to this database.
3. **Third Network** – Hosts a Spring PetClinic app that connects to the **second database** via a **local port binding**.

## 🛠️ Setup Instructions

### 1. Create Networks

```bash
docker network create net1
docker network create net2
docker network create net3
```

## Create First Volume

```bash
docker volume create mysql_data_1
```

# Note <span style="color:red;">!!</span> You Should have Mysql image named <span style="color:red;">mysql:8</span> , app image named <span style="color:red;">spring-petclinic</span>

## Run MySQL DB #1

```bash
docker run -d --name mysql1 --network net1 \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=petclinic \
  -v mysql_data_1:/var/lib/mysql \
  mysql:8
```

## Run PetClinic App #1

```bash
docker run -d --name petclinic1 --network net1 \
  -p 8081:8080 \
  -e SPRING_DATASOURCE_URL=jdbc:mysql://mysql1:3306/petclinic \
  -e SPRING_DATASOURCE_USERNAME=root \
  -e SPRING_DATASOURCE_PASSWORD=root \
  spring-petclinic

docker volume create mysql_data_2

docker run --rm -v mysql_data_1:/from -v mysql_data_2:/to alpine ash -c "cd /from ; cp -av . /to"
```

## Run MySQL DB #2

```bash
docker run -d --name mysql2 --network net2 \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=petclinic \
  -v mysql_data_2:/var/lib/mysql \
  -p 3307:3306 \
  mysql:8
```

## Run PetClinic App #2

```bash
docker run -d --name petclinic2 --network net2 \
  -p 8082:8080 \
  -e SPRING_DATASOURCE_URL=jdbc:mysql://mysql2:3306/petclinic \
  -e SPRING_DATASOURCE_USERNAME=root \
  -e SPRING_DATASOURCE_PASSWORD=root \
  spring-petclinic
```

# Run PetClinic App #3 Connected To DataBase Through localPort

## host.docker.internal =>> Docker’s way of letting a container talk to the host machine(pc or laptop)

## host.docker.internal === localhost

```bash
docker run -d --name petclinic3 --network net3 \
  -p 8083:8080 \
  -e SPRING_DATASOURCE_URL=jdbc:mysql://host.docker.internal:3307/petclinic \
  -e SPRING_DATASOURCE_USERNAME=root \
  -e SPRING_DATASOURCE_PASSWORD=root \
  spring-petclinic
```

## 🚀 Access Applications

PetClinic #1 → <link href="http://localhost:8081">http://localhost:8081</link>

PetClinic #2 → <link href="http://localhost:8081">http://localhost:8082</link>

PetClinic #3 → <link href="http://localhost:8081">http://localhost:8083</link>
