pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/rishavgitid/Next.JS'
            }
        }
        stage('Build') {
            steps {
                echo 'Building the application...'
                // Add build commands (e.g., Maven, Gradle, npm, etc.)
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests...'
                // Add test commands (e.g., unit tests)
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying application...'
                // Add deployment commands (e.g., Docker, SCP, Kubernetes)
            }
        }
    }
}
