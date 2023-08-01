# DOCKER BUILD
docker build -t 8.2-cli-swoole .

# DOCKER RUN
docker run -d -p 8099:8099 --name ws-server -v "$PWD":/var/www/html 8.2-cli-swoole /bin/bash -c 'a2enmod rewrite; apache2-foreground'