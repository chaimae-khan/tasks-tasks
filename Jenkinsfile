pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
           echo 'Building...'
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
              def sshCommand = "ssh -o StrictHostKeyChecking=no user2@192.168.217.153 bash /var/www/tasks-tasks/scripts/deploy.sh"
               sh sshCommand
            }
        }
    }
}
