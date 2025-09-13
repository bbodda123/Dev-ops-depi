# Jenkins Pipeline for Spring Petclinic

This document describes the **Jenkins pipeline** setup for the Spring Petclinic project. It explains each stage and how it works.

**Pipeline Repository URL:** [Spring Petclinic Repo](https://github.com/bbodda123/Pipeline/tree/edits)

---

## Pipeline Overview

The Jenkins pipeline automates **pulling the code, building and testing the application, creating a Docker image, and deploying it**.

### Stages Description

1. **Checkout** Pulls the latest code from the Git repository.

    ```groovy
    stage('Checkout') {
        steps { checkout scm } // Pulls The Git Repo
    }
    ```

2. **Build & Test**
   Uses a Maven Docker image (`maven:3.9-eclipse-temurin-17`) to compile the code and run tests. The command `mvn clean verify` is executed inside the `spring/` directory.
    ```groovy
    stage('Build & Test') {
        agent {
            docker { 
                image 'maven:3.9-eclipse-temurin-17' 
            }
        }
        steps {
            // Set The Working Directory For The Shell Commands That I Will write To Make The Testing..
            dir('spring') {
                sh 'mvn clean verify'
            }
        }
    }
    ```

3. **Build Docker Image**
   Builds the application Docker image with the specified `IMAGE` and `TAG`.
    ```groovy
    stage('Build Docker Image') {
        steps {
            sh "docker build -t $IMAGE:$TAG ."
        }
    }
    ```
4. **Deploy with Compose**
   Uses `docker-compose` to start the application and database containers. The `--remove-orphans` flag ensures old containers are cleaned up.
    ```groovy
    stage('Deploy with Compose') {
        steps {
            sh """
                docker-compose up -d --remove-orphans
            """
        }
    }
    ```
### Post Stage

* **Always** lists running containers after deployment using `docker-compose ps`.

    ```groovy
    post {
        always {
            sh 'docker-compose ps'
        }
    }
    ```
---

This Jenkins pipeline ensures an automated flow from code changes to deployment, making development and testing faster and more reliable.
