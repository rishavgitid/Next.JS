pipeline {
    agent any

    environment {
        GIT_REPO = 'https://github.com/rishavgitid/Next.JS'
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    def branch = env.GIT_BRANCH ?: 'main'
                    echo "Branch detected: ${branch}"

                    git branch: branch, url: env.GIT_REPO
                }
            }
        }

        stage('Deploy via FTP') {
            steps {
                script {
                    def ftpSettings = [:]

                    if (env.GIT_BRANCH == 'staging') {
                        echo 'Deploying to Development Server...'
                        ftpSettings = [
                            site: 'dev-server',
                            sourceFiles: '**/*',
                            remoteDirectory: '/var/www/dev-project/',
                            flatten: true
                        ]
                    } else if (env.GIT_BRANCH == 'main') {
                        echo 'Deploying to Production Server...'
                        ftpSettings = [
                            site: 'helpinghands',
                            sourceFiles: '**/*',
                            remoteDirectory: '/heplingshand.in/htdocs',
                            flatten: true
                        ]
                    } else {
                        echo "Branch ${env.GIT_BRANCH} is not configured for deployment."
                        return
                    }

                    publishOverFtp(ftpSettings)
                }
            }
        }
    }
}
