pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                checkout scm  // ✅ Best practice for checking out repo
            }
        }

        stage('Get Branch Name') {
            steps {
                script {
                    env.BRANCH_NAME = sh(script: 'git rev-parse --abbrev-ref HEAD', returnStdout: true).trim()
                    echo "Current branch: ${env.BRANCH_NAME}"
                }
            }
        }

        stage('Build') {
            steps {
                echo 'Building the application...'
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests...'
            }
        }

        stage('Deploy') {
            when {
                expression { env.BRANCH_NAME == 'main' }  // ✅ Deploy only if branch is 'main'
            }
            steps {
                script {
                    echo "Deploying to FTP server..."
                    step([
                        $class: 'PublishOverFtp',
                        parameterName: '',
                        sites: [[
                            name: "helpinghands", // ✅ Must match the configured name in Jenkins
                            sourceFiles: '**/*', // ✅ Upload all files
                            remoteDirectory: '/heplingshand.in/htdocs/', // ✅ Correct FTP path
                            removePrefix: '',
                            flatten: false
                        ]]
                    ])
                }
            }
        }
    }
}
