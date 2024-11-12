pipeline {
    agent any

    stages {

        // stage('Build & Test') {
        //     steps {
        //         script {
        //             // Build Docker images
        //             sh 'docker compose -p test -f docker-compose-test.yml --env-file prod.env up -d --build'

        //             def maxRetries = 10
        //             def retryCount = 0
        //             def commandSucceeded = false

        //             while (retryCount < maxRetries && !commandSucceeded) {
        //                 try {
        //                     // Replace the following line with your command
        //                     sh 'docker exec test-tv-backend php artisan migrate --force'
        //                     commandSucceeded = true
        //                 } catch (Exception e) {
        //                     retryCount++
        //                     echo "Command failed. Retry count: ${retryCount}"
        //                     if (retryCount >= maxRetries) {
        //                         error "Command failed after ${maxRetries} attempts"
        //                     }
        //                     sleep 10 // Optional: wait before retrying
        //                 }
        //             }
                    
        //             // Run tests in the test-tv-backend container
        //             sh 'docker exec test-tv-backend php artisan test'
        //         }
        //     }
        // }

        // // Stage 2: SonarQube code analysis
        // stage ("SonarQube Analysis ") {
        //     steps {
        //         script {
        //             def scannerHome = tool "sonar - scanner "
        //             withSonarQubeEnv ("SonarQube ") {
        //                 sh "${ scannerHome }/bin/sonar - scanner " +
        //                 "-Dsonar.projectKey = GitlabMx " +
        //                 "-Dsonar.host.url = http://localhost:9000 " +
        //                 "-Dsonar.login = sqp_5c7cf314cd19d3f60ed624ea584d547820ccd482 " +
        //                 "-Dsonar.sources = ./app " +
        //                 "-Dsonar.exclusions = 'vendor/* , storage/** , bootstrap/cache/*'"
        //             }
        //         }
        //     }
        // }

        // // Stage 3: Quality Gate check , pipeline will stop if the gate fails
        // stage ("Quality Gate ") {
        //     steps {
        //         timeout ( time : 5 , unit : "MINUTES ") {
        //             waitForQualityGate abortPipeline : true
        //         }
        //     }
        // }

        stage('SonarQube Analysis') {
            steps {
                 script {
                    def scannerHome = tool 'SonarScanner';
                    withSonarQubeEnv() {
                        sh "sonar-scanner \
                            -Dsonar.projectKey=php \
                            -Dsonar.sources=. \
                            -Dsonar.host.url=http://13.36.234.139:9000 \
                            -Dsonar.token=sqp_9bb2414b0be16868d97cae1c7fab6391cc318a22"
                    }
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
 