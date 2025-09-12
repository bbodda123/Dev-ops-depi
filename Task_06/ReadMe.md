# Sixth Task: Spring PetClinic with MySQL & PostgreSQL

## 📁 Files Overview

- **docker-compose.yml**: Defines services for Spring PetClinic, MySQL, and PostgreSQL, including networks and volumes.
- **docker-compose.dev.yml** / **docker-compose.prod.yml**: Environment-specific overrides for development and production.
- **.env.mysql** / **.env.pg**: Environment variable files for database credentials and configuration.
- **.gitignore**: Specifies files and folders to ignore in version control.
- **.scannerwork/**: Directory for code analysis outputs.

## 🚀 How to Run

1. **Build Required Images**

   - Ensure you have the `spring-petclinic-small` and `mysql:mysqlMain` images available locally.

2. **Start the Services**

   ```bash
   docker compose up -d
   ```

   This will start:

   - Spring PetClinic app (on [http://localhost:8086](http://localhost:8086))
   - MySQL database
   - PostgreSQL database

3. **Environment Variables**

   - The app and databases use credentials defined in `.env.mysql` and `.env.pg` (or directly in `docker-compose.yml`).

4. **Volumes**

   - Data for MySQL and PostgreSQL is persisted in `vol-sql` and `vol-postgres` volumes.

5. **Networks**
   - All services are connected via the `app_net` Docker network.

## 📝 Notes

- Healthchecks are configured for both databases to ensure readiness before the app starts.
- You can override settings using the dev/prod compose files:
  ```bash
  docker compose -f docker-compose.dev.yml up -d
  ```
- Stop all services:
  ```bash
  docker compose down
  ```

## ⚙️ Production Configuration (`docker-compose.prod.yml`)

This file customizes service settings for production deployments:

- **Spring Service**

  - Uses MySQL as the datasource (`SPRING_DATASOURCE_URL=jdbc:mysql://mysql:3306/mydb`)
  - Activates the MySQL profile (`SPRING_PROFILES_ACTIVE=mysql`)
  - Runs as a replicated service with **3 instances** for high availability
  - Restarts automatically on failure
  - Resource limits: **0.5 CPUs** and **512MB memory** per replica

- **MySQL Service**

  - Resource limits: **0.5 CPUs** and **512MB memory**

- **Postgres Service**
  - Replicas set to **0** (disabled in production)

### 🏃 How to Deploy in Production

Start all services with production settings:

```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

Or deploy as a stack in Docker Swarm:

```bash
docker stack deploy -c docker-compose.yml -c docker-compose.prod.yml mystack
```

**What these commands do:**

- Start services with production-specific environment variables and resource limits
- Run multiple Spring app instances for better reliability
- Disable PostgreSQL in production
- Apply restart policies and resource constraints for stability

## 📚 Access

- Spring PetClinic: [http://localhost:8086](http://localhost:8086)
