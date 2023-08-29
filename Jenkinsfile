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
      
        stage('Deploy') {
            steps {
                 sshagent(['ssh-agent']) {
                sh 'ls'
                sh 'whoami '
                 }
            }
        }
    }
}
