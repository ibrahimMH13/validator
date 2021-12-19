FROM ubuntu

RUN apt-get -y update && echo '2021-12-2'
RUN apt -y install software-properties-common && add-apt-repository ppa:ondrej/php && apt-get update
RUN apt -y install php8.0
RUN apt -y install php8.0-mysql
RUN apt-get -y install php8.0-xml
RUN apt-get -y install php8.0-mbstring
RUN apt-get -y install php8.0-mongodb
RUN apt-get -y install php8.0-zmq
RUN apt-get update -y && apt-get install -y php8.0-curl
RUN apt install -y php8.0-sqlite3
RUN apt-get update && apt-get -y install curl



COPY files/event.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

#
# Install composer
#
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
php composer-setup.php --install-dir=/usr/local/bin  --filename=composer && \
php -r "unlink('composer-setup.php');"

#
# Install Node.js
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y nodejs \
    npm
#
# upgrade nodejs to 14v
#
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN apt-get -y install zip unzip vim
#
#install yarn
#
RUN curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt update && apt -y install yarn
CMD /usr/sbin/apache2ctl -D FOREGROUND


# Set default work directory
WORKDIR /var/www/html
