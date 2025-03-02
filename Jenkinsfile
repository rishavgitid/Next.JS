pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/rishavgitid/Next.JS'
             BRANCH_NAME = sh(script: 'git rev-parse --abbrev-ref HEAD', returnStdout: true).trim()

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
            steps {
                script {
                    if (env.BRANCH_NAME == 'main') {
                        echo "Deploying to FTP server..."
                        step([
                            $class: 'PublishOverFtp',
                            parameterName: '',
                            sites: [[
                                name: "helpinghands",         // ✅ Use the exact name configured in Jenkins
                                sourceFiles: '**/*',        // ✅ Upload all files
                                remoteDirectory: '/heplingshand.in/htdocs/', // ✅ Target directory on the server
                                removePrefix: '',           // ✅ No prefix removal
                                flatten: false              // ✅ Maintain directory structure
                            ]]
                        ])
                    } else {
                        echo "Skipping deployment for branch ${env.BRANCH_NAME}"
                    }
                }
            }
        }
    }
}
