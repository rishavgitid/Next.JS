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
                    env.BRANCH_NAME = sh(script: '''
                        if [ -d .git ]; then
                            git symbolic-ref --short HEAD || git branch --show-current
                        else
                            echo "main"  # Default fallback
                        fi
                    ''', returnStdout: true).trim()
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
                expression { return env.BRANCH_NAME == 'main' }  // ✅ Ensure the condition is checked properly
            }
            steps {
                script {
                    echo "Deploying to FTP server..."
                    step([
                        $class: 'PublishOverFtp',
                        parameterName: '',
                        sites: [[
                            name: "helpinghands",  // ✅ Must match the configured name in Jenkins
                            sourceFiles: '**/*',  // ✅ Upload all files
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
