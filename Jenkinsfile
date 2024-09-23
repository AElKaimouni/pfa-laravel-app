pipeline {
    agent any

    environment {
        WORKSPACE = 'php'
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
        success {
            echo 'Build, tests, and deployment (if applicable) were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
