pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                // Install Composer dependencies
            sh 'composer install'
            
            // Install npm dependencies
            sh 'npm install'
            
            // Build assets using npm
            sh 'npm run build'
            }
        }
        stage('Test') {
            steps {
               sh 'php artisan test'
            }
        }
        stage('Deploy') {
            steps {
              sh  'echo Deploying....'
            }
        }
    }
}
