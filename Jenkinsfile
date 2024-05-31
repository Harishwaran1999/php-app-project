pipeline {
    agent any

    environment {
        AWS_REGION = 'us-east-2'
        AWS_ACCESS_KEY_ID = credentials('AKIAU3WNS472VLSSS57A')
        AWS_SECRET_ACCESS_KEY = credentials('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')
        EC2_INSTANCE_IP = '18.220.184.190'
        MYSQL_HOST = 'php-db.cluster-clcmom6m8aky.us-east-2.rds.amazonaws.com'
        MYSQL_PORT = '3306'
        MYSQL_DATABASE = 'bookstore'
        SSH_KEY = credentials('Jenkins')
    }

    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("php-app-project:${env.BUILD_NUMBER}")
                }
            }
        }

        stage('Copy Docker Image to EC2') {
            steps {
                script {
                    withCredentials([sshUserPrivateKey(credentialsId: 'SSH_KEY', keyFileVariable: 'SSH_KEY_FILE')]) {
                        sh "scp -i ${SSH_KEY_FILE} -o StrictHostKeyChecking=no phpapp:${env.BUILD_NUMBER} ec2-user@${EC2_INSTANCE_IP}:/home/ec2-user/"
                    }
                }
            }
        }

        stage('Deploy to EC2') {
            steps {
                script {
                    sshagent(credentials: ['SSH_KEY']) {
                        sh "ssh -i ${SSH_KEY_FILE} -o StrictHostKeyChecking=no ec2-user@${EC2_INSTANCE_IP} 'docker load -i /home/ec2-user/${env.BUILD_NUMBER}'"
                        sh "ssh -i ${SSH_KEY_FILE} -o StrictHostKeyChecking=no ec2-user@${EC2_INSTANCE_IP} 'docker run -d -e MYSQL_HOST=${MYSQL_HOST} -e MYSQL_PORT=${MYSQL_PORT} -e MYSQL_USER=${MYSQL_USER} -e MYSQL_PASSWORD=${MYSQL_PASSWORD} -e MYSQL_DATABASE=${MYSQL_DATABASE} -p 80:80 phpapp:${env.BUILD_NUMBER}'"
                    }
                }
            }
        }
    }
}










