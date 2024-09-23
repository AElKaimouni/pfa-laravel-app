pipeline {
    agent any

    
    stages {
        stage('Build Docker Images') {
            steps {
                script {
                    sh 'docker compose --env-file prod.env up -d --force-recreate --build'  // Build Docker images
                }
            }
        }
    }

    post {
        success {
            echo 'Build, tests, and deployment were successful.'
        }
        failure {
            echo 'Build or tests failed.'
        }
    }
}
