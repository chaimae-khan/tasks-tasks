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
      
            }
        }
    }
}
