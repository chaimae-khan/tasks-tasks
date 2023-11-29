pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'composer install '
                sh 'npm install'
                sh 'npm run build '
            }
        }
        stage('Test') {
            steps {
                sh 'php artisan test'
                sh 'php artisan serve'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying '
            }
        }
    }
}

