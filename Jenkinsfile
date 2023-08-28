pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
               sh 'composer install'
               sh 'npm install'
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
