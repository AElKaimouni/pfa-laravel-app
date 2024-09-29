pipeline {
    agent any

    stages {

        stage('Build & Test') {
            steps {
                script {
                    // Build Docker images
                    sh 'docker compose -p test -f docker-compose-test.yml --env-file prod.env up -d --build'

                    def maxRetries = 10
                    def retryCount = 0
                    def commandSucceeded = false

                    while (retryCount < maxRetries && !commandSucceeded) {
                        try {
                            // Replace the following line with your command
                            sh 'docker exec test-tv-backend php artisan migrate --force'
                            commandSucceeded = true
                        } catch (Exception e) {
                            retryCount++
                            echo "Command failed. Retry count: ${retryCount}"
                            if (retryCount >= maxRetries) {
                                error "Command failed after ${maxRetries} attempts"
                            }
                            sleep 10 // Optional: wait before retrying
                        }
                    }
                    
                    // Run tests in the test-tv-backend container
                    sh 'docker exec test-tv-backend php artisan test'
                }
            }
        }
      
        stage('Build Docker Images') {
            steps {
                script {
                    // Build Docker images
                    sh 'docker compose -p prod --env-file prod.env up -d --force-recreate --build' 
                }
            }
        }
    }

    post {
        always {
            // stop testing containers
            sh 'docker compose -p test -f docker-compose-test.yml down' 
        }
        success {
            echo 'Build, tests, and deployment were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
 