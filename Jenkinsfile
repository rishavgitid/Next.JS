pipeline {
    agent any

    environment {
        DEV_FTP = "Development"
        PROD_FTP = "Production"
        FTP_CREDENTIALS = "ftp-credentials-id"
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: env.BRANCH_NAME, url: 'https://github.com/rishavgitid/Next.JS'
            }
        }
        
        stage('Build') {
            steps {
                echo 'Building the application...'
                // Add build commands (e.g., npm install, npm run build)
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests...'
                // Add test commands
            }
        }

        stage('Deploy') {
            when {
                branch 'staging'
                branch 'main'
            }
            steps {
                script {
                    def server = env.BRANCH_NAME == 'staging' ? DEV_FTP : PROD_FTP
                    echo "Deploying to ${server}..."

                    // FTP Deployment
                    step([
                        $class: 'PublishOverFtp',
                        sites: [[
                            name: server,
                            sourceFiles: '**/*',
                            remoteDirectory: '/heplingshand.in/htdocs/',
                            removePrefix: '',
                            flatten: false
                        ]]
                    ])
                }
            }
        }
    }
}
```