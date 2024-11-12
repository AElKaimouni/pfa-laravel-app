pipeline {
    agent any

    stages {


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

    }

}
 