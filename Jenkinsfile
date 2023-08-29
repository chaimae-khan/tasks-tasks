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
                sh 'ssh -o StrictHostKeyChecking=no user2@192.168.217.153 "bash /var/www/tasks-tasks/scripts/deploy.sh"'

}
            }
        }
    }
}
