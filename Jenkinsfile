pipeline {
    agent any

    environment {
        COMPOSE_FILE = 'docker-compose.yml'
    }

    stages {
        stage('Build Docker Images') {
            steps {
                script {
                    sh 'docker compose up -d --force-recreate --build'  // Build Docker images
                }
            }
        }
    }

    post {
        always {
            script {
                sh 'docker compose down'  // Clean up containers after the build
            }
        }
        success {
            echo 'Build, tests, and deployment (if applicable) were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
