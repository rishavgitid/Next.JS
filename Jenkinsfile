stage('Deploy') {
    when {
        branch 'staging'
        branch 'main'
    }
    steps {
        script {
            def server = env.BRANCH_NAME == 'staging' ? DEV_FTP : PROD_FTP
            echo "Deploying to ${server}..."

            step([
                $class: 'PublishOverFtp',
                parameterName: '',
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
