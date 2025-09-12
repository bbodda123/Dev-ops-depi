# 1. Use OpenJDK 17 as the base image
FROM openjdk:17-jdk-slim

# 2. Set working directory
WORKDIR /app

# 3. Copy Maven wrapper and project files
COPY . .

# 4. Download The App Dependencies 
RUN ./mvnw package

# 5. Expose Spring Boot's default port
EXPOSE 8080

# 6. Run Spring Boot app using Maven wrapper
CMD ["./mvnw", "spring-boot:run"]