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
                    echo "Checking and Creating FTP directory if missing..."

                    // ✅ Run FTP commands to create the directory before uploading
                    sh '''
                    ftp -inv $FTP_SERVER <<EOF
                    user $FTP_USER $FTP_PASSWORD
                    mkdir heplingshand.in/htdocs
                    bye
                    EOF
                    '''

                    echo "Deploying to FTP server..."
                    ftpPublisher(
                        publishers: [
                            [
                                configName: "helpinghands",
                                transfers: [
                                    [
                                        sourceFiles: '**/*',
                                        remoteDirectory: '/heplingshand.in/htdocs/',  // ✅ Correct FTP path
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
