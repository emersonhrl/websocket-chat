# DOCKER BUILD
docker build -t 8.2-apache-pdo .

# DOCKER RUN
docker run -d -p 80:80 --name ws-client -v "$PWD":/var/www/html 8.2-apache-pdo /bin/bash -c 'a2enmod rewrite; apache2-foreground'