pipeline {
    agent any

    environment {
        IMAGE = "spring-petclinic-small"
        TAG = "latest"
    }

    stages {
        stage('Checkout') {
            steps { checkout scm } // Pulls The Git Repo
        }

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

        stage('Build Docker Image') {
            steps {
                sh "docker build -t $IMAGE:$TAG ."
            }
        }

        stage('Deploy with Compose') {
            steps {
                sh """
                    docker-compose up -d --remove-orphans
                """
            }
        }
    }

    post {
        always {
            sh 'docker-compose ps'
        }
    }
}
