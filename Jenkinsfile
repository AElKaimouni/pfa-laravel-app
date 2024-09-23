pipeline {
    agent any


    stages {
        stage('Build & Test') {
            steps {
                script {

                    // Build Docker images
                    sh 'docker compose -f docker-compose.test.yml --env-file prod.env up -d --build'  
                    
                    // Run tests in the tv-test-backend container
                    sh 'docker exec tv-test-backend php artisan test'
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
            // stop testing containers
            sh 'docker compose -f docker-compose.test.yml down' 
        }
        success {
            echo 'Build, tests, and deployment were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
