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
                                        remoteDirectory: '/heplingshand.in/htdocs/',  // ✅ Correct FTP path
                                        removePrefix: 'heplingshand.in', // ✅ Only remove the project folder
                                        flatten: false,
                                        cleanRemote: true // ✅ Overwrite existing files
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
