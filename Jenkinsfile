pipeline {
    agent any

    environment {
        BRANCH_NAME = sh(script: 'git rev-parse --abbrev-ref HEAD', returnStdout: true).trim()
    }

    stages {
        stage('Check Branch') {
            steps {
                echo "Current branch: ${BRANCH_NAME}"
            }
        }

        stage('Deploy') {
            when {
                expression { BRANCH_NAME == 'main' }
            }
            steps {
                echo 'Deploying to FTP...'
                // FTP deployment steps here
            }
        }
    }
}
