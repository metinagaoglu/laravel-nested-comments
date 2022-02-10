FROM metinagaoglu/laravel8-mysql-with-nodejs

RUN apt update
RUN apt install php8.0-dom -y
RUN apt install php8.0-xml -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .
COPY .env.example .env

RUN php artisan key:generate
RUN npm run dev

EXPOSE 8000
copy ./setuplaravel.sh /tmp    
RUN ["chmod", "+x", "/tmp/setuplaravel.sh"]
ENTRYPOINT ["/tmp/setuplaravel.sh"]