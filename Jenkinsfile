pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                checkout scm
            }
        }

        stage('Get Branch Name') {
            steps {
                script {
                    env.BRANCH_NAME = sh(script: '''
                        if [ -d .git ]; then
                            git symbolic-ref --short HEAD || git branch --show-current
                        else
                            echo "main"
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
            steps {
                script {
                    echo "Deploying to FTP server..."
                    ftpPublisher(
                        publishers: [
                            [
                                configName: "helpinghands",
                                transfers: [
                                    [
                                        sourceFiles: '**/*',
                                        remoteDirectory: '/heplingshand.in/htdocs/', // ✅ Corrected path
                                        removePrefix: '',
                                        flatten: false,
                                        cleanRemote: true // ✅ Ensure old files are removed before upload
                                    ]
                                ],
                                useWorkspaceInPromotion: false,
                                usePromotionTimestamp: false
                            ]
                        ]
                    )
                }
            }
        }
    }
}
