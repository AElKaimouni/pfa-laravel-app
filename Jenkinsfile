pipeline {
    agent any


    stages {
        stage('Build & Test') {
            steps {
                script {
                    sh 'docker compose -f docker-compose.test.yml --env-file prod.env up -d --build'  // Build Docker images
                }
            }
        }

        stage('Build Docker Images') {
            steps {
                script {
                    sh 'docker compose --env-file prod.env up -d --force-recreate --build'  // Build Docker images
                }
            }
        }
    }

    post {
        always {
            sh 'docker-compose -f docker-compose.test.yml down' // stop testing containers
        }
        success {
            echo 'Build, tests, and deployment were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
